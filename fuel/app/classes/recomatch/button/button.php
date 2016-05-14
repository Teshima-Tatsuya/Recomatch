<?php

abstract class Recomatch_Button_Button {
	public final function create($contents, $user_id, array $config = array()) {
		if($this->isPushed($contents, $user_id)) {
			return $this->createPushedButton($contents);
		} else {
			return $this->createUnpushedButton($contents);			
		}
	}

	abstract function createUnpushedButton($contents);
	abstract function createPushedButton($contents);
	
	abstract function isPushed($contents, $user_id);
}
