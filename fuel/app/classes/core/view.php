<?php

class View extends \Fuel\Core\View {
    public function set_filename($file) {
	// viewsのパスがcommonから始まるならばそのままcommonからファイルを取得
	if(strpos($file, "common/") === 0) {
		
	} else {
			if ( Agent::is_smartphone() ) {
				$file = 'mobile/' . $file;
			} else {
				$file = 'pc/' . $file;			
		}
	}
             
        return parent::set_filename($file); 
    }           
}