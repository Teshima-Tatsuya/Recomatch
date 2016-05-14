<?php

class Model_Question_Good_Base extends \Orm\Model {
	
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

	/**
	 * お気に入りしている質問IDを検索する
	 * @param type $user_id お気に入りしている質問IDを取得したいユーザID
	 * @return array 一致した質問ID一覧
	 */
	public static function getParentTableIds($user_id) {
		$last_name = static::getCalledClassLastName();
		$id_clm_name = $last_name . '_id';
		
		$id_objs = static::find('all', array(
				'select' => array($id_clm_name),
				'where' => array(
					array('user_id', $user_id), //urlencodeされた値が入っているので。
				)
		));
		$ids = array();  // ex: array(1, 2, 3, ...);
		foreach ($id_objs as $id_obj) {
			array_push($ids, $id_obj->$id_clm_name);
		}

		return $ids;
	}
	
	public static function getUserIds($search_id) {
		$last_name = static::getCalledClassLastName();
		$id_clm_name = $last_name . '_id';

		$user_id_objs = static::find('all', array(
			'select' => array('user_id'),
			'where' => array(
				array($id_clm_name, $search_id),
			),
		));

		$user_ids = array();  // ex: array(1, 2, 3, ...);
		foreach ($user_id_objs as $user_id_obj) {
			array_push($user_ids, $user_id_obj->user_id);
		}

		return $user_ids;
	}

	public static function isGood($search_id, $user_id) {
		$last_name = static::getCalledClassLastName();
		$id_clm_name = $last_name . '_id';

		$good = static::find('first', array(
			'where' => array(
				array('user_id', $user_id),
				array($id_clm_name, $search_id),
			),
		));		
		return (count($good) > 0) ? true : false; 
	}
	
	public static function isPushed($search_id, $user_id) {
		return self::isGood($search_id, $user_id);
	}

	public static function getNumByUserId($user_id) {
		$data = static::find("all", array(
			'where' => array(
				'user_id' => $user_id,
			),
		));
		
		return count($data);
	}
	
	private static function getCalledClassLastName() {
		$class = get_called_class();
		$rpos = strrpos($class, '_');
		$last_name = strtolower(substr($class, $rpos + 1));		
		
		return $last_name;
	}
}