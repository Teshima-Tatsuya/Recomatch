<?php

class Recomatch_Button_Follow extends Recomatch_Button_Button {
	
	public function createUnpushedButton($user) {
		$kind = "follow";
		
		$str = "";
		$str .= '<form class="'.$kind.'_add_form" action="/'.$kind.'/add" method="POST" onsubmit="return false">';
		$str .= '	<button class="pure-button '.$kind.'_button" href="#" style="margin-right:5px;">'.Asset::img('icon/user.png', ['width' => 24, 'class' => 'icon']).'<span class="button-string">フォロー</span></button>';
		$str .= '	<input type="hidden" name="follower_user_id" value="'.$user->id.'" />';
		$str .= '</form>';
		
		return $str;
	}

	public function createPushedButton($user) {
		$kind = "follow";
		
		$str = "";
		$str .= '<form class="'.$kind.'_delete_form" action="/'.$kind.'/delete" method="POST" onsubmit="return false">';
		$str .= '	<button class="pure-button pushed-button '.$kind.'_button" href="#" style="margin-right:5px;">'.Asset::img('icon/pushed-'.$kind.'.png', ['width' => 24, 'class' => 'icon']).'<span class="button-string">取り消し</span></button>';
		$str .= '	<input type="hidden" name="follower_user_id" value="'.$user->id.'" />';
		$str .= '</form>';
		
		return $str;
	}		

	public function isPushed($user, $user_id) {
		if (Model_FollowList::isPushed($user, $user_id)) {
			return true;
		} else {
			return false;
		}
	}
}
