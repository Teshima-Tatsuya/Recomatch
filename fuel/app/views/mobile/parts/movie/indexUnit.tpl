<a href="/contents/movie/{$movie->id}">
	<div class="pure-g contents_list">
		<div class="pure-u-1-4 pure-u-md-1-4 contents_image" style="background-image: url('http://img.youtube.com/vi/{$movie->movie_id}/2.jpg')">
		</div>
		<div class="pure-u-3-4 pure-u-md-3-4">
			<div class="contents_title">
				<h4 style="margin-top:5px;margin-bottom:0px;">{$movie->title}</h4>
				<p style="margin-top:5px;margin-bottom:0px;font-size:8pt;"><img src="{Model_User::getUserImageUrl($movie->user_id)}" class="img-circle user-image" width="15" height="15">&nbsp;{Model_User::getName($movie->user_id)}</p>
				<p align="right" style="padding-right:5px;margin-top:0px;margin-bottom:0px">{Model_UserActionHistory::getPageView("contents/movie/{$movie->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span></p>
			</div>
		</div>
	</div>
</a>