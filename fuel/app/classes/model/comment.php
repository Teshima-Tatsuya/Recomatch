<?php

class Model_Comment extends \Orm\Model {

	protected static $_table_name = 'comment';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'user_id',  // コメンターのID 
		'myreco_id', // マイレコのID
		'comment', // コメント内容
		// 画像ID
		'item_id' => array(
			'default' => -1
		),
		'created_at', // 作成日時
		'updated_at', // 更新日時
		// Good数
		'good_num' => array(
			'default' => 0
		),
		// お気に入り数
		'favorite_num' => array(
			'default' => 0
		),
		'id', // 回答自体のID
	);
	protected static $_belongs_to = array(
		'myreco' => array(
			'model_to' => 'Model_Myreco',
			'key_from' => 'question_id', 
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	protected static $_has_one = array(
		'item' => array(
			'key_from' => 'item_id',
			'model_to' => 'Model_Item',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
	);
	

	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
			'property' => 'created_at',
		),
		'Orm\\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => true,
			'property' => 'updated_at',
		),
	);
	
	public static function add(DTO_Comment $commentDTO) {
		$data = array(
			'user_id' => $commentDTO->getUserId(),
			'myreco_id' => $commentDTO->getMyrecoId(),
			'comment' => $commentDTO->getComment(),
		);
		
		$comment = self::forge($data);
		$comment->save();
		
		return $comment;
	}

	public static function getNum($user_id) {
		$count = static::count(array(
					'where' => array(
						array('user_id', $user_id),
					),
		));

		return $count;
	}

	public static function getAt($comment_id) {
		return self::find($comment_id);
	}
	
	public static function getAll($per_page = "", $offset = "") {
		$res = self::find('all', array(
				'order_by' => array('created_at' => 'DESC'),
				'limit' => $perPage,
				'offset' => $offset,
		));
		
		return $res;
	}
}
