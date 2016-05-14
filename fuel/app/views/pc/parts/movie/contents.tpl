<div class="row">
    <div class="col-md-8 col-md-offset-2" style="margin-bottom:50px;">
        <div class="row">
            <div class="col-md-2" align="right">
                <img src="user-image.jpg" width="80" class="img-circle" ><!-- ユーザ画像 -->
            </div>
            <div class="col-md-10">
                <legend style="font-size:10pt;">{Model_User::getName($myreco->user_id)|default:"名前がありません"}</legend>
                <div style="margin-top:-10px;margin-bottom:5px;" align="right">
                    {Asset::img('icon/good.png', ['width' => 26])}(10)&nbsp;&nbsp;
                    {Asset::img('icon/favorite.png', ['width' => 24])}(5)
                </div>
                <iframe width="600" height="338" src="http://www.youtube.com/embed/xCIJJ2Rb368" frameborder="0" allowfullscreen></iframe>
                <p style="line-height:2.0em">吉良の祖先ジョニィ・ジョースターが、かつて杜王町で奇妙な死を遂げたことを知った康穂。定助に伝えようと東方家へ向かうが、「瞑想の松」の根元に空いた穴に引きずり込まれてしまった! 穴の中にいた人物とは…!?</p>
                <div align="center" style="margin-top:20px;">
                    <a href="#">{Asset::img('icon/good.png', ['width' => 26])}好きに追加</a>
                    <a href="#" >{Asset::img('icon/favorite.png', ['width' => 24])}お気に入りに追加</a>
                </div>
            </div>
        </div>
    </div>
</div>