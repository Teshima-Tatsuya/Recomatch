<div class="pure-menu-fixed" style="background-color: #393f48; " >
    <div id="dl-menu" class="dl-menuwrapper">
    <button class="dl-trigger">Open Menu</button>
    <ul class="dl-menu">
        </li>
            {if !Recomatch_Util::isLogin()}<li><a href="/login/index">{Asset::img('icon/login.png',['width' => '24','class' => 'icon'])}ログイン</a></li>{/if}
        <li><a href="/home/index">{Asset::img('icon/home.png',['width' => '24','class' => 'icon'])}ホーム</a></li>
        <li>
            <a href="#">{Asset::img('icon/community.png',['width' => '24','class' => 'icon'])}コミュニティ</a>
            <ul class="dl-submenu">
                <li><a href="/community/index">一覧</a></li>
                <li><a href="/community/form">お題作成</a></li>
            </ul>
        </li>
        <li><a href="/feature/index">{Asset::img('icon/feature.png',['width' => '24','class' => 'icon'])}特集</a></li>
        <li><a href="/matome/index">{Asset::img('icon/matome.png',['width' => '24','class' => 'icon'])}まとめ</a></li>
        <li>
            <a href="#">{Asset::img('icon/rss.png',['width' => '24','class' => 'icon'])}ニュース</a>
            <ul class="dl-submenu">
                <li><a href="/rss/index">すべて</a></li>
                <li><a href="/rss/category/comic">マンガ</a></li>
                <li><a href="/rss/category/music">ミュージック</a></li>
                <li><a href="/rss/category/anime">アニメ</a></li>
                <li><a href="/rss/category/game">ゲーム</a></li>
            </ul>
        </li>
        <li>
            <a href="/myreco/index">{Asset::img('icon/add-myreco.png',['width' => '24','class' => 'icon'])}マイレコ</a>
            <ul class="dl-submenu">
                <li><a href="/myreco/index">すべて</a></li>
                <li>
                    <a href="#">カテゴリー</a>
                    <ul class="dl-submenu">
                        <li><a href="/myreco/category/comic">マンガ</a></li>
                        <li><a href="/myreco/category/book">書籍</a></li>
                        <li><a href="/myreco/category/music">ミュージック</a></li>
                        <li><a href="/myreco/category/anime">アニメ</a></li>
                        <li><a href="/myreco/category/movie">映画</a></li>
                        <li><a href="/myreco/category/game">ゲーム</a></li>
                        <li><a href="/myreco/category/drama">ドラマ</a></li>
                    </ul>
                </li>
                <li><a href="/myreco/edit">マイレコ登録</a></li>
            </ul>
        </li>
        <li><a href="/movie/index">{Asset::img('icon/movie.png',['width' => '24','class' => 'icon'])}ムービー</a></li>
        {if Recomatch_Util::isLogin()}
        <li>
            <a href="#" ><img src="{Model_User::getUserImageUrl($me->id)}" class="img-circle" width="24" height="24"  style="margin-top:-5px;">マイページ</a>
            <ul class="dl-submenu">
                <li><a href="/mypage/myreco">{Asset::img('icon/add-myreco.png',['width' => '24','class' => 'icon'])}マイレコ</a></li>
                <li><a href="/mypage/movie">{Asset::img('icon/movie.png',['width' => '24','class' => 'icon'])}ムービー</a></li>
                <li>
                    <a href="#">{Asset::img('icon/favorite.png',['width' => '24','class' => 'icon'])}お気に入り</a>
                    <ul class="dl-submenu">
                        <li><a href="/favorite/myreco">{Asset::img('icon/add-myreco.png',['width' => '24','class' => 'icon'])}マイレコ</a></li>
                        <li><a href="/favorite/movie">{Asset::img('icon/movie.png',['width' => '24','class' => 'icon'])}ムービー</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">{Asset::img('icon/user.png',['width' => '24','class' => 'icon'])}フォロー・フォロワー</a>
                    <ul class="dl-submenu">
                        <li><a href="/follow/follow">{Asset::img('icon/user.png',['width' => '24','class' => 'icon'])}フォロー</a></li>
                        <li><a href="/follow/follower">{Asset::img('icon/user.png',['width' => '24','class' => 'icon'])}フォロワー</a></li>
                    </ul>
                </li>
                <li><a href="/info/index">{Asset::img('icon/warning-64-hover.png',['width' => '24','class' => 'icon'])}お知らせ</a></li>
                <li><a href="/login/logout">{Asset::img('icon/logout.png',['width' => '24','class' => 'icon'])}ログアウト</a></li>
            </ul>
        </li>
        {/if}
        <!-- ... -->
    </ul>
</div><!-- /dl-menuwrapper -->
</div>