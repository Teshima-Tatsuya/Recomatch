<div class="grids-header" style="margin-top:44px;" align="center">
    <div class="pure-g">
        <div class="pure-u-1-2">
            <div class="l-box header_menu movie_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "movie/index"}style="color:#000"{/if} href="/movie/index">ホーム</a>
            </div>
        </div>
        <div class="pure-u-1-2 header_menu movie_menu" style="padding-top:5px;padding-bottom:5px;">
            <div class="l-box">
                <a {if Uri::string() == "movie/edit"}style="color:#000"{/if} href="/movie/edit">ムービー投稿</a>
            </div>
        </div>
    </div>
</div>