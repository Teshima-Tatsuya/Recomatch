<div class="pure-g" style="background-color: #F46272;padding-left:5px;color:#fff;letter-spacing: 0em;">
	<a href="">特集</a>
</div>
<div style="margin-bottom:10px;">
	<a href="">
		{Asset::img('icon/test/feature1.jpg',['width' => '100%'])}
		<span style="font-weight:bold;padding-left:10px;">3分でわかる</span>「ポルノグラフィティ」
	</a>
</div>
<div style="margin-bottom:10px;">
	<a href="">
		{Asset::img('icon/test/feature2.png',['width' => '100%'])}
		<span style="font-weight:bold;padding-left:10px;">3分でわかる</span>「ONE PIECE」
	</a>
</div>

<div class="pure-g" style="background-color: #F46272;padding-left:5px;color:#fff;letter-spacing: 0em;">
	<a href="">まとめ</a>
</div>
<div style="margin-bottom:10px;">
	<a href="">
		{Asset::img('icon/test/music.jpeg',['width' => '100%'])}
		<span style="font-weight:bold;padding-left:10px;">まとめ</span>「おすすめアニメ主題歌 10曲」
	</a>
</div>

<div class="pure-g" style="background-color: #47AFF3;padding-left:5px;color:#fff;letter-spacing: 0em;">
	<a href="">マイレコ</a>
</div>
<div>	
	{for $i=1 to 5}
		<a href="#">
			<div class="pure-g">
				<div class="pure-u-1-4 pure-u-md-1-4">
					{Model_Item::imageShow($myreco->item_id,['class' => 'pure-img-responsive','style' => 'padding-left:10px;padding-top:10px;'])|default:"設定してね"}
				</div>
				<div class="pure-u-3-4 pure-u-md-3-4">
					<div style="padding-left:20px;">
						<h3>作品名(aタグ)</h3>
						<p>ユーザー名</p>
					</div>
				</div>
			</div>
		</a>
	{/for}		
</div>
<div class="pure-g" style="background-color: #7ED7A9;margin-bottom:10px;padding-left:5px;color:#fff;letter-spacing: 0em;">
	<a href="">ムービー</a>
</div>
<div>
	{for $i=1 to 5}
		<a href="#">
			<div class="pure-g">
				<div class="pure-u-2-5 pure-u-md-2-5">
					<div align="center" style="padding-top:10px;">
						<iframe width="120" height="70" src="http://www.youtube.com/embed/{$movie->movie_id}" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
				<div class="pure-u-3-5 pure-u-md-3-5">
					<div style="padding-left:10px;">
						<h3>動画のタイトル</h3>
						<p>ユーザー名</p>
					</div>
				</div>
			</div>
		</a>
	{/for}
</div>
<div class="pure-g" style="background-color: #FDC44F;padding-left:5px;color:#fff;letter-spacing: 0em;">
	<a href="">PickUp</a>
</div>
<div>	
	{for $i=1 to 5}
		<a href="#">
			<div class="pure-g">
				<div class="pure-u-1-4 pure-u-md-1-4">
					{Model_Item::imageShow($myreco->item_id,['class' => 'pure-img-responsive','style' => 'padding-left:10px;padding-top:10px;'])|default:"設定してね"}
				</div>
				<div class="pure-u-3-4 pure-u-md-3-4">
					<div style="padding-left:20px;">
						<h3>作品名(aタグ)</h3>
						<p>ユーザー名</p>
					</div>
				</div>
			</div>
		</a>
	{/for}		
</div>
