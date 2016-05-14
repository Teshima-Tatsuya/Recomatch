<div class="user-area">
	<div class="pure-g" style="padding:30px;margin-top:-19px;">
		<div class="pure-u-1 pure-u-md-4-4">
			<div class="l-box">
				<div align="center">
					<img src="{Model_User::getUserImageUrl($user->id)}" class="img-circle user-image" width="100" height="100" >
					<h2 class="matome">{Model_User::getName($user->id)}</h2>
					<div>
						{View_Smarty::forge("common/parts/button/follow")}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>