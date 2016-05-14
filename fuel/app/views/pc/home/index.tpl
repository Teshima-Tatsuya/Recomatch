<div class="pure-g">
	<div class="pure-u-1 pure-u-md-16-24">
		<div class="main_contents">
			<h1 class="content-subhead" style="padding-bottom:0px;margin-bottom:0px;">コミュニティ</h1>
			{View_Smarty::forge("/parts/community/communityList")}
			<P align="right"><a href="/community/index">コミュニティ一覧へ</a></P>
		</div>

		<div class="main_contents">
			<h1 class="content-subhead" style="padding-bottom:0px;margin-bottom:0px;">マイレコ</h1>
			{View_Smarty::forge("/parts/myreco/indexList")}
			<P align="right"><a href="/myreco/index">マイレコ一覧へ</a></P>
		</div>

		<div class="main_contents">
			<h1 class="content-subhead" style="padding-bottom:0px;margin-bottom:0px;">ニュース</h1>
			{View_Smarty::forge("/parts/rss/rssList")}
		</div>
		
		<div class="main_contents">
			<h1 class="content-subhead" style="padding-bottom:0px;margin-bottom:0px;">ムービー</h1>
			{View_Smarty::forge("/parts/movie/indexList")}
			<P align="right"><a href="/movie/index">ムービー一覧へ</a></P>
		</div>
	</div>
	<div class="pure-u-1 pure-u-md-8-24">
		{View_Smarty::forge("/parts/common/side_contents_right")}
	</div>
</div>
