<div class="pure-menu pure-menu-open pure-menu-horizontal header_menu">
	<ul style="margin-top:20px;">
		<li {if Uri::string() == "/user/myreco"}class="pure-menu-selected"{/if}><a href="/user/myreco/{$user->id}" class="menu_tab myreco_tab">マイレコ</a></li>
        <li {if Uri::string() == "/user/movie"}class="pure-menu-selected"{/if}><a href="/user/movie/{$user->id}" class="menu_tab movie_tab">ムービー</a></li>
        <li {if Uri::string() == "/user/follow"}class="pure-menu-selected"{/if}><a href="/user/follow/{$user->id}" class="menu_tab follow_tab">フォロー</a></li>
        <li {if Uri::string() == "/user/follower"}class="pure-menu-selected"{/if}><a href="/user/follower/{$user->id}" class="menu_tab follow_tab">フォロワー</a></li>
	</ul>
</div>
