<?php
/**
 * Description of good
 *
 * @author Teshima
 */
class Recomatch_Button_Delete extends Recomatch_Button_Button {
	
	protected function buttonBody($config) {
		$str = '<a href="javascript:void(0)" class="'.$this->btn_class.'" '.$this->contents_kind.'_id="' . $this->contents->id . '" >';
		$str .= $this->setAsset($config);
		$str .= '</a>';

		return $str;
	}

	protected function setImgPath() {
		return "icon/delete.png";
	}
	
	protected function addClass() {
		return "delete_" . $this->contents_kind;
	}
}
