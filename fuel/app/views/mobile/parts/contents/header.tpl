<div class="pure-menu pure-menu-open pure-menu-horizontal" style="margin-top:20px;" align="center">
    <ul>
        <li {if Uri::string() == "contents/index"}class="pure-menu-selected"{/if}><a href="/contents/index">ホーム(5)</a></li>
        <li {if Uri::string() == "contents/good"}class="pure-menu-selected"{/if}><a href="/contents/good">好き(10)</a></li>
        <li {if Uri::string() == "contents/favorite"}class="pure-menu-selected"{/if}><a href="/contents/favorite">お気に入り(5)</a></li>
    </ul>
</div>
