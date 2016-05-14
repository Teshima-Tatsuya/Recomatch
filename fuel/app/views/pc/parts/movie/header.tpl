<div class="pure-menu pure-menu-open pure-menu-horizontal header_menu">
	<ul style="margin-top:20px;">
		<li {if Uri::string() == "movie/index"}class="pure-menu-selected"{/if}><a href="/movie/index" class="menu_tab movie_tab">ホーム</a></li>
		<li {if Uri::string() == "movie/edit"}class="pure-menu-selected"{/if}><a href="/movie/edit" class="menu_tab movie_tab">ムービー投稿</a></li>
	</ul>
</div>
