<div class="col-md-8 col-md-offset-2" style="margin-bottom:50px;">
    <div class="row">
        <div class="col-md-2" align="right">
            <img src="user-image.jpg" class="img-circle" width="80">
            <p align="center" style="color:#ccc;margin-top:10px;">{$date}</p>
        </div>
        <div class="col-md-10">
            <legend><a href="" style="font-size:10pt;">{$user_name}</a></legend>
            <div style="margin-top:-10px;margin-bottom:5px;" align="right">
                <a href="#" >{Asset::img('icon/good.png', ['width' => 26])}{$good_number|default:0}</a>&nbsp;&nbsp;
                <a href="#" >{Asset::img('icon/favorite.png', ['width' => 24])}{$favorite_number|default:0}</a>
            </div>
            <div align="center">
                {$image}
            </div>
            <p style="line-height:2.0em">映画館でよく見るヤツ。フィギュアになったのか！ちょっと欲しい</p>
            <div align="center" style="margin-top:20px;">
                <a href="#" >{Asset::img('icon/good.png', ['width' => 26])}好きに追加</a>
                <a href="#" >{Asset::img('icon/favorite.png', ['width' => 24])}お気に入りに追加</a>
            </div>
        </div>
    </div>
</div>
