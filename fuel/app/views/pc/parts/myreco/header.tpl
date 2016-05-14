<div class="pure-menu pure-menu-open pure-menu-horizontal header_menu">
	<ul style="margin-top:20px;">
		<li {if Uri::string() == "myreco/index"}class="pure-menu-selected"{/if}><a href="/myreco/index" class="menu_tab_myreco myreco_tab">すべて</a></li>
		<li {if Uri::string() == "myreco/category/comic"}class="pure-menu-selected"{/if}><a href="/myreco/category/comic" class="menu_tab_myreco comic_tab">マンガ</a></li>
		<li {if Uri::string() == "myreco/category/book"}class="pure-menu-selected"{/if}><a href="/myreco/category/book" class="menu_tab_myreco book_tab">書籍</a></li>
		<li {if Uri::string() == "myreco/category/music"}class="pure-menu-selected"{/if}><a href="/myreco/category/music" class="menu_tab_myreco music_tab">ミュージック</a></li>
		<li {if Uri::string() == "myreco/category/anime"}class="pure-menu-selected"{/if}><a href="/myreco/category/anime" class="menu_tab_myreco anime_tab">アニメ</a></li>
		<li {if Uri::string() == "myreco/category/movie"}class="pure-menu-selected"{/if}><a href="/myreco/category/movie" class="menu_tab_myreco movies_tab">映画</a></li>
		<li {if Uri::string() == "myreco/category/game"}class="pure-menu-selected"{/if}><a href="/myreco/category/game" class="menu_tab_myreco game_tab">ゲーム</a></li>
		<li {if Uri::string() == "myreco/category/drama"}class="pure-menu-selected"{/if}><a href="/myreco/category/drama" class="menu_tab_myreco drama_tab">ドラマ</a></li>
		<li {if Uri::string() == "myreco/edit"}class="pure-menu-selected"{/if}><a href="/myreco/edit" class="menu_tab_myreco myreco_tab">マイレコ投稿</a></li>
	</ul>
</div>

