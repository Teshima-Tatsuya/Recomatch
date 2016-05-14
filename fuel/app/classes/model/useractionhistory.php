<?php

class Model_UserActionHistory extends MyOrm {

	protected static $_table_name = 'user_action_history';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'user_id',
		'ip_address',
		'visit_page',
		'visit_time',
		'id',
	);
        
        /* データベースのリレイション */
        /* データベースのユーザーIDと、ユーザーテーブルのユーザーIDを関連付ける */
	protected static $_belongs_to = array(
		'user' => array(
			'model_to' => 'Model_User',
			'key_from' => 'user_id',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
        
	/**
	 * 行動履歴を挿入する。
	 * $visit_pageには、Uri::string()を用いる
	 * Queryストリングは含めない。
	 * @param int $user_id 行動を記録するユーザID
	 * @param string $visit_page 訪問ページ　入力例：「controller/method/param1」
	 * @return boolean
	 */
	public static function insert($user_id = 0, $visit_page = null) {
		if(is_null($visit_page)) {
			$visit_page = Uri::string();
		}
		$data = array(
			'user_id' => $user_id,
			'ip_address' => Input::real_ip(true),
			'visit_page' => $visit_page,
		);
		
		$obj = self::forge($data);
		
		try {
			$obj->save();
		} catch(Exception $e) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * 
	 * @param string $page
	 */
	public static function getPageView($page) {
		$count = static::query()->where('visit_page', $page)->count();
		
		return $count;
	}
}