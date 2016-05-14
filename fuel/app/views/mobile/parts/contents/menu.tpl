<div class="grids-header" style="margin-top:44px;" align="center">
    <div class="pure-g">
        <div class="pure-u-1-2">
            <div class="l-box header_menu favorite_good_menu">
                <a {if Uri::string() == "contents/good/{Uri::segment(3)}/{$content->id}"}style="color:#000"{/if} href="/contents/good/{Uri::segment(3)}/{$content->id|default:"設定してね"}">好き</a>
            </div>
        </div>
        <div class="pure-u-1-2">
            <div class="l-box header_menu favorite_good_menu">
                <a {if Uri::string() == "contents/favorite/{Uri::segment(3)}/{$content->id}"}style="color:#000"{/if} href="/contents/favorite/{Uri::segment(3)}/{$content->id|default:"設定してね"}">お気に入り</a>
            </div>
        </div>
    </div>
</div>