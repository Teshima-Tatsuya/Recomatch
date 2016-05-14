<?php

class Controller_News extends MyController {
	public function before() {
		throw new HttpNotFoundException();
		parent::before();
	}
	
	public function action_good() {
	}

	public function action_favorite() {
	}
	
	public function action_add() {
		$val = Validation::forge();
		$newsDTO = new DTO_News();
		$newsDTO->setUserId($this->me->id);
		$newsDTO->setUrl(Input::post("url"));	// required
		$newsDTO->setComment(Input::post('comment'));	// required
		
		$news = Model_News::add($newsDTO);	
		
		Response::redirect("/timeline/news");
	}
}
