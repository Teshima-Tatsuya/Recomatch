<div class="grids-header" style="margin-top:44px;margin-bottom:80px;" align="center">
    <div class="pure-g" style="margin-right:-2px;" >
        <div class="pure-u-1-3">
            <div class="l-box header_menu myreco_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "rss/category/comic"}style="color:#000"{/if} href="/rss/category/comic">マンガ</a>
            </div>
        </div>
		<div class="pure-u-1-3">
            <div class="l-box header_menu myreco_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "rss/category/anime"}style="color:#000"{/if} href="/rss/category/anime">アニメ</a>
            </div>
        </div>
        <div class="pure-u-1-3">
            <div class="l-box header_menu myreco_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "rss/category/music"}style="color:#000"{/if} href="/rss/category/edit">ミュージック</a>
            </div>
        </div>
    </div>
</div>