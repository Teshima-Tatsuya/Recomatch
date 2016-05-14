<?php

class Controller_Admin extends MyController {

	public function before() {
		parent::before();
		if(!Recomatch_Util::isLogin()) {
			throw new HttpNotFoundException();
		}else if(!Model_User::isAdmin($this->me)) {
			throw new HttpNotFoundException();
		}
	}
	
	public function action_index() {
		$this->template->content = View_Smarty::forge("common/admin/index");
		$count = Model_UserActionHistory::count();
		$pagination = Util_Pagination::create_link($count);
		$this->template->uahs = Model_UserActionHistory::find('all', array(
			"order_by" => array("visit_time" => "DESC"),
			"limit" => $pagination->per_page,
			"offset" => $pagination->offset,
		));
		$this->template->content->set_safe('pagination', $pagination);
	}
}
