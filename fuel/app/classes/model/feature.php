<?php

class Model_Feature extends MyOrm {
	protected static $_table_name = 'feature';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'user_id',
		'title',
		'title_ngram',
		'append_title',
		'inner_title',
		'image_url',
		'comment',
		'body',
		'publish_date',
		'created_at',
		'updated_at',
		'id',
	);
	
	public static function getAll($limit = null, $offset = null, array $where = array()) {
		$now=time();
		
		$query = self::query()->where(DB::expr("unix_timestamp(publish_date)"), "<=", $now)->order_by("id", "DESC");
		
		if(!is_null($limit)) {
			$query->limit($limit);
		}
		if(!is_null($offset)) {
			$query->offset($offset);
		}
		
		$find = $query->get();

		return $find;
	}

}
