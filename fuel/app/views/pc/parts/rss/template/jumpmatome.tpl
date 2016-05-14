<div class="pure-g contents_list">
	<div class="pure-u-1 pure-u-md-5-24">
		<div style="padding-left:10px;">
			<div class='index_list'>{$rss['content:encoded']|html_entity_decode|default:""}</div> <!-- 記事の内容（一部） -->
		</div>
	</div>
	<div class="pure-u-1 pure-u-md-19-24">
		<div style="padding-left:10px;">
			<a href="{$rss['link']}" target="_blank"><h5 style="margin-top:0px;">{$rss['title']|default:"設定してね"}</h5></a> <!-- 記事のタイトル -->
			<!-- コメントをここに表示 -->
			<div class="index_list">{$rss['content:encoded']|html_entity_decode|default:""}</div>
		</div>
	</div>
</div>
