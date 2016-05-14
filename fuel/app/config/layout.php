<?php
$active = 'pc';

if (Agent::is_smartphone()) {
	$active = 'mobile';
}

// 記述していないページについてはdefaultのレイアウトを取得します。
// 階層構造は多次元配列で示してください
// ex. 'mypage' => array(
//		'default'	=> 'layout/mypage',
//		'tag'		=> 'layout/tag',
//		)
//
// レイアウト検索の順番
// 1. active => controller => method
// 2. common => controller => method
// 3. active => controller => default
// 4. common => controller => default
// 設定が見つからなければ、layout/controllerで返却


return array(
	'active' => $active,
	'common' => array(
		'contents' => array(
			'myreco' => 'layout/myreco',
			'movie' => 'layout/movie',
		),
		'errors' => array(
			'404' => 'layout/404',
			'500' => 'layout/500',
		),
		'myreco' => array(
			'tag' => 'layout/tag',
		),
		'community' => array(
			'page' => 'layout/community_page',
		),
		'feature' => array(
			'page' => 'layout/feature_page',
		),
		'matome' => array(
			'page' => 'layout/matome_page',
		),
		'admin' => array(
			'index' => 'layout/admin'
		),
	),
	'pc' => array(
		'user' => array(
			'follow' => 'layout/user',
			'follower' => 'layout/user',
			'menu' => 'layout/user_menu',
		),
	),
	'mobile' => array(
		'user' => array(
			'follow' => 'layout/user_follow',
			'follower' => 'layout/user_follow',
			'menu' => 'layout/user_menu',
		),
		'community' => array(
			'page' => 'layout/community_page',
			'form' => 'layout/community_page',
		),
	),
);
