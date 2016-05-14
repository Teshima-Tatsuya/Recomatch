<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{Asset::img("common/recomatch.png", ['width' => 80,'style' => 'margin-top:-12px;'])}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="">ホーム</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="margin-top:0px;">
                        <img src="{Model_User::getUserImageUrl($me->id)}" class="img-circle" width="24" style="margin-top:-5px;">マイメニュー<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/mypage/feed">{Asset::img("icon/newspaper-64.png", ['width' => 16,'style' => 'vertical-align:top'])}フィード</a></li>
                        <li><a href="/mypage/timeline/myreco">{Asset::img("icon/timeline.png", ['width' => 16,'style' => 'vertical-align:top'])}タイムライン</a></li>
                        <li><a href="/mypage/favorite">{Asset::img("icon/favorite.png", ['width' => 16,'style' => 'vertical-align:top'])}お気に入り</a></li>
                        <li><a href="/mypage/follow">{Asset::img("icon/user.png", ['width' => 16,'style' => 'vertical-align:top'])}フォロー</a></li>
                        <li><a href="/mypage/follow">{Asset::img("icon/user.png", ['width' => 16,'style' => 'vertical-align:top'])}フォロワー</a></li>
                        <li><a href="#">{Asset::img("icon/info.png", ['width' => 16,'style' => 'vertical-align:top'])}お知らせ</a></li>
                    </ul>
                </li>
                <li><a href="#about">カテゴリー</a></li>
                <li><a href="#contact">使い方</a></li>
                <li><a href="/login/twitter" >twitterから</a></li>
            <li><a href="/login/facebook" >facebookから</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">ログアウト</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
