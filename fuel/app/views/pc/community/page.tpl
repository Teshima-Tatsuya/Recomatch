
	<div class="pure-g" style="padding:5px;">		
		<div class="pure-u-1 pure-u-md-5-24">		
			<div style='padding:5px;' align="center">
				{Model_Item::imageShow($community->item_id,['width' => '100%','height' => '100%'])|default:"設定してね"}
				<div>
					{Asset::img('icon/answer.png', ['width' => 20, 'class' => 'community-like-button', 'community_id' => $community->id])}
					<span class="community-like-num">{$community->like_num|default:"0"}</span>
				</div>
			</div>
		</div>

		<div class="pure-u-1 pure-u-md-19-24">
			<h1 class="content-subhead">{$community->title|default:"タイトル"}</h1>
			<p>
				{$community->comment|default:"コメント"}
			</p>
			<p align="right">
				{$community->created_at|date_format:"%G/%m/%d"|default:'日付'}
			</p>
		</div>
	</div>
	{View_Smarty::forge("/parts/community/page/answer_form")}
	{if Session::get_flash('result') == true}
	<p align="center">投稿完了しました。</p>
	{/if}
	{View_Smarty::forge("/parts/community/page/answerList")}
