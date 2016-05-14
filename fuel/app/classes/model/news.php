<?php

class Model_News extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'url',
		'comment',
		'user_id',
		'myreco_id' => array(
			'default' => -1,
		),
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => true,
		),
	);
	protected static $_table_name = 'news';

	public static function add(DTO_News $newsDTO) {
		$data = array(
			'url' => $newsDTO->getUrl(),
			'comment' => $newsDTO->getComment(),
			'user_id' => $newsDTO->getUserId(),
			'myreco_id' => $newsDTO->getMyrecoId(),
		);
		
		$self = self::forge($data);
		$self->save();
		
		return $self;
	}
}
