<?php

class Controller_Login extends MyController {
	private static $RETURN_PATH = '/';
	
	public function before() {
		parent::before();
		if(Recomatch_Util::isLogin() && Uri::segments(2) === "logout") {
			Response::redirect(self::$RETURN_PATH);
		}
	}

	public function action_index() {
		Session::set('referrer', Input::referrer());
	}
	
	/**
	 * 指定されたプロバイダに対してログインを行う。
	 * @param type $provider ログインを行うアプリの種類
	 */
	public function action_login($provider = null) {
		$config = Config::load('opauth', 'opauth');
		$opauth = new Opauth($config, TRUE);
	}
	
	public function action_callback() {
		Auth_Login::callback();
	}

	public function action_twitter() {
		Response::redirect('login/login/twitter');
	}

	public function action_facebook() {
		Response::redirect('login/login/facebook');
	}
	
	private function normal_login($input){
		$user = Model_User::find('first', array(
			'select' => array('user_id','password'),
			'where' => array(
				'user_id' => $input['id'],
		//'password' => Crypt::encode($input['password']),　なんかうまくいかない
				),
			));
		Log::info(DB::last_query());
				// ユーザーが存在しない場合は新規登録
		if (empty($user)) {
			throw new UserNotExistsException($user->id);
		} else {
					// なんかうまくいかない
			if(Crypt::decode($user->password) !== $input['password']){
				Log::info("login from normal user_id:".Crypt::decode($user->password)." name:".$input['password']);
						// ユーザないって言ってるけど、パスワードミスです。
				throw new UserNotExistsException($user->id);
			}
		}

		return $user;

	}

	public function action_normal() {

		$id = Input::post("id");
		$password = Input::post("password");

		$val = Validation::forge();

				// IDには「英数字、-_」を許容する
		$val->add('id', 'ID')
		->add_rule('required')
		->add_rule('min_length', 4)
		->add_rule('max_length', 32)
		->add_rule('valid_string', ['alpha', 'numeric', 'dashes']);

				// パスワードには「英数字、.,!?:;」を許容する
		$val->add('password', 'パスワード')
		->add_rule('required')
		->add_rule('min_length', 8)
		->add_rule('max_length', 32)
		->add_rule('valid_string', ['alpha', 'numeric','pounctuation']);

				// ヴァリデーション成功
		if($val->run()) {
			$input = $val->validated();
		} else {
			// ヴァリデーション失敗
			Session::set_flash('form_input', Input::post());
			Session::set_flash('errors', $val->error());

			Response::redirect("/login");
		}
		
		if($_POST['new']){
			 // 新規登録ボタン押下時
			try {
				$user = Auth_Login::register($input['id'], $input['password']);
			} catch (UserAlreadyExistsException $e) {
				// ヴァリデーション失敗
				Session::set_flash('form_input', Input::post());
				Session::set_flash('errors', array($e->getMessage()));

				Response::redirect("/login");
			}
		} else {
			// ログインボタン押下時
			try {
				$user = Auth_Login::normal($input['id'], $input['password']);
			} catch (UserNotExistsException $e) {
				// ヴァリデーション失敗
				Session::set_flash('form_input', Input::post());
				Session::set_flash('errors', array("ユーザIDかパスワードが間違っています。"));

				Response::redirect("/login");
			}
		}
		Log::info("login from normal user_id:".$user->id." name:".$user->user_id);
		// 自動ログイン用のデータを作成
		// 自動ログイン用のCokkieも同時にセット
		Model_AutoLogin::insert($user->id);

		Session::set('me', $user);

		// ログイン処理
		$referrer = Session::get('referrer', self::$RETURN_PATH);
		Session::delete('referrer');
		
		if(empty($referrer)) {
			$referrer = self::$RETURN_PATH;
		}

		Response::redirect($referrer);
	}

	public function action_logout() {
		Auth_Login::logout();
	}
}
