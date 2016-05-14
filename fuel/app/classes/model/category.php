<?php

class Model_Category extends MyOrm {

	protected static $_table_name = 'category';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'name',
		'name_en',
		'created_at',
		'updated_at',
		'id',
	);
	
	/**
	 * IDからカテゴリ名を取得します
	 * @param type $id カテゴリID
	 * @return type string カテゴリ名
	 */
	public static function getName($id) {
		return self::find($id)->name;
	}
	
	/**
	 * IDからカテゴリ名を取得します
	 * @param type $id カテゴリID
	 * @return type string カテゴリ名
	 */
	public static function getNameEn($id) {
		return self::find($id)->name_en;
	}
	
	/**
	 * カテゴリ名（英名）からIDを取得します
	 * @param type $category_name_en カテゴリ名（英名）
	 * @return type string カテゴリ名
	 * @throws CategoryNotFoundException カテゴリの英名が見つからない場合
	 */
	public static function getId($category_name_en) {
		$self = self::find('first', array(
			'select' => array('id'),
			'where' => array(
				array('name_en', $category_name_en)
			)
		));

		// カテゴリIDが取得出来なければ、404 NotFound
		if(is_null($self)) {
			throw new CategoryNotFoundException();
		}
		
		return $self->id;
	}

	/**
	 * カテゴリー一覧を取得する
	 * order_by id ASC
	 * @param type $limit 未使用
	 * @param type $offset 未使用
	 * @param array $where 未使用
	 * @return type name, name_en, idの一覧
	 */
	public static function getALL($limit = null, $offset = null, array $where = array()) {
		return self::find('all', array(
			'select' => array('name', 'id', 'name_en'),
			'order_by' => array('id' => 'ASC'),
		));
	}
}

class CategoryNotFoundException extends Exception {
}