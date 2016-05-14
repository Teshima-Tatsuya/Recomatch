<?php
$active = 'pc';
$pc_default_per_page = 30;
$mobile_default_per_page = 10;

if (Agent::is_smartphone()) {
	$active = 'mobile';
}

return array(
	'active' => $active,

	'pc' => array(
		'default' => $pc_default_per_page,
		'follow' => array(
			'follow' => 12,
			'follower' => 12,
		),
		'user' => array(
			'follow' => 12,
			'follower' => 12,
		),
		'feature' => array(
			'index' => 20,
		),
		'matome' => array(
			'index' => 20,
		),
		'admin' => array(
				'index' =>  200,
			),

	),
	'mobile' => array(
		'default' => $mobile_default_per_page,
		'follow' => array(
			'follow' => 12,
			'follower' => 12,
		),
		'user' => array(
			'follow' => 12,
			'follower' => 12,
		),
		'feature' => array(
			'index' => 20,
		),
		'matome' => array(
			'index' => 20,
		),
	),
);
