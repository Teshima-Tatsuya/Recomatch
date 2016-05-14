<?php

class Controller_User extends MyController {
	public function before() {
		$user_id = Uri::segment(3);
		if(is_int($user_id)) {
			throw new HttpNotFoundException();
		}
		// ユーザIDが自分ならばマイページに
		if(Recomatch_Util::isMine($user_id)) {
			Response::redirect("/mypage/myreco");
		}
		
		parent::before();

		$this->template->user = Model_User::find(Uri::segment(3));
		
		if(is_null($this->template->user)) {
			throw new HttpNotFoundException();
		}
	}

	public function action_index() {
		Response::redirect("/user/myreco");
	}
	
	public function action_myreco($user_id) {
		$query = Model_Myreco::query()->where('user_id', $user_id);
		$count = $query->count();
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->myrecos = $query->order_by('created_at', 'DESC')
									->limit($pagination->per_page)
									->offset($pagination->offset)
									->get();
		$this->template->content->set_safe('pagination', $pagination);
	}

	/**
	 * とりあえず404
	 * @param type $user_id
	 * @return type
	 */
	public function action_matome($user_id) {
		throw new HttpNotFoundException();
	}

	public function action_movie($user_id) {
		$query = Model_Movie::query()->where('user_id', $user_id)
			->where('contents_type', Recomatch_Constants::CONTENTS_MOVIE);
		$count = $query->count();
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->movies = $query->order_by('created_at', 'DESC')
									->limit($pagination->per_page)
									->offset($pagination->offset)
									->get();
		$this->template->content->set_safe('pagination', $pagination);
	}
	
	/**
	 * モバイル専用？
	 */
	public function action_menu() {
	}
	
	public function action_follow($user_id) {
		$res = Model_FollowList::getFollowUsers($user_id);
		$count = count($res);
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->users = Model_FollowList::getFollowUsers($user_id, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}

	public function action_follower($user_id) {
		$res = Model_FollowList::getFollowerUsers($user_id);
		$count = count($res);
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->users = Model_FollowList::getFollowerUsers($user_id, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}
}
