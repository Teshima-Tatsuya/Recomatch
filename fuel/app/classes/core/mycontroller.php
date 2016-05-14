<?php

class MyController extends Controller_SmartyTemplate {

	public $template = "";
	protected $views = array();
	protected $me = null;
	protected $error_info = array();
	
	public function before() {
		self::loadConfig();
		$seg1 = Uri::segment(1);
		$seg2 = Uri::segment(2);
		$controller = (empty($seg1)) ? "index" : $seg1;
		$method = (empty($seg2)) ? "index": $seg2;
		// templateを動的に決定後、親処理を呼び出す。
		if(empty($this->template)){
			$factor = $controller.'.'.$method;
			$this->template = self::getLayout($factor);
		}
		try {
			parent::before();
		} catch (FuelException $e) {
			$this->error_info[] = $e;
		}

		/* セッションからユーザーデータを取得 */
		View::set_global('me', Session::get("me"));
		$this->me = Session::get("me");
		

		if(is_object($this->template)) {
			// titleの初期値を「controller.action」に設定
			$this->template->title = Util_Config::getTitle($controller.'.'.$method);
		}

		try {
			$this->template->content = View_Smarty::forge($controller.DS.$method);
			$this->commonData();
		} catch(FuelException $e) {
			$this->error_info[] = $e;
		}
	}

	/**
	 * ユーザ行動履歴を挿入する
	 * @param type $response
	 * @return type
	 */
	public function after($response) {
		if(Recomatch_Util::isLogin()) {
			// 管理者以外なら行動記録
			if(!Model_User::isAdmin($this->me)) {
				$uah = Model_UserActionHistory::insert($this->me->id);
			}
		} else {
			$uah = Model_UserActionHistory::insert();
		}
		
		return parent::after($response);
	}

	private function commonData() {
		View::set_global("features_right", Model_Feature::getAll(2));
		
		$matomes_right = self::getRightContents("matome");
		if(count($matomes_right) <= 0) {
			$matomes_right = array();
		}
		View::set_global("matomes_right", $matomes_right);
		View::set_global("ranking_list", Model_Myreco::getMyrecoRegistRanking());
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

	/**
	 * 設定情報によりレイアウトを取得する
	 * 引数に指定された設定情報がない場合
	 * 1.active.controller.defaultを返す
	 * 2.active.defaultを返す
	 * 
	 * @param string $factor 形式：controller.method
	 * @return string 使用するレイアウトのパス
	 */
	public static function getLayout($factor) {
		$layout = self::getConfig("layout", $factor);
		return $layout;
	}
	
	private static function getConfig($kind, $factor) {
		$active = Config::get($kind.'.active');

		// 引数から文字列を分離
		list($controller, $method) = explode('.', $factor);
		
		// 指定されたacitiveごとのkindを取得
		$config = Config::get($kind.'.' . $active . "." . $factor);

		// 指定されたcommonのkindを取得
		if(is_null($config)) {
			$config = Config::get($kind.'.common.'.$factor);
		}

		// それぞれのactiveのcontroller.defaultを取得
		if(is_null($config)) {
			$config = Config::get($kind.'.'.$active.'.'.$controller.'.default');
		}
		
		// commonのcontroller.defaultを取得
		if(is_null($config)) {
			$config = Config::get($kind.'.common.'.$controller.'.default');
		}
		
		// 設定が見つからなければ、kind/controllerとして設定
		if(is_null($config)) {
			$config = $kind.'/'.$controller;
		}
		
		return $config;		
	}
	
	
	private static function getRightContents($kind, $limit = 2) {
		$cache_name = $kind.".right";
		try {
			$features_right = Cache::get($cache_name);
		} catch (CacheNotFoundException $e) {
			$model = "Model_".ucfirst($kind);
			$features_right = $model::find("all", array(
				"order_by" => array('id' => "DESC"),
				"limit" => $limit,
			));
			
			// キャッシュの期限は無期限
			Cache::set($cache_name, $features_right);
		}
		
		return $features_right;
	}
	
}
