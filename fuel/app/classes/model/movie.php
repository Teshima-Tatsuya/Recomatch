<?php

/**
 * @brief Movieデータモデル
 * 
 * ムービーのモデル。
 * 
 */
class Model_Movie extends MyOrm {
	protected static $_table_name = 'movie';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'movie_id', /* !< youtubeの動画ID */
		'user_id',
		'title', 
		'contents_type',
		'comment', // 動画に対するコメント
		'good_num'=> array(
			'default' => 0
		), 
		'bookmark_num'=> array(
			'default' => 0
		), 
		'created_at', /* !< 作成日時 */
		'updated_at', /* !< 更新日時 */
		'id'
	);

	// リレーション1対1…画像:マイレコ
	protected static $_belongs_to = array(
		'myreco' => array(
			'model_to' => 'Model_myreco',
			'key_from' => 'id',
			'key_to' => 'movie_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
	);
	
	protected static $_has_many = array(
		'infos' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Info',
			'key_to' => 'contents_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
		'goods' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Good',
			'key_to' => 'contents_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
		'favorites' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Favorite',
			'key_to' => 'contents_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),		
	);

	/**
	 * 
	 * @brief movieの追加
	 * 
	 * @param type $item_data
	 */
	public static function add(DTO_Movie $movieDTO) {
		$self = self::forge(array(
			'movie_id' => $movieDTO->getMovieId(),
			'title' => $movieDTO->getTitle(),
			'contents_type' => $movieDTO->getContentsType(),
			'comment' => $movieDTO->getComment(),
			'user_id' => $movieDTO->getUserId(),
		));
		
		$self->save();
		return $self;
	}
	
	/**
	 * ID指定されたムービーを削除
	 * @param type $id ムービーID
	 * @return type boolean
	 */
	public static function remove($movie_id, $user_id) {
		$result = false;

		$self = self::find('first', array(
			'select' => array('id'),
			'where' => array(
				'id' => $movie_id,
				'user_id' => $user_id,
			),
		));

		// レコードが見つかれば、削除
		if (!is_null($self)) {
			try {
				$self->delete();
				$result = true;
			} catch(Exception $e) {
				$result = false;
			}
		}

		return $result;
	}
	
	
	public static function getMovieId($id) {
		return self::getObj($id)->movie_id;
	}
	
	public static function parseMovieId($movie_url) {
		$movie_id = -1;	// youtubeの動画ID

		if(preg_match("/v=(.+)/", $movie_url, $matches)){
			$movie_id = $matches[1];
			$movie_id = preg_replace("/(.+)&(.+)/", "$1", $movie_id);
		}
		if(preg_match("/youtu.be\/(.+)(&?)/", $movie_url, $matches)){
			$movie_id = $matches[1];
		}
		
		return $movie_id;
	}

	/**
	 * ムービーの登録数を取得する
	 * @param type $user_id 数を取得したいユーザID
	 * @return type int
	 */
	public static function getNum($user_id) {
		$count = static::count(array(
					'where' => array(
						array('user_id', $user_id),
					),
		));

		return $count;
	}
	
	public static function getFavorites($user_id, $limit = null, $offset = null) {
		$myreco_ids = Model_Favorite::getMovieIds($user_id);
		
		return self::getUsesIn($myreco_ids, 'id', $limit, $offset);
	}
	
	/**
	 * フォローしているユーザのムービー一覧を得る
	 * @param type $user_id 一覧を得たいユーザID
	 * @param type $limit 取得上限
	 * @param type $offset 取得オフセット
	 * @return type ムービー一覧
	 */
	public static function getFollows($user_id, $limit = null, $offset = null) {
		$follow_users = Model_FollowList::getFollowUsers($user_id);
		
		$user_ids = array();
		foreach($follow_users as $follow_user) {
			array_push($user_ids, $follow_user->id);
		}
		$where = ['contents_type' => Recomatch_Constants::CONTENTS_MOVIE];
		$movies = self::getUsesIn($user_ids, 'user_id', $limit, $offset, $where);
		return $movies;
	}

}
