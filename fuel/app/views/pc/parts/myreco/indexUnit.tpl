<div class="pure-g contents_list">
	<div class="pure-u-1 pure-u-md-3-24">
		{Model_Item::imageShow($myreco->item_id,['class' => 'pure-img-responsive', 'style' => 'margin-top:10px;'])|default:"設定してね"}
	</div>
	<div class="pure-u-1 pure-u-md-21-24">
		<div style="padding-left:10px;">
			<h5><a href="/contents/myreco/{$myreco->id}">{$myreco->title|default:"設定してね"}</a></h5>
			<div class='index_list'>{$myreco->comment|mb_strimwidth:0:200:"…"|nl2br|auto_link}</div>
			<div class="pure-g">
				<div class="pure-u-1 pure-u-md-12-24">
					<a href="/user/myreco/{$myreco->user_id}" class='index_list'><img src="{Model_User::getUserImageUrl($myreco->user_id)}" class="img-circle user-image" width="15" height="15"  style="margin-top:-5px;">&nbsp;{Model_User::getName($myreco->user_id)|default:"名前がありません"}</a>
				</div>
				<div class="pure-u-1 pure-u-md-12-24" align="right">
					{Model_UserActionHistory::getPageView("contents/myreco/{$myreco->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span>&nbsp;&nbsp;
					<a href="/contents/good/myreco/{$myreco->id}" class='index_list'>{Asset::img('icon/good.png', ['width' => 18, 'class' => 'icon'])}{$myreco->good_num|default:"設定してね"}</a>&nbsp;&nbsp;
					<a href="/contents/favorite/myreco/{$myreco->id}" class='index_list'>{Asset::img('icon/favorite.png', ['width' => 18, 'class' => 'icon'])}{$myreco->bookmark_num|default:"設定してね"}</a>
				</div>
			</div>
		</div>
	</div>
</div>