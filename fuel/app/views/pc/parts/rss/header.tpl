<div class="pure-menu pure-menu-open pure-menu-horizontal header_menu">
	<ul style="margin-top:20px;">
		<li {if Uri::string() == "rss/index"}class="pure-menu-selected"{/if}><a href="/rss/index" class="menu_tab_myreco myreco_tab">すべて</a></li>
		<li {if Uri::string() == "rss/category/comic"}class="pure-menu-selected"{/if}><a href="/rss/category/comic" class="menu_tab_myreco comic_tab">マンガ</a></li>
		<li {if Uri::string() == "rss/category/music"}class="pure-menu-selected"{/if}><a href="/rss/category/music" class="menu_tab_myreco music_tab">ミュージック</a></li>
		<li {if Uri::string() == "rss/category/anime"}class="pure-menu-selected"{/if}><a href="/rss/category/anime" class="menu_tab_myreco anime_tab">アニメ</a></li>
		<li {if Uri::string() == "rss/category/game"}class="pure-menu-selected"{/if}><a href="/rss/category/game" class="menu_tab_myreco game_tab">ゲーム</a></li>
	</ul>
</div>

