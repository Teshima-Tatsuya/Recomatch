<a href="#">
	<div class="pure-g">
		<div class="pure-u-1-4 pure-u-md-1-4">
			{Model_Item::imageShow($myreco->item_id,['class' => 'pure-img-responsive','style' => 'padding-left:10px;padding-top:10px;'])|default:"設定してね"}
		</div>
		<div class="pure-u-3-4 pure-u-md-3-4">
			<div style="padding-left:20px;">
				<h3>{$myreco->title|default:"設定してね"}</h3>
				<p><img src="{Model_User::getUserImageUrl($myreco->user_id)}" class="img-circle" width="32" height="32"style="margin-top:-5px;">&nbsp;{Model_User::getName($myreco->user_id)|default:"名前がありません"}</p>
			</div>
		</div>
	</div>
</a>