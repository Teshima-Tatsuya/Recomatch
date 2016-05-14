
<div style="margin-top:45px;">  
		<ul class="info_list" style="list-style:none;margin-left:-40px;">
			<a href="/gooduser/index">
			<li>
				{$user_name|default:"設定してね"}さん、{$user_count|default:"登録してるユーザー数"}が「ONE PIECE」を{Asset::img('icon/good.png', ['width' => 18, 'class' => 'icon'])}好きに追加しました
			</li>
			</a>
			<a href="/favoriteuser/index">
			<li>
				{$user_name|default:"設定してね"}さん、{$user_count|default:"登録してるユーザー数"}が「オススメの洋楽」を{Asset::img('icon/favorite.png', ['width' => 18, 'class' => 'icon'])}お気に入りに追加しました
			</li>
			</a>
		</ul>
                 
</div>