<div class="movieUnit">
    <p align="right" style="margin:0px;">{Model_UserActionHistory::getPageView("contents/movie/{$movie->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span></p>
    <h1 class="content-subhead" style="margin-top:0px;"><a href="/contents/movie/{$movie->id}">{$movie->title}</a></h1>
    <div>
        <a href="/user/movie/{$movie->user_id}"><img src="{Model_User::getUserImageUrl($movie->user_id)}" class="img-circle user-image" width="30" height="30">&nbsp;{Model_User::getName($movie->user_id)}</a>
    </div>
    <div class="movieWrap" align="center"><iframe width="100%" height="100%" src="http://www.youtube.com/embed/{$movie->movie_id}" frameborder="0" allowfullscreen></iframe></div>
    <div align="center">    
        <a href="/contents/good/movie/{$movie->id}" >{Asset::img('icon/good.png', ['width' => 24, 'class' => 'icon'])}<span class="good_num">{$movie->good_num|default:"設定してね"}</span></a>&nbsp;&nbsp;
		<a href="/contents/favorite/movie/{$movie->id}" >{Asset::img('icon/favorite.png', ['width' => 24, 'class' => 'icon'])}<span class="favorite_num">{$movie->bookmark_num|default:"設定してね"}</span></a>
    </div>
    <p>
        {$movie->comment|nl2br|auto_link}
    </p>
	<p><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://flinks-start.jp/contents/movie/{$movie->id}" data-counturl="http://flinks-start.jp/contents/movie/{$movie->id}" data-text="『{$movie->title}』Recomatch お気に入りをコレクションしよう" data-count="horizontal" data-lang="ja">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script></p>
	{View_Smarty::forge("common/parts/button/buttons", ['contents' => $movie])}
</div>
