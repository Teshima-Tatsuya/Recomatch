<?php

class Model_FollowList extends MyOrm implements Model_IButton {
	protected static $_table_name = 'follow_list';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'follow_user_id',
		'follower_user_id',
		'created_at',
		'updated_at',
		'id',
	);

 	/**
         * 
         * @brief フォローリスト追加
         * 
         * フォローするユーザIDとフォローされるユーザIDを用いて<br>
         * フォローリストのカラムを作成しDBに追加する。
         * 
         * @param type $follow_user_id
         * @param type $follower_user_id
         * @return 取得したレコード(見つかったレコード)
         */
        public static function add($follow_user_id, $follower_user_id) {
		// 未ログインならば処理せず
		if(!Recomatch_Util::isLogin()) {
			return;
		}
		
		// フォロー対象が自分ならば処理せず
		if(Recomatch_Util::isMine($follower_user_id)) {
			return;
		}
		
		$data = array(
			'follow_user_id' => $follow_user_id,
			'follower_user_id' => $follower_user_id,
		);
		
		$find = self::find('first', array(
			'where' => array(
				array('follow_user_id', $follow_user_id),
				array('follower_user_id', $follower_user_id),
			),
		));
		
		// すでに登録済みならば、見つかったレコードを返却
		if(!is_null($find)) {
			return $find;
		}
		
		$self = self::forge($data);
		$self->save();
		
		return $self;
	}
         /**
         * 
         * @brief フォローリスト削除
         * 
         * フォローするユーザIDとフォローされるユーザIDを用いて<br>
         * フォローリストのカラムを削除する。
         * 
         * @param type $follow_user_id
         * @param type $follower_user_id
         * @return boolean
         */
	public static function remove($follow_user_id, $follower_user_id) {
		// 未ログインならば処理せず
		if(!Recomatch_Util::isLogin()) {
			return;
		}
		
		$where = array(
			'follow_user_id' => $follow_user_id,
			'follower_user_id' => $follower_user_id,
		);
		
		$row = self::find('first', array(
			'where' => $where,
		));
		
		if(!is_null($row)) {
			$row->delete();
			return true;
		} else {
			return false;
		}
	}
	
	public static function getFollowUsers($user_id, $limit = null, $offset = null){
		$where = array(
			array('follow_user_id', $user_id),			
		);
		$ids = self::getIds('follower_user_id', $where);
		$users = Model_User::getUsesIn($ids, 'id', $limit, $offset);
		
		return $users;
	}

	public static function getFollowerUsers($user_id, $limit = null, $offset = null){
		$where = array(
			array('follower_user_id', $user_id),			
		);
		$ids = self::getIds('follow_user_id', $where);
		$users = Model_User::getUsesIn($ids, 'id', $limit, $offset);
		
		return $users;
	}

	/**
	 * すでにボタンを押されていればtrueを返す
	 * @param type $contents_id 調査したいコンテンツID
	 * @param type $contents_kind コンテンツの種類
	 * @param type $user_id 調査したいユーザ
	 * @return type boolean
	 */
	public static function isPushed($user, $user_id) {
		$find = self::find('first', array(
			'where' => array(
				array('follow_user_id', $user_id),
				array('follower_user_id', $user->id),
			),
		));
		
		return !is_null($find); 
	}
}
