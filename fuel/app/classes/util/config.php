<?php

/**
 * configファイルを便利に使うためのユーティリティ
 */
class Util_Config {

	/**
	 * ページに応じたper_page（1ページに何個表示するか）を取得する
	 * @param string $factor controller.methodの形式
	 * @return int per_pageの数 
	 */
	public function getPerPage($factor) {
		Config::load('per_page', true);
		
		// pc or mobile
		$active = Config::get('per_page.active');
		$per_page = Config::get('per_page.' . $active . "." . $factor);
		
		// if per_page equal null. Then use default
		if(is_null($per_page)) {
			$per_page = Config::get('per_page.'.$active.'.default');
		}
		
		return Intval($per_page);
	}
	
	/**
	 * get page title
	 * @param string $factor form => controller.method
	 * @param array $rep_list replace array
	 * @return string title string
	 */
	public static function getTitle($factor, array $rep_list = array()) {
		Config::load('title', true);
		$title = Config::get('title.' . $factor);
		
		// replace title with rep_list
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
		Config::load('layout', true);
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
	
	public static function getKeywords($factor) {
		Config::load('keywords', true);
		$keywords = Config::get($factor);
	}
}
