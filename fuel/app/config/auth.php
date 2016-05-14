<?php
/**
 * 暗号化のため
 * saltに適当な文字列を追加
 */
return array(
	'driver' => 'Simpleauth',
	'verify_multiple_logins' => false,
	'salt' => 'XXXXXXXXXXXXXXXXXXXXXX',
	'iterations' => 10000,
);
