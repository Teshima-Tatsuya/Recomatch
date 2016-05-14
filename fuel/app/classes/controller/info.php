<?php

class Controller_Info extends MyController {
	
	public function before() {
		// 未ログインならば、ログインページにリダイレクト
		if(!Recomatch_Util::isLogin()) {
			Response::redirect("/login");
		}
		parent::before();
	}

	public function action_index() {
		Response::redirect("/info/myreco");
	}

	public function action_myreco() {
		$this->template->infos = Model_Info::getInfoList($this->me->id, Recomatch_Constants::CONTENTS_MYRECO);
	}

	public function action_movie() {
		$this->template->infos = Model_Info::getInfoList($this->me->id, Recomatch_Constants::CONTENTS_MOVIE);
	}
}
