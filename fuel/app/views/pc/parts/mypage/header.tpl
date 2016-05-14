<div class="pure-menu pure-menu-open pure-menu-horizontal header_menu">
	<ul style="margin-top:20px;">
		<li {if Uri::string() == "mypage/myreco"}class="pure-menu-selected"{/if}><a href="/mypage/myreco" class="menu_tab myreco_tab">マイレコ</a></li>	
		<li {if Uri::string() == "mypage/movie"}class="pure-menu-selected"{/if}><a href="/mypage/movie" class="menu_tab movie_tab">ムービー</a></li>
	</ul>
</div>


