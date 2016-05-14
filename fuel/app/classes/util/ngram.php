<?php

/**
 * @brief 検索に使用するNgramクラス
 * 
 * Ngram形式のデータの生成、MySQLの全文検索に対応した変換など
 *  
 */
class Util_Ngram{
    
    protected static $gram = 2;  /*!< gram数 初期値2 */
    protected static $prefix = "__"; /*!< プレフィックスの文字列 */
    /**
     * @brief Ngram生成関数
     * 
     * 質問投稿時にタイトル、タグ、本文をNgramの形式に変換しDBに登録する
     * 
     * @param String $str 投稿時の文字列(タイトル、タグ、本文);
     */
    public static function build($str){
        // TODO 引数の再検討…取得する引数はこれで良い？
        // DBに登録するなら、質問データ自体もらった方が良いかな…。
        // Ngramデータに変換するためのクラスなら、DB登録は質問クラスの方でやった方が良いかもね。
        // ここはRecomatchの処理のまま、クラス使用に変えていますです。
        // 2014/04/06 記
        $ngramstr = "";
        
        // 文字列が一文字の場合、後ろにprefixを付けてreturn
        if(mb_strlen($str) == 1){
            
            return $str . self::$prefix;
        }
        // スペースは削除
        $str = preg_replace('/(\s| )/','',$str);
        
        
        // 取得した文字列をgram数ごとに分割する
        // グラム数ごとに文字列内にprefixを挿入し、半角スペースを挿入
        for($i = 0;$i <= (mb_strlen($str) - self::$gram); $i++){
            $parts = mb_substr($str, $i,self::$gram);
            $ngramstr .= $parts . self::$prefix . " ";
        }
        
        // 半角スペースを取っ払って返す。
        $ngram = rtrim($ngramstr);
        
        return $ngram;

        // 結合したデータをDBに登録する?
        
    }
    
    /**
     * @brief MySQLの全文検索変換関数
     * 
     * 検索時に使用するMySQLの全文検索に対応するように、データを作り替える
     * 
     * @param String $str ngram形式のデータ？
     */
    public static function query($str){
        
        // 取得したngramデータに、+"[ngramデータ]"のような形式に加工
        // 追加したい処理があれば書きます。
        return '+"' . $str . '"';
    }

	private static function _to_ngram_fulltext($string,$n){
		$ngrams = array();
		$string = trim($string);
		if ($string == ''){
			return '';
		}
		
		$length = mb_strlen($string,'UTF-8') ;
		for ($i = 0; $i < $length; $i++) {
			$ngram = mb_substr($string, $i, $n,'UTF-8');
			$ngrams[] = $ngram;
		}
	
		return join(' ',$ngrams);
	}
	
	private static function _to_ngram_query($string,$n){
		$ngrams = array();
		$string = trim($string);
		if ($string == ''){
			return '';
		}
		$length = mb_strlen($string,'UTF-8') ;
		if ($length < $n){
			return "+".($string)."_";
		}
	
		for ($i = 0; $i < $length-$n+1; $i++) {
			$ngram = mb_substr($string, $i, $n,'UTF-8');
			$ngrams[] = "+" . ($ngram).self::$prefix;
		}
	
		return join(' ',$ngrams);
	}
	
	private static function _to_ngram($string,$n,$query_flag=FALSE){
		$temp_encoding = mb_regex_encoding();
		mb_regex_encoding('UTF-8');
		$string = mb_ereg_replace("^(\s|　)+","",$string);
		$string = mb_ereg_replace("(\s|　)+$","",$string);
		$str_array = preg_split("/(\s|　)+/",$string);
		mb_regex_encoding($temp_encoding);
	
		$result = array();
		foreach ($str_array as $str){
			if ($query_flag){
				$result[] = self::_to_ngram_query($str,$n);
			}else{
				$result[] = self::_to_ngram_fulltext($str,$n);
			}
		}
		return join(' ',$result);
	}
	
	public static function to_fulltext($string,$n = 2){
		return self::_to_ngram($string,$n);
	}
	
	public static function to_query($string,$n = 2){
		return self::_to_ngram($string,$n,TRUE);
	}

	public static function make_match_sql($word,$column,$n = 2){
		if($word == ''){
			return '';
		}
		$ngram = self::to_query($word,$n);
		return "MATCH(".$column.") AGAINST('".$ngram."' IN BOOLEAN MODE)";
	}
	
}


?>
