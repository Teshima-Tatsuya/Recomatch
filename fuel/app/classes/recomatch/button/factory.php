<?php

class Recomatch_Button_Factory {
	public function create($kind) {
		$button = $this->createButton($kind);
		
		return $button;
	}
	
	private function createButton($kind) {
		if($kind == Recomatch_Constants::BUTTON_GOOD) {
			$link = new Recomatch_Button_Good();
		} else if($kind == Recomatch_Constants::BUTTON_FAVORITE) {
			$link = new Recomatch_Button_Favorite();
		} else if($kind == Recomatch_Constants::BUTTON_FOLLOW) {
			$link = new Recomatch_Button_Follow();
		} else if($kind == Recomatch_Constants::BUTTON_DELETE) {
			$link = new Recomatch_Button_Delete();			
		}
		
		return $link;
	}
	
}
