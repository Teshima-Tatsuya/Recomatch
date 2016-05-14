<div class="grids-header" style="margin-top:44px;" align="center">
    <div class="pure-g" style="margin-right:-2px;" >
        <div class="pure-u-1-3">
            <div class="l-box header_menu myreco_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "myreco/index"}style="color:#000"{/if} href="/myreco/index">ホーム</a>
            </div>
        </div>
		<div class="pure-u-1-3">
            <div class="l-box header_menu myreco_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "myreco/category_menu"}style="color:#000"{/if} href="/myreco/category_menu">カテゴリー</a>
            </div>
        </div>
        <div class="pure-u-1-3">
            <div class="l-box header_menu myreco_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "myreco/edit"}style="color:#000"{/if} href="/myreco/edit">マイレコ投稿</a>
            </div>
        </div>
    </div>
</div>