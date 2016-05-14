<?php

class Model_Matome_Contents extends \Orm\Model
{
	protected static $_table_name = 'matome_contents';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'matome_id',
		'title',
		'title_ngram',
		'item_id',
		'movie_id',
		'comment',
		'created_at',
		'updated_at',
 		'id',
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
	
	public static function add(DTO_Matome_Contents $dto) {
		$data = array(
			'matome_id' => $dto->getMatomeId(),
			'title' => $dto->getTitle(),
			'title_ngram' => Util_Ngram::build($dto->getTitle()),
			'item_id' => $dto->getItemId(),
			'movie_id' => $dto->getMovieId(),
			'comment' => $dto->getComment(),
		);
		
		$self = self::forge($data);
		$self->save();
		
		return $self;
	}
}
