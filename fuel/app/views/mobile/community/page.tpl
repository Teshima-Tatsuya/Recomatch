 <div style="padding:10px;margin-bottom:-70px;">
    {View_Smarty::forge("/parts/community/view_tweet")}
</div>
<div class="pure-g" style="margin-top:-44px;padding:5px;">
	<div class="main_contents feature_contents">
		<h1 class="content-subhead">{$community->title|default:'タイトル'}</h1>
		<p align="right">{$community->created_at|date_format:"%G/%m/%d"|default:'日付'}</p>
		<div align="center">
			{Model_Item::imageShow($community->item_id,['width' => '100%'])|default:"設定してね"}
			<div>
				{Asset::img('icon/answer.png', ['width' => 20, 'class' => 'community-like-button', 'community_id' => $community->id])}
				<span class="answer-like-num">{$answer->like_num|default:"0"}</span>
			</div>
		</div>
		<p class="contents_comment">
			{$community->comment|nl2br|default:"コメント"}
		</p>
		{View_Smarty::forge("/parts/community/page/answer_form")}
		{View_Smarty::forge("/parts/community/page/answerList")}
	</div>
</div>
