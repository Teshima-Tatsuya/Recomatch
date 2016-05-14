<div class="pure-u-1 pure-u-md-1-3 userUnit">
	<img src="{Model_User::getUserImageUrl($user->id)}" class="img-circle user-image" width="100" height="100" >
	<h4><a href="/user/myreco/{$user->id}">{Model_User::getName($user->id)}</a></h4>
	<div class="pure-g" align="center">
		<div class="pure-u-1 pure-u-md-1-2">
			<a href="/user/myreco/{$user->id}">マイレコ<br/>{Model_Myreco::getNum($user->id)|default:"設定してね"}</a>
		</div>
		<div class="pure-u-1 pure-u-md-1-2">
			<a href="/user/movie/{$user->id}">ムービー<br/>{Model_Movie::getNum($user->id)|default:"設定してね"}</a>
		</div>
	</div>
	<div align="center">
		{View_Smarty::forge("common/parts/button/follow")}
	</div>
</div>