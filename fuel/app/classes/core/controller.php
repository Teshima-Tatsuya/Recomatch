<?php

class Controller extends Fuel\Core\Controller {

	protected $views = array();
	protected $me = null;

	public function __construct(\Request $request) {
		parent::__construct($request);
		
		self::loadConfig();

		/* セッションからユーザーデータを取得 */
		View::set_global('me', Session::get("me"));
		$this->me = Session::get("me");
	}

	/**
	 * 設定ファイルをロード
	 */
	private function loadConfig() {
		Config::load('per_page', true);
		Config::load('title', true);
		Config::load('sidemenu', true);
		Config::load('layout', true);
	}

	public function getPerPage($factor) {
		$active = Config::get('per_page.active');
		$per_page = Config::get('per_page.' . $active . "." . $factor);
		if(is_null($per_page)) {
			$per_page = Config::get('per_page.'.$active.'.default');
		}
		return Intval($per_page);
	}
	
	public function getTitle($factor, $rep_list = array()) {
		$title = Config::get('title.' . $factor);
		$rep_title = strtr($title, $rep_list);
		return $rep_title;
	}

	// 設定情報によりレイアウトを取得する
	// 引数に指定された設定情報がない場合はdefaultを返す
	public static function getLayout($factor) {
		$active = Config::get('layout.active');
		$layout = Config::get('layout.' . $active . "." . $factor);
		if(is_null($layout)) {
			$layout = Config::get('layout.'.$active.'.default');
		}
		
		return $layout;
	}

    public function create_pager($modelobject, $pagerurl, $uri_segment, $current_pagesegment) {
		$pager_data = array();
		$result = $modelobject;
		$count = count($result);
		$pagination_url = $pagerurl;   //リンクに記載するURL部分(Controllerで設定する)
		$uri_segment = $uri_segment;   //何個目のセグメントがページ番号かの指定
		$num_links = 3;
		//リンクをいくつ表示させるか
		$per_page = 5;	 //1ページに何件表示させるか
		$current_page = $current_pagesegment;  //動的にする為。publicより下のセグメント数を書く(Controllerで設定する)
		$config = array(
			'pagination_url' => $pagination_url,
			'uri_segment' => $uri_segment,
			'num_links' => $num_links,
			'per_page' => $per_page,
			'total_items' => $count,
			'current_page' => $current_page,
		);

		Pagination::set_config($config);
		$pager_parts = Pagination::create_links();
		$pager_data['pager_parts'] = $pager_parts;
		$limit = Pagination::get('per_page');
		$offset = Pagination::get('offset');
		$resultpager = Model_Sample1::Pager($limit, $offset);
		$pager_data['resultpager'] = $resultpager;
		return $pager_data;
	}

}
