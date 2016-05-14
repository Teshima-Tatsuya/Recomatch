<div class="header">
    <h1>フィード</h1>
    <h3>フォローしたユーザーの投稿を新着順に表示します</3>
    <div class="pure-menu pure-menu-open pure-menu-horizontal" style="margin-top:20px;" align="center">
        <ul>
            <li {if Uri::string() == "feed/index"}class="pure-menu-selected"{/if}><a href="/feed/index">ホーム</a></li>
            <li {if Uri::string() == "feed/myreco"}class="pure-menu-selected"{/if}><a href="/feed/myreco">マイレコ</a></li>
            <li {if Uri::string() == "feed/matome"}class="pure-menu-selected"{/if}><a href="/feed/matome">まとめ</a></li>
            <li {if Uri::string() == "feed/movie"}class="pure-menu-selected"{/if}><a href="/feed/movie">ムービー</a></li>
        </ul>
    </div>
</div>