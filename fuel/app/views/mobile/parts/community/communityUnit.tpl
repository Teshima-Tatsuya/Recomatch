<div>
	<a href="/community/page/{$community->id|default:'url'}">
		<div class="pure-g contents_list">
			<div class="pure-u-1-4 pure-u-md-1-4 contents_image" style="background-image: url('{Model_Item::getImagePath($community->item_id)|default:""}')">
			</div>
			<div class="pure-u-3-4 pure-u-md-3-4">
				<div style="padding-left:10px;">
					<h4 style="margin-top:5px;margin-bottom:0px;">{$community->title|default:'タイトル'}</h4>
					<p align="right" style="padding-right:5px;margin-top:0px;margin-bottom:0px">
					{Asset::img('icon/answer_onclick.png', ['width' => 10])}
					<span class="community-like-num">{$community->like_num|default:"0"}</span>&nbsp;
					{Model_UserActionHistory::getPageView("community/page/{$community->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span>
					<span style="font-size:8pt;font-weight: bold;">回答数</span>{$community->comment_num}
				</div>
			</div>
		</div>
	</a>
</div>