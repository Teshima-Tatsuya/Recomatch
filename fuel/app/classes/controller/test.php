<?php

class Controller_Test extends MyController {

	public function before() {
		parent::before();
		if(!Recomatch_Util::isLogin()) {
			throw new HttpNotFoundException();
		}else if(!Model_User::isAdmin($this->me)) {
			throw new HttpNotFoundException();
		}
	}
	
	public function action_test($page, $layout = "base") {
		$data['content'] = View_Smarty::forge('test/'.$page)->render();
		$this->template->title = "テストページ";
		return View_Smarty::forge('layout/'.$layout, $data, false)->render();
	}
	
	public function action_home() {
		$data['myrecos'] = Model_Myreco::getAll();
		$data['movies'] = Model_Movie::getAll();
		$data['content'] = View_Smarty::forge('test/home', $data)->render();
		return View_Smarty::forge('layout/home', $data, false)->render();
	}
	
	// システムエラーの確認
	public function action_500() {
		throw new HttpServerErrorException;
	}
	
	public function action_request() {
		$response = Request::forge("myreco/index");
		print_r($response);
		print_r($response->execute()->body);
	}
}
