<?php

class Model_AutoLogin extends MyOrm {

	protected static $_table_name = 'auto_login';
	protected static $_primary_key = array('user_id');
	protected static $_properties = array(
		'user_id',
		'auto_login_key',
		'expire'
	);
        
        /* データベースのリレイション */
        /* データベースのユーザーIDと、ユーザーテーブルのユーザーIDを関連付ける */
	protected static $_has_one = array(
		'user' => array(
			'model_to' => 'Model_User',
			'key_from' => 'user_id', #key_fromは自身のテーブルを表す。この場合tagテーブル
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
        
	public static function insert($user_id = null) {
		/* sha1(ハッシュ関数)で自動ログインの鍵を生成 */
		$key = sha1(uniqid() . mt_rand() . time());

		/* Cookieの有効時間（いつまで保持するか） */
		$expire = time() + 3600 * 24 * 365;

		/* expireをデータベースに入れるためのフォーマット */
		$date = date("Y-m-d H:i:s", $expire);

		/* cookieの生成 */
		Cookie::set('autoLoginKey', $key, $date);

		// DBからデータを取得
		$dbFindData = static::find(array(
				'user_id' => $user_id,
		));

		//DBデータがnullならばインサート
		//そうでなければアップデート
		if ($dbFindData == null) {
			/* データベースに、生成した鍵を挿入 */
			$dbData = static::forge(array(
					'user_id' => $user_id,
					'auto_login_key' => $key,
					'expire' => $expire
				)
			);
			$dbData->save();
		} else {
			$dbFindData->set(array(
				'auto_login_key' => $key,
				'expire' => $expire
				)
			);
			$dbFindData->save();
		}

	}
}