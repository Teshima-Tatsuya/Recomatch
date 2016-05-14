<?php

class Model_Matome extends MyOrm {
	protected static $_table_name = 'matome';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'user_id',
		'title',
		'title_ngram',
		'image_url',
		'comment',
		'created_at',
		'updated_at',
		'id',
	);

}
