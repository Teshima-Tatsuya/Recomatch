<div class="grids-header" style="margin-top:44px;" align="center">
    <div class="pure-g">
        <div class="pure-u-1-4">
            <div class="l-box header_menu myreco_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "user/myreco/{$user->id}"}style="color:#000"{/if} href="/user/myreco/{$user->id}">マイレコ</a>
            </div>
        </div>
        <div class="pure-u-1-4">
            <div class="l-box header_menu movie_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "user/movie/{$user->id}"}style="color:#000"{/if} href="/user/movie/{$user->id}">ムービー</a>
            </div>
        </div>
        <div class="pure-u-1-4">
            <div class="l-box header_menu follow_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "user/follow/{$user->id}"}style="color:#000"{/if} href="/user/follow/{$user->id}">フォロー</a>
            </div>
        </div>
		<div class="pure-u-1-4">
            <div class="l-box header_menu follow_menu" style="padding-top:5px;padding-bottom:5px;">
                <a {if Uri::string() == "user/follower/{$user->id}"}style="color:#000"{/if} href="/user/follower/{$user->id}">フォロワー</a>
            </div>
        </div>
    </div>
</div>
