<?php

class Model_Community extends \Orm\Model
{

	protected static $_properties = [
		'id',
		'title',
		'comment',
		'comment_num' => [
			'default' => 0,
		],
		'like_num' => [
			'default' => 0,
		],
		'item_id' => [
			'default' => -1,
		],
		'created_at',
		'updated_at',
	];

	protected static $_observers = [
		'Orm\Observer_CreatedAt' => [
			'events' => ['before_insert'],
			'mysql_timestamp' => false,
		],
		'Orm\Observer_UpdatedAt' => [
			'events' => ['before_update'],
			'mysql_timestamp' => false,
		   ],
	];
	protected static $_table_name = 'community';
	
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('title', 'タイトル', 'required|max_length[200]');
		$val->add_field('comment', 'コメント', 'required');
		
		return $val;
	}

	public static function insert(Dto\Community $dto)
	{
		$data = ['title' => $dto->title(),
			'comment' => $dto->comment(),
			'comment_num' => $dto->commentNum(),
			'like_num' => $dto->likeNum(),
			'item_id' => $dto->itemId(),
		];

		$self = self::forge($data);
		$self->save();

		$result = new Dto\Community();
		$result->id($self->id);
		$result->title($self->title);
		$result->comment($self->comment);
		$result->ItemId($self->item_id);
		$result->createdAt($self->created_at);

		return $result;
	}

	/**
	 * $idに対応するオブジェクトに対して、LikeNumをインクリメントする。
	 * オブジェクトが見つからない場合はnullを返す。
	 * 見つかった場合は、インクリメント後のオブジェクトを返す。
	 * @param type $id ID
	 * @return Model_Community_Page
	 */
	public static function incrementLikeNum($id) {
		$self = self::find($id);
		
		if(is_null($self)) {
			return null;
		}
		
		$self->like_num += 1;
		$self->save();
		
		return $self;
	} 	
}
