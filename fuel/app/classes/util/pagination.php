<?php

/**
 * FuelphpのPaginationクラスの補助クラス
 */
class Util_Pagination {
	private static $config = array(
		'pagination_url'	=> null,	// 自動検出してくれるらしい
		'num_links'	=> 5,	// リンクの総数
		'total_items'	=> 10,	//ページごとに設定
		'per_page'		=> 5,	// ページごとに設定
		'uri_segment'	=> 'page',	// クエリ文字列によるページ設定
		'show_first'	=> true,	//最初のページヘを表示
		'show_last'	=> true,	//最後のページヘを表示
	);
	
	/**
	 * pagerを生成してhtml形式で文字列を返却する
	 * @param int $total_items 全アイテム数(count)
	 * @param string $factor per_pageを取得するページ要素（default:controller.action）
	 * @return string 生成されたpager
	 */
	public static function create_link($total_items, $factor = null) {
		$pagination_url = Uri::current();
		// URLにクエリ文字列「key」が存在したら、pagination_urlに付与
		if(!is_null($key = Input::get("key", null))) {
			$pagination_url .= '?key=' . $key;
		}
		self::$config["pagination_url"] = $pagination_url;
		self::$config["total_items"] = $total_items;

		self::$config["num_links"] = (Agent::is_smartphone()) ? 0 : 3;
		
		// factorがnullならば、「controller.method」の形式でfactorを設定
		if(is_null($factor)) {
			$factor = Uri::segment(1).'.'.Uri::segment(2);
		}
		self::$config["per_page"] = self::getPerPage($factor);
		$pagination = Pagination::forge("MyParination", self::$config);
		return $pagination;
	}
	
	private static function getPerPage($factor) {
		$active = Config::get('per_page.active');
		$per_page = Config::get('per_page.' . $active . "." . $factor);
		if(is_null($per_page)) {
			$per_page = Config::get('per_page.'.$active.'.default');
		}
		return Intval($per_page);
	}

}
