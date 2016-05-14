<div class="user-area" style="margin-top:-5px;">
	<div class="pure-g" style="padding-top:15px;">
		<div class="pure-u-1 pure-u-md-4-4">
			<div class="l-box">
				<div align="center">
					<img src="{Model_User::getUserImageUrl($user->id)}" class="img-circle user-image" width="80" height="80" >
					<h4 style="margin-top:0px;">{Model_User::getName($user->id)}</h4>
					<div style="margin-top:-10px;padding-bottom:5px;">
						{View_Smarty::forge("common/parts/button/follow")}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>