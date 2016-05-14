<?php

class Controller_Favorite extends MyController {

	public function action_index() {
		Response::redirect("favorite/myreco");
	}
	
	public function action_myreco() {
		$res = Model_Myreco::getFavorites($this->me->id);
		$count = count($res);
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->myrecos = Model_Myreco::getFavorites($this->me->id, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}

	public function action_matome() {
		throw new HttpNotFoundException();
	}

	public function action_movie() {
		$res = Model_Movie::getFavorites($this->me->id);
		$count = count($res);
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->movies = Model_Movie::getFavorites($this->me->id, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}

	public function action_add() {
		if(Input::is_ajax()) {
			$user_id = $this->me->id;
			$contents_id = Input::post("contents_id");
			$contents_kind = Input::post("contents_kind");

			Model_Favorite::add($user_id, $contents_id, $contents_kind);
		}
	}

	/**
	 * お気に入りの削除を行う
	 * Ajax通信限定
	 * @return type
	 */
	public function action_delete() {
		if(Input::is_ajax()) {
			$user_id = $this->me->id;
			$contents_id = Input::post('contents_id');
			$contents_kind = Input::post("contents_kind");
			
			$result = Model_Favorite::remove($user_id, $contents_id, $contents_kind);
			return $result;
		}
	}	
}
