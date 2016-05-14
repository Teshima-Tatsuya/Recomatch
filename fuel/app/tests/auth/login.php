<?php
/**
 * @group App
 * @group Auth
 */
class Test_Auth_LoginTest extends TestCase
{
	
	public function test_twitter()
	{
	}

	public function test_logout()
	{
	}

	/**
	 * ユーザの新規登録テスト
	 */
	public function test_registerUserNotExists()
	{
		// testユーザーの登録
		$user_id = "test_registerUserNotExists";
		$password = "password";

		try {
			$user = Auth_Login::register($user_id, $password);
		} catch(UserAlreadyExistsException $e) {
			// ユーザが存在していないのに、存在していると失敗
			$this->fail("ユーザーが存在しています。");
		}

		$user = Model_User::find('first', array(
			'select' => array("user_id"),
			'where' => array(
				'user_id' => $user_id,
				'password' => Crypt::encode($password),
			),
		));
		
		$this->assertNotNull($user);
		
		
		// テスト後に削除
		$user->delete();
		
	}

	/**
	 * ユーザが存在する場合のログイン
	 */
	public function test_normalUserExists()
	{
		// testユーザーの登録
		$user_id = "test_normal";
		$password = "password";

		try {
			$user = Auth_Login::register($user_id, $password);
		} catch(UserAlreadyExistsException $e) {
		}

		// 実際のテスト
		$user = Auth_Login::normal($user_id, $password);
		
		$this->assertNotNull($user);
	}
	
	/**
	 * ユーザが存在しない場合のログイン
	 * @expectedException UserNotExistsException
	 */
	public function test_normalUserNotExists()
	{
		// testユーザーの登録
		$user_id = "test_normalNotExists";
		$password = "password";
		$user = Auth_Login::normal($user_id, $password);
		
		
		$this->assertNull($user);
	}

	public function test_facebook()
	{
	}

	public function test_normal_login()
	{
	}

	public function test_action_callback()
	{
	}

	
}
