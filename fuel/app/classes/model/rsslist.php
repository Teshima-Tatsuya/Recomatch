<?php

class Model_Rsslist extends MyOrm {

	protected static $_table_name = 'rsslist';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'url',
		'type',
		'template',
		'date_format',
		'date_attribute',
		'category',
		'expire' => array(
			'default' => 0
		),
		'created_at',
		'updated_at',
		'id',
	);
	
	public static function getRssList() {
		$rows = self::getAll();
		
		foreach ($rows as $row) {
			
		}
	}
	
	/**
	 * 単一のサイトのRSSを取得
	 * キャッシュ対応済み
	 * @param type $self
	 * @return type
	 */
	public static function getRss($self) {
		$rss = [];
		try {
			$rss = Cache::get('rss.' . $self->template);
		} catch (\CacheNotFoundException $e) {
			// キャッシュの有効期限切れならばキャッシュを削除
			if ($e instanceof \CacheExpiredException) {
				Cache::delete('rss.' . $self->template);
			}

			Profiler::mark("rsslistの取得処理開始");
			$rss = self::getRssSite($self);
			Profiler::mark("rsslistの取得処理終了");

			// キャッシュに保存
			Cache::set('rss.' . $self->template, $rss, $self->expire);
		}
		
		return $rss;
	}
	
	/**
	 * 単一のサイトからRSSを取得
	 * @param type $obj
	 * @return type
	 */
	private static function getRssSite($obj) {

		$rss_url = $obj->url;

		$rss = Util_Rss::parse($rss_url);

		Profiler::mark($obj->template + "のforeach開始");

		// RSSのタイプによって、取得する属性を変更
		$items = array();
		if ($obj->type == Util_Rss::RSS_2) {
			$items = $rss['channel']['item'];
		} else if ($obj->type == Util_Rss::RSS_1) {
			$items = $rss['item'];
		} else if ($obj->type == Util_Rss::RSS_ATOM) {
			$items = $rss['entry'];
		}

		// rss保存用の変数
		$rss_list = [];
		//　取得した情報から値を設定
		foreach ($items as $j => $item) {
			$item += ['template' => $obj->template];
			$item += ['date_format' => $obj->date_format];
			$item += ['unix_timestamp' => DateTime::createFromFormat($obj->date_format, $item[$obj->date_attribute])->getTimeStamp()];
			$rss_list[] = $item;
		}

		return $rss_list;
	}

}
