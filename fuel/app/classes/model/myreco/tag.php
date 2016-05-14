<?php

class Model_Myreco_Tag extends \Orm\Model {

	protected static $_table_name = 'myreco_tag';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'tag',
		'tag_ngram',
		'user_id',
		'myreco_id',
		'created_at',
		'updated_at',
		'id'
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
	
	protected static $_belong_to = array(
		'myreco' => array(
			'model_to' => 'Model_Myreco',
			'key_from' => 'myreco_id', 
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	/**
	 * タグ一覧文字列を生成する
	 * @param type $tags タグオブジェクト
	 * @return string 生成されたタグ一覧文字列
	 */
	public static function getTags($tags) {
		$tags_str = '';
		$search_tag = Uri::segment(3);
		foreach ($tags as $tag) {
			if (is_null($tag->tag)) $tag->tag = urldecode ($search_tag);
			$tags_str .= '<span class="label" style="margin-bottom:5px"><a href="/home/tag/' . $tag->tag . '" class="label"> ' . $tag->tag . '</a></span>&nbsp;';
		}

		return $tags_str;
	}

	/**
	 * 検索したいタグが含まれている質問IDを検索する
	 * @param type $tag 検索したいタグ
	 * @return array 一致した質問ID一覧
	 */
	public static function getMatchIds($tag) {
		$tag_id_objs = self::find('all', array(
				'select' => array('myreco_id'),
				'where' => array(
					array('tag', urldecode($tag)), //urlencodeされた値が入っているので。
				)
		));
		$myreco_ids = array();  // ex: array(1, 2, 3, ...);
		foreach ($tag_id_objs as $tag_obj) {
			array_push($myreco_ids, $tag_obj->myreco_id);
		}

		return $myreco_ids;
	}
	
	/**
	 * 質問IDに対して、入力されたタグを格納する。
	 * @param Model_Myreco $myreco　質問オブジェクト
	 * @param array $tags　入力されたタグ一覧
	 */
	public static function addTags(Model_Myreco $myreco, $tags) {
		// 入力されたタグが配列でないならば整形して配列に変換
		if (!is_array($tags)) {
			$tags = static::strToArr($tags);
		}

		foreach ($tags as $tag) {
			$data = array(
				"tag" => $tag,
				'tag_ngram' => Util_NGram::build($tag),
				"user_id" => $myreco->user_id,
				"myreco_id" => $myreco->id,
			);

			self::forge($data)->save();
		}
	}

	/**
	 * 文字列であるタグを配列に変換
	 * @param type $tags 文字列化されているタグ
	 * @return array 配列化されたタグ一覧
	 */
	public static function strToArr($strTags) {
		// カンマを基準に配列化
		$strTags2 = preg_replace("(，|、)", ",", $strTags);	// 全角カンマと読点を半角に
		$strTags3 = mb_convert_kana($strTags2, 's');		// 全角スペースを半角スペースに変換
		$strTags3 = trim($strTags3, " \t\n\r\0\x0B,");		// 先頭と末尾にコンマとスペースなどがあれば消す
		$arrTags = explode(",", $strTags3);				// 配列化
		$arrTags2 = array_filter($arrTags, "trim");			// 各タグの前後の半角スペースを削除

		return $arrTags2;
	}
}
