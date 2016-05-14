<?php

class OpauthErrorException extends Exception {
}

class Auth_Login {

	/**
	 * リファラが存在しない場合にログイン後に遷移するパス
	 * @var type 遷移パス
	 */
	private static $RETURN_PATH = '/';

	public function callback() {
		$config = Config::load('opauth', 'opauth');
		$opauth = new Opauth($config, false);

		switch ($opauth->env['callback_transport']) {
			case 'session':
				session_start();
				$response = $_SESSION['opauth'];
				unset($_SESSION['opauth']);
				break;
		}

		if (array_key_exists('error', $response)) {
			throw new OpauthErrorException("認証に失敗しました");
		} else {
			if (empty($response['auth']) || empty($response['timestamp']) || empty($response['signature']) || empty($response['auth']['provider']) || empty($response['auth']['uid'])) {
				throw new OpauthErrorException("認証に失敗しました。認証に必要な情報がありません。");
			} else if (!$opauth->validate(sha1(print_r($response['auth'], true)), $response['timestamp'], $response['signature'], $reason)) {
				throw new OpauthErrorException("認証に失敗しました。タイムスタンプが不正です。");
			}

			if (strtolower($response['auth']['provider']) === 'twitter') {
				// Twitterの時の処理
				$me = self::twitter($response);
			} else if (strtolower($response['auth']['provider']) === 'facebook') {
				// Facebookの時の処理
				$me = self::facebook($response);
			}

			Session::set('me', $me);

			// 自動ログイン用のデータを作成
			// 自動ログイン用のCokkieも同時にセット
			Model_AutoLogin::insert($me->id);

			$referrer = Session::get('referrer', self::$RETURN_PATH);
			Session::delete('referrer');

			Response::redirect($referrer);
		}

		return Response::forge("error");
	}

	/**
	 * レコマッチからのログイン
	 * @param type $id ユーザID
	 * @param type $raw_passoword 生パスワード
	 * @return type ユーザオブジェクト
	 * @throws UserNotExistsException
	 */
	public static function normal($id, $raw_password) {
		$user = Model_User::find('first', array(
				'select' => array('user_id', 'password'),
				'where' => array(
					'user_id' => $id,
					'password' => Crypt::encode($raw_password)
				),
		));

		if (empty($user)) {
			throw new UserNotExistsException($id);
		}

		return $user;
	}

	/**
	 * ユーザの新規登録
	 * 既に登録されていた場合は例外を投げる。
	 * @param type $input フォームからのデータ
	 * @return type ユーザオブジェクト
	 * @throws UserAlreadyExistsException
	 */
	public static function register($id, $raw_password) {
		$data = array(
			'user_id' => $id,
			'name' => $id,
			'password' => Crypt::encode($raw_password),
			'login_app' => 'normal'
			);
		try {
			$user = Model_User::register($data);
		} catch(UserAlreadyExistsException $e) {
			throw $e;
		}
		return $user;
	}

	/**
	 * ログアウト処理を行い、セッションと自動ログイン用のクッキーを削除する
	 * @param type $redirect リダイレクト先のURL
	 */
	public function logout($redirect = "/") {

		// セッションを破棄
		Session::destroy();

		// cookieを破棄
		Cookie::delete('autoLoginKey');

		Response::redirect($redirect);
	}

	/**
	 * twitterのログイン処理
	 * @param type $response opauthから取得したresponse
	 * @return type ユーザオブジェクト
	 */
	public static function twitter($response) {
		$twitter_data = $response['auth']['raw'];
		$access_token = $response['auth']['credentials'];
		$base_url = "https://twitter.com/";

		// 暗号化して、データベースに格納
		// 複合するときは、decodeを用いる
		$data = array(
			'app_id' => $twitter_data['id'],
			'name' => $twitter_data['name'],
			'screen_name' => $twitter_data['screen_name'],
			'oauth_token' => Crypt::encode($access_token['token']),
			'oauth_token_secret' => Crypt::encode($access_token['secret']),
			'login_app' => 'twitter',
			'app_user_link' => $base_url . $twitter_data['screen_name'],
		);

		$user = Model_User::updateOrInsert($data);

		Log::info("login from twitter user_id:" . $user->id . " name:" . $user->name);

		return $user;
	}

	/**
	 * facebookのログイン処理
	 * @param type $response opauthから取得したresponse
	 * @return type ユーザオブジェクト
	 */
	public static function facebook($response) {
		$facebook_data = $response['auth']['raw'];
		$access_token = $response['auth']['credentials'];

		$data = array(
			'app_id' => $facebook_data['id'],
			'name' => $facebook_data['name'],
			'oauth_token' => Crypt::encode($access_token['token']),
			'login_app' => 'facebook',
			'app_user_link' => $facebook_data['link'],
		);

		$user = Model_User::updateOrInsert($data);

		Log::info("login from facebook user_id:" . $user->id . " name:" . $user->name);

		return $user;
	}
}
