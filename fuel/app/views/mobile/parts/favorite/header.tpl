<div class="header">
    <h1>お気に入り</h1>
    <div class="pure-menu pure-menu-open pure-menu-horizontal" style="margin-top:20px;" align="center">
        <ul>
            <li {if Uri::string() == "favorite/myreco"}class="pure-menu-selected"{/if}><a href="/favorite/myreco">マイレコ</a></li>
            <li {if Uri::string() == "favorite/matome"}class="pure-menu-selected"{/if}><a href="/favorite/matome">まとめ</a></li>
            <li {if Uri::string() == "favorite/movie"}class="pure-menu-selected"{/if}><a href="/favorite/movie">ムービー</a></li>
        </ul>
    </div>
</div>