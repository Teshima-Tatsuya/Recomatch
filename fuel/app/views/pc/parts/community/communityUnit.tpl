<div class="pure-g contents_list">
	<div class="pure-u-1 pure-u-md-6-24">
		{Model_Item::imageShow($community->item_id,['class' => 'pure-img-responsive'])}
	</div>
	<div class="pure-u-1 pure-u-md-18-24">
		<div style="padding-left:10px;">
			<h5><a href="/community/page/{$community->id|default:'url'}">{$community->title|default:'タイトル'}</a></h5>
			<div class='index_list'>
				{$community->comment|mb_strimwidth:0:200:"…"|nl2br|auto_link|default:'コメント'}
			</div>
			<p align="right">
			{Asset::img('icon/answer_onclick.png', ['width' => 15, 'class' => 'community-like-button', 'community_id' => $community->id])}
			<span class="community-like-num">{$community->like_num|default:"0"}</span>&nbsp;&nbsp;&nbsp;
			{Model_UserActionHistory::getPageView("community/page/{$community->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span>&nbsp;&nbsp;&nbsp;
			<span style="font-size:8pt;font-weight: bold;">回答数</span>{$community->comment_num}&nbsp;&nbsp;&nbsp;
			<a href="/community/page/{$community->id|default:'url'}">続きを読む</a>
			</p>
			<p align="right">
				{$community->created_at|date_format:"%G/%m/%d"|default:'日付'}
			</p>
		</div>
	</div>
</div>


