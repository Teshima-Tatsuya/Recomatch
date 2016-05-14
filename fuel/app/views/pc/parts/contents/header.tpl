<div class="pure-menu pure-menu-open pure-menu-horizontal header_menu">
	<h1 align="center" style='margin:0px;padding-top:20px;padding-bottom:8px;'>{$content->title|default:"作品名"}</h1>
	<ul style="margin-top:20px;">
		<li {if Uri::string() == "contents/good/{Uri::segment(3)}/{$content->id}"}class="pure-menu-selected"{/if}><a href="/contents/good/{Uri::segment(3)}/{$content->id|default:"設定してね"}" class="menu_tab favorite_good_tab">好き（{$content->good_num|default:"設定してね"}）</a></li>
		<li {if Uri::string() == "contents/favorite/{Uri::segment(3)}/{$content->id}"}class="pure-menu-selected"{/if}><a href="/contents/favorite/{Uri::segment(3)}/{$content->id|default:"設定してね"}" class="menu_tab favorite_good_tab">お気に入り（{$content->bookmark_num|default:"設定してね"}）</a></li>
	</ul>
</div>



