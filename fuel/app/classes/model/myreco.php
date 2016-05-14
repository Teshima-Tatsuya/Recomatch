<?php

class Model_Myreco extends MyOrm {

	protected static $_table_name = 'myreco';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'user_id',
		'title',
		'title_ngram',
		'category_id',
		'comment',
		'comment_num' => array(
			'default' => 0
		),
		'bookmark_num' => array(
			'default' => 0
		),
		'good_num' => array(
			'default' => 0
		),
		'movie_num' => array(
			'default' => 0
		),
		'item_id' => array(
			'default' => -1
		),
		'movie_id' => array(
			'default' => -1
		),
		'created_at',
		'updated_at',
		'id',
	);
	
	protected static $_has_many = array(
		'tags' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Myreco_Tag',
			'key_to' => 'myreco_id',
			'cascade_save' => true,
			'cascade_delete' => true,
			'conditions' => array(
				'order_by' => array(
					'created_at' => 'DESC',
				)
			)
		),
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
	 * マイレコとタグの登録
	 * @param DTO_Myreco $myreco　マイレコのDTO
	 * @param type $tags タグ文字列
	 * @return type 生成したマイレコ情報
	 */
	public static function add(DTO_Myreco $myrecoDTO, $tags) {
		$data = array(
			'user_id' => $myrecoDTO->getUserId(),
			'title' => $myrecoDTO->getTitle(),
			'title_ngram' => Util_NGram::build($myrecoDTO->getTitle()),
			'category_id' => $myrecoDTO->getCategoryId(),
			'comment' => $myrecoDTO->getComment(),
			'comment_ngram' => Util_NGram::build($myrecoDTO->getComment()),
			'item_id' => $myrecoDTO->getItemId(),
			'movie_id' => $myrecoDTO->getMovieId(),
		);

		$myreco = self::forge($data);
		$myreco->save();
		// タグの登録
		Model_Myreco_Tag::addTags($myreco, $tags);

		return $myreco;
	}

	/**
	 * ID指定されたマイレコを削除
	 * @param type $id マイレコID
	 * @return type boolean
	 */
	public static function remove($myreco_id, $user_id) {
		$result = false;

		$self = self::find('first', array(
			'select' => array('id'),
			'where' => array(
				'id' => $myreco_id,
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

	/**
	 * カテゴリID（ユーザID）を元にマイレコを取得
	 * @param type $category_id
	 * @param type $user_id
	 * @return type
	 */
	public static function getByCategoryId($category_id, $user_id = null, $limit = null, $offset = null) {
		$condition = array(
			'order_by' => array('created_at' => 'DESC'),
		);
		
		if(!is_null($limit)) {
			$condition += array('limit' => $limit);
		}
		if(!is_null($offset)) {
			$condition += array('offset' => $offset);
		}

		$where = array(
					array('category_id', $category_id),
				);
		
		if(!is_null($user_id)) {
			$where += array('user_id', $user_id);
		}
		
		$condition += array('where' => $where);
		

		$self = self::find('all', $condition);
		
		return $self;
	}

	public static function getByTag($tag, $limit = null, $offset = null) {
		$myreco_ids = Model_Myreco_Tag::getMatchIds($tag);

		return self::getUsesIn($myreco_ids, 'id', $limit, $offset);
	}
	
	public static function countByTag($tag, $limit = null, $offset = null) {
		$myreco_ids = Model_Myreco_Tag::getMatchIds($tag);

		return count($myreco_ids);
	}

	public static function getFavorites($user_id, $limit = null, $offset = null) {
		$myreco_ids = Model_Favorite::getMyrecoIds($user_id);
		
		return self::getUsesIn($myreco_ids, 'id', $limit, $offset);
	}
	
	public static function getFollows($user_id, $limit = null, $offset = null) {
		$follow_users = Model_FollowList::getFollowUsers($user_id);
		
		$user_ids = array();
		foreach($follow_users as $follow_user) {
			array_push($user_ids, $follow_user->id);
		}
		
		$myrecos = self::getUsesIn($user_ids, 'user_id', $limit, $offset);
		return $myrecos;
	}
	
	/**
	 * マイレコの登録数を取得する
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
	
	public static function getMyrecoRegistRanking() {
		$query = DB::query(DB::expr(
			'SELECT user_id, COUNT(*) as count'.
			' FROM myreco'.
			' GROUP BY user_id'.
			' ORDER BY count DESC'.
			' LIMIT 10'
			));
		
		$ranking_list = $query->execute()->as_array();
		
		return $ranking_list;
	}
}
