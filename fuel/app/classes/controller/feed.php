<?php

class Controller_Feed extends MyController {
	public function before() {		
		// 未ログインならばログインページヘリダイレクト
		if(!Recomatch_Util::isLogin()) {
			Response::redirect("/login");
		}
		parent::before();
	}

	public function action_index() {
		Response::redirect("/feed/myreco");
	}
	
	public function action_myreco() {
		$res = Model_Myreco::getFollows($this->me->id);
		$count = count($res);
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->myrecos = Model_Myreco::getFollows($this->me->id, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}

	public function action_matome() {
		throw new HttpNotFoundException();
	}

	public function action_movie() {
		$res = Model_Movie::getFollows($this->me->id);
		$count = count($res);
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->movies = Model_Movie::getFollows($this->me->id, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}
}
