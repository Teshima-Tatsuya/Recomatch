<div>
    <h1 class="content-subhead">ONE PIECE</h1>
    <div class="pure-g">
        <div class="pure-u-1 pure-u-md-1-4">
            {Asset::img('common/no_image.png',['class' => 'pure-img-responsive'])}
        </div>
        <div class="pure-u-1 pure-u-md-3-4">
            <div class="pure-g">
                <div class="pure-u-1 pure-u-md-3-4">
                    <img src="user-image.jpg" class="img-circle"  width="30">&nbsp;フランクリーフリンクス
                </div>
                <div class="pure-u-1 pure-u-md-1-4" align="right">    
                    <a href="#" ><img src="icon/good.png" class="icon" width="24">10</a>&nbsp;&nbsp;
                    <a href="#" ><img src="icon/favorite.png" class="icon" width="24">5</a>
                </div>
            </div>
            <div  style="margin-top:10px;">
                <a class="tag" href="#">将棋</a>
                <a class="tag" href="#">マンガ</a>
                <a class="tag" href="#">アニメ</a>
            </div>
            <p>
                高校進学を前に、ひなたは零の通う高校を受験することを決意。零もそんなひなたに勉強を教えながら将棋を指す中で、今の自分にとってひなたの存在がいかに大きいかを自覚し出し…。
            </p>
            <div align="right">
                <a class="pure-button" href="#"><img src="icon/good.png" class="icon" width="24">好きに追加</a>
                <a class="pure-button" href="#"><img src="icon/favorite.png" class="icon" width="24">お気に入りに追加</a>
            </div>
            <div align="center" style="margin-top:20px;">
                <iframe width="640" height="350" src="http://www.youtube.com/embed/_rjgqU34B3s" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>              
    </div>
</div>

<div>
    <h1 class="content-subhead">サカナクション　夜の踊り子</h1>
    <div class="pure-g">
        <div class="pure-u-1 pure-u-md-4-4">
            <div class="pure-g">
                <div class="pure-u-1 pure-u-md-3-4">
                    <img src="user-image.jpg" class="img-circle" width="30">&nbsp;フランクリーフリンクス
                </div>
                <div class="pure-u-1 pure-u-md-1-4" align="right">    
                    <a href="#" >{Asset::img('icon/good.png', ['width' => 24, 'class' => 'icon'])}{$movie->good_num|default:"設定してね"}</a>&nbsp;&nbsp;
                    <a href="#" >{Asset::img('icon/favorite.png', ['width' => 24, 'class' => 'icon'])}{$movie->bookmark_num|default:"設定してね"}</a>
                </div>
            </div>
            <div style="margin-top:20px;" align="center"><iframe width="640" height="360" src="http://www.youtube.com/embed/6AozElbRnTM" frameborder="0" allowfullscreen></iframe></div>
            <p>
                高校進学を前に、ひなたは零の通う高校を受験することを決意。零もそんなひなたに勉強を教えながら将棋を指す中で、今の自分にとってひなたの存在がいかに大きいかを自覚し出し…。
            </p>
            <div align="right">
                <a class="pure-button" href="#">{Asset::img('icon/good.png', ['width' => 24, 'class' => 'icon'])}好きに追加</a>
                <a class="pure-button" href="#">{Asset::img('icon/favorite.png', ['width' => 24, 'class' => 'icon'])}お気に入りに追加</a>
            </div>
        </div>             
    </div>
</div>


<div>
    <h1 class="content-subhead">アニメ主題歌でカッコいい曲をまとめました</h1>
    <div class="pure-g">
        <div class="pure-u-1 pure-u-md-4-4">
            <div class="pure-g">
                <div class="pure-u-1 pure-u-md-3-4">
                    <img src="user-image.jpg" class="img-circle" width="30">&nbsp;フランクリーフリンクス
                </div>
                <div class="pure-u-1 pure-u-md-1-4" align="right">    
                    <a href="#" >{Asset::img('icon/good.png', ['width' => 24, 'class' => 'icon'])}{$myreco->good_num|default:"設定してね"}</a>&nbsp;&nbsp;
                    <a href="#" >{Asset::img('icon/favorite.png', ['width' => 24, 'class' => 'icon'])}{$myreco->bookmark_num|default:"設定してね"}</a>
                </div>
            </div>
            <p>
                高校進学を前に、ひなたは零の通う高校を受験することを決意。零もそんなひなたに勉強を教えながら将棋を指す中で、今の自分にとってひなたの存在がいかに大きいかを自覚し出し…。
            </p>
            <p><a href="">{Asset::img('icon/matome.png',['width' => '24','class' => 'icon'])}このまとめを見る</a></p>
            <div align="right">
                <a class="pure-button" href="#">{Asset::img('icon/good.png', ['width' => 24, 'class' => 'icon'])}好きに追加</a>
                <a class="pure-button" href="#">{Asset::img('icon/favorite.png', ['width' => 24, 'class' => 'icon'])}お気に入りに追加</a>
            </div>
        </div>             
    </div>
</div>