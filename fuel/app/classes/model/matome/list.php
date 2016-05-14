<?php

class Model_Matome_List extends \Orm\Model {
	
	protected static $_table_name = 'matome_list';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'user_id',
		'title',
		'title_ngram',
		'good_num' => array(
			'default' => 0,
		),
		'bookmark_num' => array(
			'default' => 0,
		),
		'created_at',
		'updated_at',
		'id',
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
	
	public static function add(DTO_Matome_List $dto) {
		$data = array(
			'user_id' => $dto->getUserId(),
			'title' => $dto->getTitle(),
			'title_ngram' => Util_Ngram::build($dto->getTitle()),
		);
		$self = self::forge($data);
		$self->save();
		
		return $self;
	}

}
