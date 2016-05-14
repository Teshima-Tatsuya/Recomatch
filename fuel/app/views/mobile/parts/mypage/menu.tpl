<div class="grids-header" style="margin-top:44px;margin-bottom:80px;" align="center">
    <div class="pure-g">
        <div class="pure-u-1-2">
            <div class="l-box header_menu myreco_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "mypage/myreco"}style="color:#000"{/if} href="/mypage/myreco">マイレコ</a>
            </div>
        </div>
        <div class="pure-u-1-2">
            <div class="l-box header_menu movie_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "mypage/movie"}style="color:#000"{/if} href="/mypage/movie">ムービー</a>
            </div>
        </div>
    </div>
</div>