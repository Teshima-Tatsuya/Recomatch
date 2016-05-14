<div class="helpMenu tuizui">
	{if Recomatch_Util::isLogin()}
	<p align="center"><img src="{Model_User::getUserImageUrl($me->id)}" class="img-circle" width="150"></p>
	<p style="font-weight:bold;font-size:10pt;" align="center"><a href="">{$me->name|default:"名前がありません"}</a></p>
	<ul class="nav nav-list" style="font-weight: 700;font-size: 10pt;" align="left">
		<li class="" style="padding-bottom:5px;"><a href="/mypage/feed">フィード</a></li>
		<li class="" style="padding-bottom:5px;"><a href="/mypage/timeline/myreco">&nbsp;タイムライン&nbsp;<span class="badge pull-right" style="margin-top:3px;">14</span></a></li>
		<li class="" style="padding-bottom:5px;"><a href="/mypage/favorite">お気に入り&nbsp;<span class="badge pull-right" style="margin-top:3px;">14</span></a></li>
		<li class="" style="padding-bottom:5px;"><a href="/mypage/follow">フォロー</a></li> 
		<li class="" style="padding-bottom:5px;"><a href="/mypage/follower">フォロワー</a></li> 
		<li class="" style="padding-bottom:5px;"><a href="/mypage/info">お知らせ</a></li> 
	</ul>
	{/if}
</div>
