<?php

class Validation extends \Fuel\Core\Validation {
	public static function _validation_required_category($val) {
		return $val > 0;
	}
	
	public static function _validation_valid_youtube_url($val) {
		$movie_id = Model_Movie::parseMovieId($val);
		
		// 動画IDが取得出来ない場合
		// バリデーションが必要
		if($movie_id == -1) {
			return false;
		}

		return true;
	}	
}
