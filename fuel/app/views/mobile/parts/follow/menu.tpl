<div class="grids-header" style="margin-top:44px;" align="center">
    <div class="pure-g">
        <div class="pure-u-1-2">
            <div class="l-box header_menu follow_menu">
                <a {if Uri::string() == "follow/follow"}style="color:#000"{/if} href="/follow/follow">フォロー</a>
            </div>
        </div>
        <div class="pure-u-1-2 header_menu follow_menu">
            <div class="l-box">
                <a {if Uri::string() == "follow/follower"}style="color:#000"{/if} href="/follow/follower">フォロワー</a>
            </div>
        </div>
    </div>
</div>