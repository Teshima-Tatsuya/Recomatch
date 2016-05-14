<div class="pure-g contents_list">
	<div class="pure-u-1 pure-u-md-3-24">
		<img width='100%' style='margin-top:20px;' src="http://img.youtube.com/vi/{$movie->movie_id}/2.jpg"/>
	</div>
	<div class="pure-u-1 pure-u-md-21-24">
		<div style="padding-left:10px;">
			<h5><a href="/contents/movie/{$movie->id}">{$movie->title}</a></h5>
			<div class='index_list'>{$movie->comment|mb_strimwidth:0:200:"…"|nl2br|auto_link}</div>
			<div class="pure-g">
				<div class="pure-u-1 pure-u-md-12-24">
					<a href="/user/movie/{$movie->user_id}" class="index_list"><img src="{Model_User::getUserImageUrl($movie->user_id)}" class="img-circle user-image" width="15" height="15">&nbsp;{Model_User::getName($movie->user_id)}</a>
				</div>
				<div class="pure-u-1 pure-u-md-12-24" align="right">
					{Model_UserActionHistory::getPageView("contents/movie/{$movie->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span>&nbsp;&nbsp;
					<a href="/contents/good/movie/{$movie->id}" class="index_list">{Asset::img('icon/good.png', ['width' => 18, 'class' => 'icon', 'style' => 'margin-top:-10px;'])}<span class="good_num">{$movie->good_num|default:"設定してね"}</span></a>&nbsp;&nbsp;
					<a href="/contents/favorite/movie/{$movie->id}" class="index_list">{Asset::img('icon/favorite.png', ['width' => 18, 'class' => 'icon', 'style' => 'margin-top:-10px;'])}<span class="favorite_num">{$movie->bookmark_num|default:"設定してね"}</span></a>
				</div>
			</div>
		</div>
	</div>
</div>
