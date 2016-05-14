<div class="myrecoUnit">
	<h1 class="content-subhead"><a href="/contents/myreco/{$myreco->id}">{$myreco->title|default:"設定してね"}</a></h1>
	<div class="pure-g">
		<div class="pure-u-1 pure-u-md-1-4">
			{Model_Item::imageShow($myreco->item_id,['class' => 'pure-img-responsive'])|default:"設定してね"}
			<div align="center"><a href="/myreco/category/{Model_Category::getNameEn($myreco->category_id)|default:""}">{Model_Category::getName($myreco->category_id)|default:""}</a></div>
		</div>
		<div class="pure-u-1 pure-u-md-3-4">
			<div class="pure-g" style="padding-left:10px;">
				<div class="pure-u-1 pure-u-md-2-5">
					<a href="/user/myreco/{$myreco->user_id}"><img src="{Model_User::getUserImageUrl($myreco->user_id)}" class="img-circle user-image" width="32" height="32"  style="margin-top:-5px;">&nbsp;{Model_User::getName($myreco->user_id)|default:"名前がありません"}</a>
				</div>
				<div class="pure-u-1 pure-u-md-3-5" align="right">
					{Model_UserActionHistory::getPageView("contents/myreco/{$myreco->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span>&nbsp;&nbsp;
					<a href="/contents/good/myreco/{$myreco->id}" class="good_link">{Asset::img('icon/good.png', ['width' => 24, 'class' => 'icon',  'style' => 'margin-top:-10px;'])}<span class="good_num">{$myreco->good_num|default:"設定してね"}</span></a>&nbsp;&nbsp;
					<a href="/contents/favorite/myreco/{$myreco->id}"  class="favorite_link">{Asset::img('icon/favorite.png', ['width' => 24, 'class' => 'icon','style' => 'margin-top:-10px;'])}<span class="favorite_num">{$myreco->bookmark_num|default:"設定してね"}</span></a>&nbsp;&nbsp;

					<a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="Recomatch"  data-url="http://flinks-start.jp/contents/myreco/{$myreco->id}" data-counturl="http://flinks-start.jp/contents/myreco/{$myreco->id}" data-text="『{$myreco->title|default:"設定してね"}』Recomatch お気に入りをコレクションしよう" data-count="horizontal" data-lang="ja">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
				</div>
			</div>
			<div style="margin-top:10px;padding-left:10px;">
				{foreach $myreco->tags as $tag}<a href="/myreco/tag/{$tag->tag|default:Uri::segment(3)}" class="tag">{$tag->tag|default:Uri::segment(3)}（{Model_Myreco::countByTag({$tag->tag|default:Uri::segment(3)})}）</a>{/foreach}
			</div>
			
			<p style="padding-left:10px;word-wrap:break-word;">
				{$myreco->comment|nl2br|auto_link}
			</p>
			{if $myreco->movie_id != -1}
				<div class="movieWrap">
					<iframe width="200px" style="padding-left:10px;" src="http://www.youtube.com/embed/{Model_Movie::getMovieId($myreco->movie_id)}" frameborder="0" allowfullscreen></iframe>
				</div>
			{/if}
		</div>
	</div>
	{View_Smarty::forge("common/parts/button/buttons", ['contents' => $myreco])}
</div>
