<div class="follow_list">
	<div class="pure-u">
		<img src="{Model_User::getUserImageUrl($user->id)}" class="img-circle user-image" width="64" height="64" >
	</div>

	<div class="pure-u-3-4">
		<a href="/user/myreco/{$user->id}">{Model_User::getName($user->id)}</a>
		<div class="follow_content" align="right">
			{View_Smarty::forge("common/parts/button/follow")}
		</div>

	</div>
</div>

