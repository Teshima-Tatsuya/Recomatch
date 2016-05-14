<div class="pure-menu pure-menu-open pure-menu-horizontal header_menu">
	<ul style="margin-top:20px;">
		<li {if Uri::string() == "favorite/myreco"}class="pure-menu-selected"{/if}><a href="/favorite/myreco" class="menu_tab myreco_tab">マイレコ</a></li>
		<li {if Uri::string() == "favorite/movie"}class="pure-menu-selected"{/if}><a href="/favorite/movie" class="menu_tab movie_tab">ムービー</a></li>
	</ul>
</div>
