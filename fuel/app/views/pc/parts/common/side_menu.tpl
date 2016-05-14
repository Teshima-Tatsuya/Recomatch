<div id="menu" style="background-color: #393f48;">
	<div class="pure-menu pure-menu-open">

		<ul>
			<li style="padding-top:10px;padding-right:10px;">
				<form class="pure-form pure-form-aligned" action="/search/myreco" method="GET">
					<input type="text" id="search_word" name="key" class="pure-input-1 " placeholder="検索">
				</form>
			</li>
			{* 未ログインならば表示 *}
			{if !Recomatch_Util::isLogin()}
			<li><a href="/login/index">{Asset::img('icon/login.png',['width' => '24','class' => 'icon'])}ログイン</a></li>
			{/if}
			<li><a href="/home/index">{Asset::img('icon/home.png',['width' => '24','class' => 'icon'])}ホーム</a></li>
			<li><a href="/community/index">{Asset::img('icon/community.png',['width' => '24','class' => 'icon'])}コミュニティ</a></li>
			<li><a href="/feature/index">{Asset::img('icon/feature.png',['width' => '24','class' => 'icon'])}特集</a></li>
			<li><a href="/matome/index">{Asset::img('icon/matome.png',['width' => '24','class' => 'icon'])}まとめ</a></li>
			<li><a href="/rss/index">{Asset::img('icon/rss.png',['width' => '24','class' => 'icon'])}ニュース</a></li>
			<li><a href="/myreco/index">{Asset::img('icon/add-myreco.png',['width' => '24','class' => 'icon'])}マイレコ</a></li>
			<li><a href="/movie/index">{Asset::img('icon/movie.png',['width' => '24','class' => 'icon'])}ムービー</a></li>
			{if Recomatch_Util::isLogin()}
			<li><a href="/feed/myreco">{Asset::img('icon/newspaper-64.png',['width' => '24','class' => 'icon'])}フィード</a></li>
			<li><a href="/mypage/myreco" ><img src="{Model_User::getUserImageUrl($me->id)}" class="img-circle" width="24" height="24"style="margin-top:-5px;">マイページ</a></li>
			<li><a href="/favorite/myreco">{Asset::img('icon/favorite.png',['width' => '24','class' => 'icon'])}お気に入り</a></li>
			<li><a href="/follow/follow">{Asset::img('icon/user.png',['width' => '24','class' => 'icon'])}フォロー</a></li>
			<li><a href="/follow/follower">{Asset::img('icon/user.png',['width' => '24','class' => 'icon'])}フォロワー</a></li>
			<li><a href="/info/index">{Asset::img('icon/warning-64-hover.png',['width' => '24','class' => 'icon'])}お知らせ（{Model_Info::getNum($me->id)|default:'未読数'}）</a></li>
			{/if}
			<li><a href="/contact/index">{Asset::img('icon/contact.png',['width' => '24','class' => 'icon'])}お問い合わせ</a></li>
			{if Recomatch_Util::isLogin()}
			<li><a href="/login/logout">{Asset::img('icon/logout.png',['width' => '24','class' => 'icon'])}ログアウト</a></li>
			{if Model_User::isAdmin($me)}
			<li><a href="/admin/index">管理</a></li>
			{/if}
			{/if}
		</ul>
	</div>
</div>

