<?php
/**
 * Description of rss
 *
 * @author Teshima
 */
class Util_Rss {
	const RSS_ATOM = 1;
	const RSS_1 = 2;
	const RSS_2 = 3;
	
	public static function parse($url) {
		Profiler::mark("file_get_contents開始：".$url);
		$contents = self::curl_get_contents($url);
		
		Profiler::mark("Format::forge開始");
		$rss = @Format::forge($contents, 'xml:ns')->to_array();
		return $rss;
	}
	
	public static function parseMulti($urls) {
		Profiler::mark("parseMult開始");
		$contents = self::curl_get_multi_contents($urls);
		
		Profiler::mark("Format::forge開始");
		
		$rsses = array();
		foreach($contents as $content){
			$rsses[] = @Format::forge($content['content'], 'xml:ns')->to_array();
		}

		return $rsses;
		
	}
	
	/**
	 * RSSの種類を返却
	 * どの規格でもない場合0を返す。
	 * @param array $rss
	 * @return int
	 */
	public static function checkVer(array $rss) {
		if(isset($rss['entry'])) {
			return self::RSS_ATOM;
		} else if(isset($rss['item'])) {
			self::RSS_1;
		} else if(isset($rss['chennel'])) {
			self::RSS_2;
		}
		
		return 0;
	}
	
	/**
	 * cURLの並列処理バージョン
	 * @see http://techblog.yahoo.co.jp/architecture/api1_curl_multi/
	 * @param type $url
	 * @param type $timeout
	 * @return type
	 */
	private static function curl_get_contents($url, $timeout = 60){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}
	
	private static function curl_get_multi_contents(array $urls, $timeout=10){
		$mh = curl_multi_init();
		
		// urlごとのチャンネルを管理
		$ch_list = array();
		
		foreach($urls as $url) {
			$ch_list[$url] = curl_init($url);
			curl_setopt($ch_list[$url], CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch_list[$url], CURLOPT_TIMEOUT, $timeout);
			curl_multi_add_handle($mh, $ch_list[$url]);
		}
		
		$running = null;
		do {
			curl_multi_exec($mh, $running);
		} while ($running);
		
		foreach($urls as $url) {
			// ステータスとコンテンツの取得
			$results[$url] = curl_getinfo($ch_list[$url]);
			$results[$url]["content"] = curl_multi_getcontent($ch_list[$url]);
			
			// 後処理
			curl_multi_remove_handle($mh, $ch_list[$url]);
			curl_close($ch_list[$url]);
		}
		
		// マルチハンドルのクローズ
		curl_multi_close($mh);
		
		return $results;
	}
}