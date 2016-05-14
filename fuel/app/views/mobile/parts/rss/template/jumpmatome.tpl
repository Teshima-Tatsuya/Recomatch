<a href="{$rss['link']}" target="_blank">
	<div class="pure-g contents_list">
		<div class="pure-u-3-4 pure-u-md-19-24">
			<div style="padding:5px;">
				<h5 style="margin-top:0px;margin-bottom:0px;">{$rss['title']|mb_strimwidth:0:100:"…"|default:"設定してね"}</h5><!-- 記事のタイトル -->
				<!-- コメントをここに表示 -->
				<p class="rss-label"><span class="label rss_comic">ジャンプ速報</span></p>
			</div>
		</div>
		<div class="pure-u-1-4 pure-u-md-4-24">
			<div class="test">
				{$rss['content:encoded']|html_entity_decode|regex_replace:'/(<div.*?>)(.*?)(<img.*?>)(.*?)(<\/div>)(.*)/s':'\1\3\5'|default:""}
			</div>
		</div>
	</div>
</a>




