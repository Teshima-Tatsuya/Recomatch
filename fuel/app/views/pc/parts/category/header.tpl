<div class="pure-menu pure-menu-open pure-menu-horizontal header_menu">
	<ul style="margin-top:20px;">
		<li {if Uri::string() == "category/index/comic"}class="pure-menu-selected"{/if}><a href="/category/index/comic" class="menu_tab_category comic_tab">マンガ</a></li>
		<li {if Uri::string() == "category/index/book"}class="pure-menu-selected"{/if}><a href="/category/index/book" class="menu_tab_category book_tab">書籍</a></li>
		<li {if Uri::string() == "category/index/music"}class="pure-menu-selected"{/if}><a href="/category/index/music" class="menu_tab_category music_tab">ミュージック</a></li>
		<li {if Uri::string() == "category/index/anime"}class="pure-menu-selected"{/if}><a href="/category/index/anime" class="menu_tab_category anime_tab">アニメ</a></li>
		<li {if Uri::string() == "category/index/movie"}class="pure-menu-selected"{/if}><a href="/category/index/movie" class="menu_tab_category movies_tab">映画</a></li>
		<li {if Uri::string() == "category/index/game"}class="pure-menu-selected"{/if}><a href="/category/index/game" class="menu_tab_category game_tab">ゲーム</a></li>
		<li {if Uri::string() == "category/index/dorama"}class="pure-menu-selected"{/if}><a href="/category/index/dorama" class="menu_tab_category drama_tab">ドラマ</a></li>
	</ul>
</div>
