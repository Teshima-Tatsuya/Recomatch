<?php

/**
 * Modelの中で共通する処理や定義をここに記述
 */
class MyOrm extends Orm\Model {
	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
			'property' => 'created_at',
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => true,
			'property' => 'updated_at',
		),
	);

	public static function getObj($id) {
		return static::find($id);
	}
	
	public static function getAll($limit = null, $offset = null, array $where = array()) {
		$condition = array(
			'order_by' => array('created_at' => 'DESC'),
		);
		
		if(!is_null($limit)) {
			$condition += array('limit' => $limit);
		}
		if(!is_null($offset)) {
			$condition += array('offset' => $offset);
		}
		if(!empty($where)) {
			$condition += array('where' => $where);
		}
		
		$all = static::find('all', $condition);
		
		return $all;
	}
	
	public static function getIds($select = 'id', array $where = array()) {
		$condition = array(
			'select' => array($select),
		);
		if(!empty($where)) {
			$condition += array('where' => $where);
		}
		$objs = static::find('all', $condition);
		$ids = array();  // ex: array(1, 2, 3, ...);
		foreach ($objs as $obj) {
			array_push($ids, $obj->$select);
		}

		return $ids;		
	}
	
	/**
	 * IN述子を用いて一覧を取得
	 * @param type $ids
	 * @return array
	 */
	protected static function getUsesIn($ids, $column = 'id', $limit = null, $offset = null, $where = array()) {
		$finds = array();
		$where2 = array(
			array($column, 'IN', $ids),
		);
		if(!empty($where)) {
			$where2 += $where;
		}
		
		if(count($ids) > 0) {
			$condition = array(
				'order_by' => array('created_at' => 'DESC', 'id' => 'DESC'),
				'where' => $where2
			);
			if(!is_null($limit)) {
				$condition += array('limit' => $limit);
			}
			if(!is_null($offset)) {
				$condition += array('offset' => $offset);
			}
			$finds = static::find("all", $condition);
		} else {
			$finds = array();
		}
		
		return $finds;		
	}

}
