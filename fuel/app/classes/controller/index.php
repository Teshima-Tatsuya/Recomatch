<?php

class Controller_Index extends MyController {

	public function action_index() {
		Response::redirect("/home/index");
	}
}
