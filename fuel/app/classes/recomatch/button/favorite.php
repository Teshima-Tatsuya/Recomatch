<?php

class Recomatch_Button_Favorite extends Recomatch_Button_Button {
	
	public function createUnpushedButton($contents) {
		$contents_kind = 0;
		if($contents instanceof Model_Myreco) {
			$contents_kind = Recomatch_Constants::CONTENTS_MYRECO;
		} else if($contents instanceof Model_Movie) {
			$contents_kind = Recomatch_Constants::CONTENTS_MOVIE;
		}
		$kind = "favorite";
		
		$str = "";
		$str .= '<form class="'.$kind.'_add_form" action="/'.$kind.'/add" method="POST" onsubmit="return false">';
		$str .= '	<button class="pure-button '.$kind.'_button" href="#" style="margin-right:5px;">'.Asset::img('icon/'.$kind.'.png', ['width' => 24, 'class' => 'icon']).'<span class="button-string">お気に入り</span></button>';
		$str .= '	<input type="hidden" name="contents_id" value="'.$contents->id.'" />';
		$str .= '	<input type="hidden" name="contents_kind" value="'.$contents_kind.'" />';
		$str .= '</form>';
		
		return $str;
	}

	public function createPushedButton($contents) {
		$contents_kind = 0;
		if($contents instanceof Model_Myreco) {
			$contents_kind = Recomatch_Constants::CONTENTS_MYRECO;
		} else if($contents instanceof Model_Movie) {
			$contents_kind = Recomatch_Constants::CONTENTS_MOVIE;
		}
		$kind = "favorite";
		
		$str = "";
		$str .= '<form class="'.$kind.'_delete_form" action="/'.$kind.'/delete" method="POST" onsubmit="return false">';
		$str .= '	<button class="pure-button pushed-button '.$kind.'_button" href="#" style="margin-right:5px;">'.Asset::img('icon/pushed-'.$kind.'.png', ['width' => 24, 'class' => 'icon']).'<span class="button-string">取り消し</span></button>';
		$str .= '	<input type="hidden" name="contents_id" value="'.$contents->id.'" />';
		$str .= '	<input type="hidden" name="contents_kind" value="'.$contents_kind.'" />';
		$str .= '</form>';
		
		return $str;
	}		

	public function isPushed($contents, $user_id) {
		if (Model_Favorite::isPushed($contents, $user_id)) {
			return true;
		} else {
			return false;
		}
	}
}
