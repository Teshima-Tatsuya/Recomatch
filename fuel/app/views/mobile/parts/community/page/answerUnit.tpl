
<div>
	<h1 class="content-subhead">{$answer->title|default:'タイトル'}</h1>
	<p align="right">{$community->created_at|date_format:"%G/%m/%d"|default:'日付'}</p>
	<div style='padding:5px;' align="center">
		{Model_Item::imageShow($answer->item_id,['width' => '100%'])|default:"設定してね"}
		<div>
			{Asset::img('icon/answer.png', ['width' => 20, 'class' => 'answer-like-button', 'answer_id' => $answer->id])}
			<span class="answer-like-num">{$answer->like_num|default:"0"}</span>
		</div>
	</div>
	<p class="contents_comment">
		{$answer->comment|nl2br|auto_link|default:'コメント'}
	</p>
	{if {$answer->movie_id|default:'ムービー'} != -1}
		<div class="movieWrap">
			<iframe width="100%" height="100%" style="padding-left:10px;" src="http://www.youtube.com/embed/{Model_Movie::getMovieId($answer->movie_id)}" frameborder="0" allowfullscreen></iframe>
		</div>
	{/if}
	<div align="right" style="font-size:10pt;">{Model_User::getName($answer->user_id)}</div>
</div>
