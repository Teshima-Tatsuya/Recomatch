<?php

class Controller_Follow extends MyController {
	public function action_index() {
		Response::redirect("/follow/follow");
	}

	/**
	 * フォローページを表示
	 */
	public function action_follow() {
		$res = Model_FollowList::getFollowUsers($this->me->id);
		$count = count($res);
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->users = Model_FollowList::getFollowUsers($this->me->id, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}

	/**
	 * フォロワーページを表示
	 */
	public function action_follower() {
		$res = Model_FollowList::getFollowerUsers($this->me->id);
		$count = count($res);
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->users = Model_FollowList::getFollowerUsers($this->me->id, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}
	
	public function action_add() {
		if(Input::is_ajax()) {
			$follow_user_id = $this->me->id;
			$follower_user_id = Input::post("follower_user_id");

			Model_FollowList::add($follow_user_id, $follower_user_id);
		}
	}
	
	/**
	 * フォローを取り消す
	 * @return type
	 */
	public function action_delete() {
		if(Input::is_ajax()) {
			$follow_user_id = $this->me->id;
			$follower_user_id = Input::post('follower_user_id');
			
			$result = Model_FollowList::remove($follow_user_id, $follower_user_id);
			
			return $result;
		}
	}
	
}
