<?php

class Controller_Good extends MyController {

	public function before() {
		parent::before();
	}

	public function action_add() {
		if(Input::is_ajax()) {
			$user_id = $this->me->id;
			$contents_id = Input::post("contents_id");
			$contents_kind = Input::post("contents_kind");

			Model_Good::add($user_id, $contents_id, $contents_kind);
		}
	}
	
	/**
	 * スキの削除を行う
	 * Ajax通信限定
	 * @return type
	 */
	public function action_delete() {
		if(Input::is_ajax()) {
			$user_id = $this->me->id;
			$contents_id = Input::post('contents_id');
			$contents_kind = Input::post("contents_kind");
			
			$result = Model_Good::remove($user_id, $contents_id, $contents_kind);
			return $result;
		}
	}
}
