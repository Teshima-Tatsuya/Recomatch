<?php

class Model_Favorite extends MyOrm implements Model_IButton {

	protected static $_table_name = 'favorite';	
	protected static $_primary_key = array('id');
	protected static $_properties = array(
		'contents_id',
		'user_id',
		'contents_kind',
		'created_at',
		'updated_at',
		'id',
	);

	protected static $_belongs_to = array(
		'myreco' => array(
			'model_to' => 'Model_Myreco',
			'key_from' => 'contents_id', 
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
		'movie' => array(
			'model_to' => 'Model_Movie',
			'key_from' => 'contents_id', 
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
	
	public static function add($user_id, $contents_id, $contents_kind) {
		// 未ログインならば
		if(!Recomatch_Util::isLogin()) {
			return;
		}
		
		$data = array(
			'user_id' => $user_id,
			'contents_id' => $contents_id,
			'contents_kind' => $contents_kind,
		);
		
		$find = self::find('first', array(
			'where' => array(
				array('user_id', $user_id),
				array('contents_id', $contents_id),
				array('contents_kind', $contents_kind),
			),
		));
		
		// すでに登録済みならば、見つかったレコードを返却
		if(!is_null($find)) {
			return $find;
		}
		
		$self = self::forge($data);
		if($contents_kind == Recomatch_Constants::CONTENTS_MYRECO) {
			$self->myreco->bookmark_num++;
			$post_user_id = $self->myreco->user_id;
		} else if($contents_kind == Recomatch_Constants::CONTENTS_MOVIE) {
			$self->movie->bookmark_num++;
			$post_user_id = $self->movie->user_id;
		}
		$self->save();

		// お知らせを追加
		Model_Info::add($contents_id, $post_user_id, $contents_kind, Recomatch_Constants::ACTION_FAVORITE);

		return $self;
	}
	
	public static function remove($user_id, $contents_id, $contents_kind) {
		// 未ログインならば処理せず
		if(!Recomatch_Util::isLogin()) {
			return;
		}
		
		$where = array(
			'user_id' => $user_id,
			'contents_id' => $contents_id,
			'contents_kind' => $contents_kind,
		);
		
		$row = self::find('first', array(
			'where' => $where,
		));
		
		if(!is_null($row)) {
			if($contents_kind == Recomatch_Constants::CONTENTS_MYRECO) {
				$row->myreco->bookmark_num--;
			} else if($contents_kind == Recomatch_Constants::CONTENTS_MOVIE) {
				$row->movie->bookmark_num--;
			}
			$row->save();
			$row->delete();
			return true;
		} else {
			return false;
		}
	}
	
	public static function removeMyreco($user_id, $contents_id) {
		$result = self::remove($user_id, $contents_id, Recomatch_Constants::CONTENTS_MYRECO);
		return $result;
	}

	public static function removeMovie($user_id, $contents_id) {
		$result = self::remove($user_id, $contents_id, Recomatch_Constants::CONTENTS_MOVIE);
		return $result;
	}


	/**
	 * お気に入りしているユーザID一覧を取得
	 * @param type $contents_id
	 * @param type $contents_kind
	 * @return array
	 */
	public static function getUserIds($contents_id, $contents_kind) {
		$where = array(
			'contents_id' => $contents_id,
			'contents_kind' => $contents_kind,
		);
		return self::getIds('user_id', $where);
	}
	
	/**
	 * お気に入りしているマイレコ一覧を取得する
	 * @param type $tag
	 * @return array
	 */
	public static function getMyrecoIds($user_id) {
		$where = array(
			'user_id' => $user_id,
			'contents_kind' => Recomatch_Constants::CONTENTS_MYRECO,
		);
		return self::getIds('contents_id', $where);
	}

	
	/**
	 * お気に入りしているムービー一覧を取得する
	 * @param type $tag
	 * @return array
	 */
	public static function getMovieIds($user_id) {
		$where = array(
			'user_id' => $user_id,
			'contents_kind' => Recomatch_Constants::CONTENTS_MOVIE,
		);
		return self::getIds('contents_id', $where);
	}
	
	/**
	 * すでにボタンを押されていればtrueを返す
	 * @param type $contents_id 調査したいコンテンツID
	 * @param type $contents_kind コンテンツの種類
	 * @param type $user_id 調査したいユーザ
	 * @return type boolean
	 */
	public static function isPushed($contents, $user_id) {
		$contents_kind = 0;
		if ($contents instanceof Model_Myreco) {
			$contents_kind = Recomatch_Constants::CONTENTS_MYRECO;
		} else if ($contents instanceof Model_Movie) {
			$contents_kind = Recomatch_Constants::CONTENTS_MOVIE;			
		}
		$find = self::find('first', array(
			'where' => array(
				array('contents_id', $contents->id),
				array('contents_kind', $contents_kind),
				array('user_id', $user_id),
			),
		));
		
		return !is_null($find); 
	}
}
