<?php
// カンマ区切りでrss取得用のurlを指定

// categoryには以下を使用してください
// comic
// music
// anime
// game

/*
 * type RSSの種類
 * template 取得してくるサイト名
 * date_format 日付の規定
 * date_attribute なんだっけ
 * category カテゴリ
 * expire キャッシュの制限時間
 * pre_hash 現在所持しているrssデータのハッシュ値(未実装)
 */
return array(

	array(
		'url' => 'http://www.famitsu.com/rss/fcom_all.rdf',
		'type' => Util_Rss::RSS_2,
		'template' => 'famitsu',
		'date_format' => DateTime::RSS,
		'date_attribute' => 'pubDate',
		'category' => 'game',
                'expire' => '1801',
	),

	// array(
	//	'url' => 'http://feeds.fc2.com/fc2/xml?host=jumpmatome2ch.blog&format=xml',
	//	'type' => Util_Rss::RSS_1,
	//	'template' => 'jumpmatome'
	//),
	array(
		'url' => 'http://otanews.livedoor.biz/index.rdf',
		'type' => Util_Rss::RSS_1,
		'template' => 'otanews',
		'date_format' => DateTime::ATOM,
		'date_attribute' => 'dc:date',
		'category' => 'anime',
                'expire' => '1201',
	),
	array(
		'url' => 'http://jumpsokuhou.com/index.rdf',
		'type' => Util_Rss::RSS_1,
		'template' => 'jumpsokuhou',
		'date_format' => DateTime::ATOM,
		'date_attribute' => 'dc:date',
		'category' => 'comic',
                'expire' => '2411',
	),
    	array(
		'url' => 'http://natalie.mu/comic/feed/news',
		'type' => Util_Rss::RSS_ATOM,
		'template' => 'comicnatalie',
		'date_format' => DateTime::ATOM,
		'date_attribute' => 'updated',
		'category' => 'comic',
                'expire' => '3607',
	),
        array(
		'url' => 'http://natalie.mu/music/feed/news',
		'type' => Util_Rss::RSS_ATOM,
		'template' => 'musicnatalie',
		'date_format' => DateTime::ATOM,
		'date_attribute' => 'updated',
		'category' => 'music',
                'expire' => '1511',
	),
        /*
        array(
		'url' => 'http://www.4gamer.net/rss/index.xml',
		'type' => Util_Rss::RSS_1,
		'template' => '4gamer',
		'date_format' => DateTime::ATOM,
		'date_attribute' => 'dc:date'
	), */
        array(
		'url' => 'http://rss.rssad.jp/rss/barks/barks_news_jpop.rdf',
		'type' => Util_Rss::RSS_1,
		'template' => 'barksjpop',
		'date_format' => DateTime::ATOM,
		'date_attribute' => 'dc:date',
		'category' => 'music',
                'expire' => '2113',
	), 
        array(
		'url' => 'http://rss.rssad.jp/rss/barks/barks_news_oversea.rdf',
		'type' => Util_Rss::RSS_1,
		'template' => 'barksoversea',
		'date_format' => DateTime::ATOM,
		'date_attribute' => 'dc:date',
		'category' => 'music',
                'expire' => '3067',
	), 
        array(
		'url' => 'http://animeanime.jp/rss/index.rdf',
		'type' => Util_Rss::RSS_1,
		'template' => 'animeanime',
		'date_format' => DateTime::ATOM,
		'category' => 'anime',
		'date_attribute' => 'dc:date',
                'expire' => '5430',
	),
        array(
		'url' => 'http://tokyo-anime-news.jp/?feed=rss2',
		'type' => Util_Rss::RSS_2,
		'template' => 'tokyoanime',
		'date_format' => DateTime::RSS,
		'category' => 'anime',
		'date_attribute' => 'pubDate',
                'expire' => '5430',
	),
);