<?php
class Recomatch_Constants {
	// ユーザの役割の種類
	const ROLE_ADMIN = 0;
	const ROLE_USER = 1;
	
	// コンテンツの種類
	const CONTENTS_MYRECO	= 1;
	const CONTENTS_COMMENT = 2;
	const CONTENTS_MOVIE = 3;

	// アクションの種類
	const ACTION_REGIST		= 0;
	const ACTION_GOOD			= 1;
	const ACTION_FAVORITE		= 2;
	
	// ボタンの種類
	const BUTTON_GOOD = 100;
	const BUTTON_FAVORITE = 200;
	const BUTTON_FOLLOW = 300;
	const BUTTON_DELETE = 400;
	
	public static $CONTENTS_MAP = array(
		self::CONTENTS_MYRECO => array(
			'en' => 'myreco',
			'ja' => 'マイレコ',
		),
		self::CONTENTS_MOVIE => array(
			'en' => 'movie',
			'ja' => 'ムービー',
		),
		'myreco' => self::CONTENTS_MYRECO,
		'movie' => self::CONTENTS_MOVIE,
	);
	
	public static $ACTION_MAP = array(
		self::ACTION_REGIST => array(
			'en' => 'regist',
			'ja' => '登録'
		),
		self::ACTION_GOOD => array(
			'en' => 'good',
			'ja' => 'スキ'
		),
		self::ACTION_FAVORITE => array(
			'en' => 'favorite',
			'ja' => 'お気に入り'
		),
		'regist' => self::ACTION_REGIST,
		'good' => self::ACTION_GOOD,
		'favorite' => self::ACTION_FAVORITE,
	);	
}
