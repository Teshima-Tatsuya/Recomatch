<a href="{$rss['link']}" target="_blank">
	<div class="pure-g contents_list rss-contents">
		<div class="pure-u-1 pure-u-md-1-1">
			<div style="padding-left:10px;">
				<h5 style="margin-top:0px;">{$rss['title']|default:"設定してね"}</h5> <!-- 記事のタイトル -->
				<!-- コメントをここに表示 -->
				<div class="index_list">{$rss['description']|html_entity_decode|default:""}</div>
				<p class="rss-label"><span class="label rss_music">iLOUD</span></p>
			</div>
		</div>
	</div>
</a>
