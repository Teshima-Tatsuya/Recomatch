<?php

class Controller_Contents extends MyController {
	public function before() {
		parent::before();
		$content = null;
		// ヘッダーに示すために情報を取得
		// contents/[good|favorite]/myreco/[:num]
		if(Uri::segment(3) == Recomatch_Constants::$CONTENTS_MAP[Recomatch_Constants::CONTENTS_MYRECO]['en']) {
			$content = Model_Myreco::find(Uri::segment(4));
		// contents/[good|favorite]/movie/[:num]
		} else if(Uri::segment(3) == Recomatch_Constants::$CONTENTS_MAP[Recomatch_Constants::CONTENTS_MOVIE]['en']) {
			$content = Model_Movie::find(Uri::segment(4));			
		}
		
		if(is_null($content)) {
			// contents/[myreco|movie]/[:num]でない
			if(Uri::segment(2) !== "myreco" && Uri::segment(2) !== "movie") {
				throw new HttpNotFoundException();
			}
		} else {
			View::set_global('content', $content);
		}
	}
	

	/**
	 * 作品個別のページ
	 * @return type
	 */
	public function action_myreco($myreco_id) {
		$this->template->myrecos = Model_Myreco::find("all", array(
			'where' => array(
				'id' => $myreco_id,
				),
			));
		// お知らせ情報を削除
		if(Recomatch_Util::isLogin()){
			Model_Info::remove($myreco_id, $this->me->id, Recomatch_Constants::CONTENTS_MYRECO);
		}
				
		$title = "";
		foreach ($this->template->myrecos as $myreco) {
			$title = $myreco->title;
		}

		$this->template->title = parent::getTitle('contents.myreco', array('{title}' => $title));
	}

	/**
	 * 404
	 * @return type
	 */
	public function action_matome() {
		throw new HttpNotFoundException();
	}

	/**
	 * 個別のムービーを表示
	 * @return type
	 */
	public function action_movie($movie_id) {
		$this->template->movies = Model_Movie::find("all", array(
			'where' => array(
				'id' => $movie_id,
				),
			));
		
		if(Recomatch_Util::isLogin()){
			Model_Info::remove($movie_id, $this->me->id, Recomatch_Constants::CONTENTS_MOVIE);
		}
		
		$title = "";
		foreach ($this->template->movies as $movie) {
			$title = $movie->title;
		}

		$this->template->title = parent::getTitle('contents.movie', array('{title}' => $title));
	}

	public function action_good($contents_kind, $contents_id) {
		// contents_map以外の値が来たらエラー
		if(!isset(Recomatch_Constants::$CONTENTS_MAP[$contents_kind])) {
			throw new HttpNotFoundException;
		};
		
		// お知らせ情報を削除
		if(Recomatch_Util::isLogin()){
			Model_Info::remove($contents_id, $this->me->id, Recomatch_Constants::$CONTENTS_MAP[$contents_kind]);
		}
		
		$user_ids = Model_Good::getUserIds($contents_id, Recomatch_Constants::$CONTENTS_MAP[$contents_kind]);
		
		// IN述子を使用するため、カウントが０でSQLを実行すると
		if(count($user_ids) > 0) {
			$this->template->users = Model_User::find('all', array(
				'where' => array(
					array('id', 'IN', $user_ids)
				),
			));
		} else {
			$this->template->users = array();
		}
	}
	
	public function action_favorite($contents_kind, $contents_id) {
		// contents_map以外の値が来たらエラー
		if(!isset(Recomatch_Constants::$CONTENTS_MAP[$contents_kind])) {
			throw new HttpNotFoundException;
		};

		// お知らせ情報を削除
		if(Recomatch_Util::isLogin()){
			Model_Info::remove($contents_id, $this->me->id, Recomatch_Constants::$CONTENTS_MAP[$contents_kind]);
		}

		$user_ids = Model_Favorite::getUserIds($contents_id, Recomatch_Constants::$CONTENTS_MAP[$contents_kind]);
		
		// IN述子を使用するため、カウントが０でSQLを実行すると
		if(count($user_ids) > 0) {
			$this->template->users = Model_User::find('all', array(
				'where' => array(
					array('id', 'IN', $user_ids),
				),
			));
		} else {
			$this->template->users = array();
		}
	}
}
