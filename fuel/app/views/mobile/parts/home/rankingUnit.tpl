<div>
	<a href="/user/myreco/{$ranking['user_id']}">
		<div class="pure-g contents_list">
			<img src="{Model_User::getUserImageUrl($ranking['user_id'])}" class="img-circle user-image" width="64" height="64" >
			<div class="pure-u-3-4 pure-u-md-3-4">
				<div style="padding-left:10px;">
					<h4 style="margin-top:5px;margin-bottom:0px;">{$key + 1}位</h4>
					<p style="padding-right:5px;margin-top:0px;margin-bottom:0px">{Model_User::getName($ranking['user_id'])|default:"名前がありません"}({$ranking['count']})</p>
				</div>
			</div>
		</div>
	</a>
</div>