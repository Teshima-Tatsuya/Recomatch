<?php

class Model_Info extends MyOrm {
	
	protected static $_table_name = 'info';
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'contents_id',
		'post_user_id',
		'contents_type',
		'action_type' => array(
			'default'      => 0,
		),
		'info_num' => array(
			'default'      => 1,
		),
		'created_at',
		'updated_at',
		'id',
	);
	
	protected static $_belongs_to = array(
		'myreco' => array(
			'model_to' => 'Model_Myreco',
			'key_from' => 'contents_id', 
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'movie' => array(
			'model_to' => 'Model_Movie',
			'key_from' => 'contents_id', 
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		)
	);
		
	/**
	 * お知らせ情報を追加する
	 * @param type $contents_id コンテンツID
	 * @param type $post_user_id 投稿者ID
	 * @param type $contents_type コンテンツの種類
	 * @param type $action_type 行動の種類
	 * @return type 
	 */
	public static function add($contents_id, $post_user_id, $contents_type, $action_type = 0) {
		// 投稿者が自分であれば、お知らせ情報を追加しない
		if($post_user_id == Session::get('me')->id) {
			return;
		}

		// お知らせ情報がすでに存在しているかを確認
		// コンテンツのID、種類、アクションの種類で一意（複合主キー）
		$self = self::find('first', array(
			'select' => array('info_num'),
			'where' => array(
				'contents_id' => $contents_id,
				'contents_type' => $contents_type,		
				'action_type' => $action_type,
			),
		));
		
		// お知らせがすでに存在したら、数を増加
		if(!is_null($self)) {
			$self->info_num++;
			$self->save();
		} else {
			$info = self::forge(array(
				'contents_id' => $contents_id,
				'post_user_id' => $post_user_id,
				'contents_type' => $contents_type,
				'action_type' => $action_type,
			));
			$info->save();
		}
	}
	
	/**
	 * お知らせ情報を削除する
	 * 
	 * @param type $contents_type
	 * @param type $post_user_id
	 * @param type $contents_id
	 * @throws Exception
	 */
	public static function remove($contents_id, $post_user_id, $contents_type = null) {
		$where = array(
					array('contents_id', $contents_id),
					array('post_user_id', $post_user_id),
				);
		
		if(!is_null($contents_type)) {
			array_push($where, array('contents_type', $contents_type));
		}

		$info_list = self::find('all', array(
			'where' => $where,
		));
		
		foreach ($info_list as $info){
			$info->delete();		
		}
	}
	
	/**
	 * お知らせの件数をコンテンツ、アクション種別を元に返却
	 * @param type $post_user_id
	 * @param type $contents_type
	 * @param type $action_type
	 * @return int
	 */
	public static function getInfoList($post_user_id, $contents_type) {
		$info_list = array();

		$contents_ids = self::getAllContentsId($post_user_id, $contents_type);
		
		foreach($contents_ids as $contents_id){
			$infos = self::find('all', array(
				'select' => array('contents_id', 'updated_at', 'info_num', 'action_type', 'contents_type'),
				'where' => array(
					'contents_id' => $contents_id,
					'post_user_id' => $post_user_id,
					'contents_type' => $contents_type,
				),
			));
			
			foreach ($infos as $info){
				array_push($info_list, $info);
			}
		}
		
		// 更新時間の降順
		usort($info_list, function($cmp1, $cmp2) {
			$cmp = strcmp($cmp1->updated_at, $cmp2->updated_at); 
			return -$cmp;
		});
				
		return $info_list;
	}
	
	/**
	 * 投稿者IDとコンテンツ種別から、お知らせがある、コンテンツID一覧を取得する。
	 * @param type $post_user_id
	 * @param type $contents_type
	 * @return array
	 */
	private static function getAllContentsId($post_user_id, $contents_type) {
		$infos = self::find('all', array(
			'where' => array(
				'post_user_id' => $post_user_id,
				'contents_type' => $contents_type,
			),
			'group by' => 'contents_id',
		));
		
		$contens_ids = array();
		
		foreach($infos as $info) {
			array_push($contens_ids, $info->contents_id);
		}
		
		$contens_ids_unique = array_unique($contens_ids);

		return $contens_ids_unique;
	}
	
	public static function getContentsName($contents_type) {
		$name = "";
		
		switch ($contents_type) {
			case Recomatch_Constants::CONTENTS_MYRECO:
				$name = 'myreco';
				break;
			case Recomatch_Constants::CONTENTS_MOVIE:
				$name = 'movie';
				break;
			default :
				throw new Exception("contents type is not valid!! FILE:".__FILE__." LINE:".__LINE__);
		}
		
		return $name;
	}
	
	public static function getActionName($action_type) {
		$name = "";

		switch ($action_type) {
			case Recomatch_Constants::ACTION_REGIST:
				$name = '登録';
				break;
			case Recomatch_Constants::ACTION_GOOD:
				$name = 'スキ';
				break;
			case Recomatch_Constants::ACTION_FAVORITE:
				$name = 'お気に入り';
				break;
			default :
				throw new Exception("contents type is not valid!! FILE:".__FILE__." LINE:".__LINE__);
		}
		
		return $name;
	}
	
	/**
	 * お知らせが存在するかどうかを判定
	 * @param type $post_user_id
	 * @return boolean 
	 */
	public function isInfoExists($post_user_id) {
		$infos = self::find('all', array(
			'where' => array(
				'post_user_id' => $post_user_id,
			),
		));
		
		if(empty($infos)) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * お知らせが存在するかどうかを判定
	 * @param type $post_user_id
	 * @return boolean 
	 */
	public function getNum($post_user_id) {
		$num = self::count(array(
			'where' => array(
				'post_user_id' => $post_user_id,
			),
		));

		return $num;
	}

	/**
	 * 自分に関するお知らせを全て既読にする
	 * @param type $post_user_id 既読にしたいユーザID
	 */
	public static function allReaded($post_user_id) {
		$infos = self::find('all', array(
			'where' => array(
				'post_user_id' => $post_user_id,
			)
		));
		
		if(!empty($infos)) {
			foreach ($infos as $info) {
				$info->delete();
			}
		}
	}
}
