<?php

class Controller_Home extends MyController {

	public function action_index() {
		$this->template->myrecos = Model_Myreco::getAll(10);
		$this->template->communities = Model_Community::find('all', [
			'limit' => 10,
			'order_by' => array('created_at' => 'DESC')
		]);
		$this->template->movies = Model_Movie::getAll(10, null, array('contents_type' => Recomatch_Constants::CONTENTS_MOVIE));

		$feature_limit = 2;
		$matome_limit = 1;
		if (Agent::is_smartphone()) {
			$feature_limit = 10;
			$matome_limit = 10;
		}
		
		$this->template->features_home_header = self::getFeatureHeader();
		$this->template->matomes_home_header = self::getMatomeHeader();
		$this->template->ranking_list = Model_Myreco::getMyrecoRegistRanking();

		try {
			$rss_list = Cache::get('rsslist');
		} catch (\CacheNotFoundException $e) {

			// キャッシュの有効期限切れならばキャッシュを削除
			if ($e instanceof \CacheExpiredException) {
				Cache::delete('rsslist');
			}
			
			Profiler::mark("rsslistの取得処理開始");
			$rss_list = self::getRssList();
			Profiler::mark("rsslistの取得処理終了");

			// キャッシュに保存
			// 期間は３０分
			Cache::set('rsslist', $rss_list, 60*30);
		}
		$this->template->rss_list = $rss_list;
	}
	
	private static function getRssList(){
		Config::load("rsslist", true);
		$rss_list_config = Config::get('rsslist');

		$rss_urls = array();
		foreach ($rss_list_config as $rss_config) {
			$rss_urls[] = $rss_config['url'];
		}
		
		$rsses = Util_Rss::parseMulti($rss_urls);
			
		Profiler::mark("rsslistのforeach開始");
		foreach ($rss_list_config as $i => $rss_config) {
			Profiler::mark("rsslistのforeach内部処理：".($i+1)."回目開始");

			if(empty($rsses[$i])) {
				Profiler::console("データ未取得のためcontinue");
				continue;
			}
			// RSSのタイプによって、取得する属性を変更
			$items = array();
			if ($rss_config['type'] == Util_Rss::RSS_2) {			$items = $rsses[$i]['channel']['item'];
			} else if ($rss_config['type'] == Util_Rss::RSS_1) {
				$items = $rsses[$i]['item'];
			} else if ($rss_config['type'] == Util_Rss::RSS_ATOM) {
				$items = $rsses[$i]['entry'];
			}

			Profiler::mark("rsslistのforeach内部処理２：".($i+1)."回目開始");
			//　取得した情報から値を設定
			foreach ((array)$items as $j => $item) {
				$item += ['template' => $rss_config['template']];
				$item += ['date_format' => $rss_config['date_format']];
				$item += ['unix_timestamp' => DateTime::createFromFormat($rss_config['date_format'], $item[$rss_config['date_attribute']])->getTimeStamp()];
				$rss_list[] = $item;
				if ($j == 2)
					break;
			}
		}

		Profiler::mark("unixtimestampの列取得");
		// unix_timestampの列取得
		foreach ($rss_list as $key => $row) {
			$timestamp[$key] = $row['unix_timestamp'];
		}
		Profiler::mark("UNIXタイムスタンプを用いたソート 降順");
		// UNIXタイムスタンプを用いたソート 降順
		array_multisort($timestamp, SORT_DESC, $rss_list);
		
		return $rss_list;
	}
	
	private static function getFeatureHeader() {
		$cache_name = "feature.pc.home_header";
		$limit = 2;
		if (Agent::is_smartphone()) {
			$cache_name = "feature.mobile.home_header";
			$limit = 10;
		}
		try {
			$features_home_header = Cache::get($cache_name);
		} catch (CacheNotFoundException $e) {
			$features_home_header = Model_Feature::getAll($limit);
			
			// キャッシュの期限は無期限
			Cache::set($cache_name, $features_home_header);
		}
		
		return $features_home_header;
	}

	private static function getMatomeHeader() {
		$cache_name = "matome.pc.home_header";
		$limit = 1;
		if (Agent::is_smartphone()) {
			$cache_name = "matome.mobile.home_header";
			$limit = 10;
		}
		try {
			$matome_home_header = Cache::get($cache_name);
		} catch (CacheNotFoundException $e) {
			$matome_home_header = Model_Matome::find("all", array(
				"order_by" => array('id' => "DESC"),
				"limit" => $limit,
			));
			
			// キャッシュの期限は無期限
			Cache::set($cache_name, $matome_home_header);
		}
		
		return $matome_home_header;
	}
}
