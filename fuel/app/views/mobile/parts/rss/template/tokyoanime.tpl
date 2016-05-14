<a href="{$rss['link']}" target="_blank">
	<div class="pure-g contents_list">
		<div class="pure-u-1 pure-u-md-1-1">
			<div style="padding:5px;">
				<h5 style="margin-top:0px;margin-bottom:0px;">{$rss['title']|mb_strimwidth:0:100:"…"|default:"設定してね"}</h5> <!-- 記事のタイトル -->
				<!-- コメントをここに表示 -->
				<div class="index_list">{$rss['discription']|default:""}</div>
				<p class="rss-label"><span class="label rss_anime">トーキョーアニメニュース</span></p>
			</div>
		</div>
	</div>
</a>
