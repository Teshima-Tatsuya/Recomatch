<div class="grids-header" style="margin-top:44px;" align="center">
    <div class="pure-g">
        <div class="pure-u-1-2">
            <div class="l-box header_menu myreco_menu">
                <a {if Uri::string() == "feed/myreco"}style="color:#000"{/if} href="/feed/myreco">マイレコ</a>
            </div>
        </div>
        <div class="pure-u-1-2 header_menu movie_menu">
            <div class="l-box">
                <a {if Uri::string() == "feed/movie"}style="color:#000"{/if} href="/feed/movie">ムービー</a>
            </div>
        </div>
    </div>
</div>