<div class="pure-g contents_list">
	<div class="pure-u-1 pure-u-md-3-24">
		{$channel['image']|default:"設定してね"}  <!-- 記事の画像 -->
	</div>
	<div class="pure-u-1 pure-u-md-21-24">
		<div style="padding-left:10px;">
			<h5>{$channel['title']|default:"設定してね"}</h5> <!-- 記事のタイトル -->
			<div class='index_list'>{$channel['title'][description]}</div> <!-- 記事の内容（一部） -->
			<div class="pure-g">
				<div class="pure-u-1 pure-u-md-12-24">
					<!-- 記事のリンク -->
					<a href="$channel['link'] target="_blank"">{$channel['title'][link]}</a> 
				</div>
			</div>
		</div>
	</div>
</div>