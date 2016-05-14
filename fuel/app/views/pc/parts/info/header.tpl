<div class="pure-menu pure-menu-open pure-menu-horizontal header_menu">
	<h1 align="center" style='margin:10px;padding-top:7px;padding-bottom:8px;'>お知らせ</h1>
	<ul style="margin-top:20px;">
		<li {if Uri::string() == "info/myreco"}class="pure-menu-selected"{/if}><a href="/info/myreco" class="menu_tab myreco_tab">マイレコ</a></li>	
		<li {if Uri::string() == "info/movie"}class="pure-menu-selected"{/if}><a href="/info/movie" class="menu_tab movie_tab">ムービー</a></li>
	</ul>
</div