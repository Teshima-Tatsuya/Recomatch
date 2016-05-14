<div class="pure-g contents_list rss-contents">
	<div class="pure-u-1 pure-u-md-19-24">
		<a href="{$rss['link']}" target="_blank">
		<div style="padding-left:10px;">
			<h5 style="margin-top:0px;">{$rss['title']|default:"設定してね"}</h5> <!-- 記事のタイトル -->
			<!-- コメントをここに表示 -->
			<p class="rss-label"><span class="label rss_comic">ジャンプ速報</span></p>
		</div>
		</a>
	</div>
	<div class="pure-u-1 pure-u-md-5-24">
		<div class="test">
			<a href="{$rss['link']}" target="_blank">{$rss['content:encoded']|html_entity_decode|regex_replace:'/.*(<div.*?>)(.*?)(<img.*?>)(.*?)(<\/div>)(.*)/s':'\1\3\5'|default:""}</a>
		</div>
	</div>
</div>




