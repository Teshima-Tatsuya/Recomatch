<?php

class Model_Community_Page extends \Orm\Model
{

	protected static $_properties = array(
		'id',
		'user_id' => [
			'default' => 0	// guest
		],
		'community_id',
		'title',
		'comment',
		'like_num' => [
			'default' => 0,
		],
		'item_id' => [
			'default' => -1,
		],
		'movie_id' => [
			'default' => -1,
		],
		'created_at',
		'updated_at',
	);
	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);
	protected static $_table_name = 'community_page';

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('user_id', 'ユーザID', 'valid_string[numeric]');
		$val->add_field('community_id', 'コミュニティID', 'required|valid_string[numeric]');
		$val->add_field('title', 'タイトル', 'required');
		$val->add_field('comment', 'コメント', 'required');

		return $val;
	}

	public static function insert(Dto\Community\Page $dto)
	{
		$data = [
			'user_id' => $dto->userId(),
			"community_id" => $dto->communityId(),
			"title" => $dto->title(),
			'comment' => $dto->comment(),
			'item_id' => $dto->itemId(),
			'movie_id' => $dto->movieId()
		];
		$self = self::forge($data);
		$self->save();

		$result = new Dto\Community\Page();
		$result->id($self->id);
		$result->id($self->user_id);
		$result->title($self->title);
		$result->communityId($self->community_id);
		$result->comment($self->comment);
		$result->itemId($self->item_id);
		$result->movieId($self->movie_id);
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
