<h1 class="contents_title">{$answer->title|default:'タイトル'}</h1>
<div class="pure-g" style="padding:5px;">		
	<div class="pure-u-1 pure-u-md-5-24">		
		<div style='padding:5px;' align="center">
			{Model_Item::imageShow($answer->item_id,['width' => '100%','height' => '100%'])|default:"設定してね"}
			<div>
			{Asset::img('icon/answer.png', ['width' => 20, 'class' => 'answer-like-button', 'answer_id' => $answer->id])}
			<span class="answer-like-num">{$answer->like_num|default:"0"}</span>
		</div>
		</div>
	</div>

	<div class="pure-u-1 pure-u-md-19-24">
		<p class="contents_comment">
			{$answer->comment|nl2br|auto_link|default:'コメント'}
		</p>
		{if {$answer->movie_id|default:-1} != -1}
			<div class="movieWrap">
				<iframe width="200px" style="padding-left:10px;" src="http://www.youtube.com/embed/{Model_Movie::getMovieId($answer->movie_id)}" frameborder="0" allowfullscreen></iframe>
			</div>
		{/if}
		<div align="right" style="font-size:10pt;">
			{$answer->created_at|date_format:"%G/%m/%d"|default:'日付'}
			{Model_User::getName($answer->user_id)}
		</div>
	</div>
</div>
