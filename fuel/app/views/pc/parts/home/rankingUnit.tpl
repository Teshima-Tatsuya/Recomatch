<h1 class="content-subhead" style="margin-top:0px;padding-bottom:0px;margin-bottom:0px;font-size:8pt;">{$key + 1}位</h1>
<div class="pure-g ranking_list">
	<div class="pure-u-1 pure-u-md-3-24">
		<img src="{Model_User::getUserImageUrl($ranking['user_id'])}" class="img-circle user-image" width="32" height="32"  style="margin-top:-5px;">
	</div>
	<div class="pure-u-1 pure-u-md-21-24">
		<div style="padding-left:10px;">
			<a href="/user/myreco/{$ranking['user_id']}">{Model_User::getName($ranking['user_id'])|default:"名前がありません"}({$ranking['count']})</a>
		</div>
	</div>
</div>
