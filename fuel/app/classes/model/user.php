<?php

class UserAlreadyExistsException extends Exception {
	public function __construct($user_name) {
		$message = $user_name . "のユーザーは既に存在しています。";
		parent::__construct($message);
	}
	
}

class UserNotExistsException extends Exception {
	public function __construct($user_name) {
		$message = $user_name . "は存在しません。";
		parent::__construct($message);
	}
	
}

class Model_User extends MyOrm {
	const USER_GUEST = 0;

	protected static $_table_name = 'user';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'app_id',
		'name',
		'user_id',
		'password',
		'screen_name',
		'oauth_token',
		'oauth_token_secret',
		'login_app',
		'app_user_link',
		'role' => array(
			'default' => 1
		),
		'created_at',
		'updated_at',
		'id',
	);
	
	protected static $_has_one = array(
		'auto_login' => array(
			'key_from' => 'id',
			'model_to' => 'Model_AutoLogin',
			'key_to' => 'user_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
	);	
	
	private static function getTwitterImageUrl($screen_name, $size = 'large') {
		$sizeArray = array('mini' => 'mini',
			'small' => 'normal',
			'normal' => 'bigger',
			'large' => 'original',
		); //24, 48, 73, original
		$base_url = "http://www.paper-glasses.com/api/twipi/$screen_name/$sizeArray[$size]";
		return $base_url;
	}

	private static function getFacebookImageUrl($app_id, $size = 'large') {
		$sizeArray = array('mini' => 'square',
			'small' => 'small',
			'normal' => 'normal',
			'large' => 'large',
		); //50, 50, 100, 200
		$base_url = 'https://graph.facebook.com/';
		return $base_url . $app_id . '/picture?type=' . $sizeArray[$size];
	}

	public static function getUserImageUrl($user_id, $size = 'large') {
		static $cache = array();
		$url = "";

		$user = static::find($user_id);
		if(is_null($user)) {
			$url = Config::get('base_url') . 'assets/img/guest.png';
		} else if (!isset($cache[$user->id])) {
			if ($user->login_app === 'twitter') {
				$url = static::getTwitterImageUrl($user->screen_name, $size);
			} else if ($user->login_app === 'facebook') {
				$url = static::getFacebookImageUrl($user->app_id, $size);
			} else {
				$url = Config::get('base_url') . 'assets/img/guest.png';
			}

			$cache[$user->id] = $url;
		} else {
			$url = $cache[$user->id];
		}


		return $url;
	}

	public static function getUser($user_id) {
		return self::getObj($user_id);
	}

	public static function getName($user_id) {
		$user = self::getUser($user_id);
		$name = "";

		if (!is_null($user)) {
			$name = $user->name;
		} else {
			$name = "Guest";
		}

		return $name;
	}

	/**
	 * app_idで検索した結果、存在すれば、そのままデータをインサートして、
	 * そうでなければアップデート
	 * @param type $data 検索するIDとアップデートするデータ
	 * @return type Model_User オブジェクト
	 */
	public static function updateOrInsert($data) {
		$user = self::find('first', array(
				'where' => array(
					'app_id' => $data["app_id"],
				),
		));

		if (empty($user)) {
			$user = self::forge($data);
			$user->save();
		} else {
			foreach ($data as $key => $v) {
				$user->set($key, $v);
			}
			$user->save();
		}
		
		return $user;
	}
	
	/**
	 * ユーザーの新規登録
	 * すでに同じ名前のユーザーが存在する場合はエラー
	 * @param type $data
	 * @return type
	 */
	public static function register($data) {
		$user = self::find('first', array(
				'select' => array('user_id'),
				'where' => array(
					'user_id' => $data["user_id"],
				),
		));

		// ユーザーが存在しない場合は新規登録
		if (empty($user)) {
			$user = self::forge($data);
			$user->save();
		} else {
			throw new UserAlreadyExistsException($data["user_id"]);
		}
		
		return $user;		
	}
	
	/**
	 * ユーザが管理者かどうかを判別する
	 * @param Model_User $user
	 * @return boolean
	 */
	public static function isAdmin(Model_User $user) {
		if($user->role == Recomatch_Constants::ROLE_ADMIN) {
			return true;
		}
		
		return false;
	}

}
