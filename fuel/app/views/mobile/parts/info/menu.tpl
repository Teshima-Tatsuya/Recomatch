<div class="grids-header" style="margin-top:44px;" align="center">
    <div class="pure-g">
        <div class="pure-u-1-2">
            <div class="l-box header_menu myreco_menu">
                <a {if Uri::string() == "info/myreco"}style="color:#000"{/if} href="/info/myreco">マイレコ</a>
            </div>
        </div>
        <div class="pure-u-1-2">
            <div class="l-box header_menu movie_menu">
                <a {if Uri::string() == "info/movie"}style="color:#000"{/if} href="/info/movie">ムービー</a>
            </div>
        </div>
    </div>
</div>