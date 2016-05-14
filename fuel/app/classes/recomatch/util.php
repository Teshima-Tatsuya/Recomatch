<?php

class Recomatch_Util {

	public static function isLogin() {
		$me = Session::get('me');
		if (isset($me)) {
			return true;
		}

		return false;
	}

	/**
	 * 
	 * @brief リンクの取得
	 * 
	 * [機能概要]
	 * <br> リンク先の値を設定。
	 * <br> 主にスキやお気に入りなどの、コンテンツごとに、
	 * <br> 区別が必要なモノに使用。
	 * <br> 唯一無二のクラス名を付与する(予定)
	 * 
	 * @param type $kind コンテンツの種類(スキ、お気に入り)
	 * @param type $contents 呼び出し元のコンテンツ(マイレコとか)
	 * @param type $config リンクの設定情報
	 * @return type
	 */
	public static function getLink($kind, $contents, $config = array()) {

		$link_factory = new Recomatch_Link_Factory();
		$linkObj = $link_factory->create($kind);
		$link = $linkObj->create($contents, $config);

		return $link;
	}

	/**
	 * 
	 * @param type $kind
	 * @param type $contents
	 * @param type $user
	 * @param type $config
	 * @return type
	 */
	public static function getButton($kind, $contents, $user, $config = array()) {
		$factory = new Recomatch_Button_Factory();
		$buttonObj = $factory->create($kind);
		$button = $buttonObj->create($contents, $user, $config);

		return $button;
	}

	/**
	 * 
	 * @brief 自コンテンツ確認
	 * 
	 * [機能概要]
	 * <br> 引数のIDが自分のIDと同一かを調べる。
	 * 
	 * @param type $user_id
	 * @return boolean
	 * 
	 * @retval true 同一のID
	 * @retval false 異なるID
	 */
	public static function isMine($user_id) {
		$me = Session::get('me');
		if(is_null($me)) {
			return false;
		}
		if ($user_id == $me->id) {
			return true;
		}
		return false;
	}

}
