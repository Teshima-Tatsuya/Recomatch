<?php
	function smarty_modifier_auto_link($data) {
		if (is_null($data)){
			return $data;
		}
		$data = mb_ereg_replace("(https?|ftp)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)",
			        "<a href=\"\\1\\2\" target=\"_blank\">\\1\\2</a>",$data);
		return $data;
    }
?>