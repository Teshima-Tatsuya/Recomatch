<legend>フォロー</legend>
{for $i = 1 to 5}<!--縦に5つ表示、それ以上は無限スクロール-->
    <div class="row" style="margin-right:0px;margin-left:0px;">
        {for $j = 1 to 3}<!--横に3つ表示-->
            <div class="col-sm-6 col-md-4 section">
                <div class="thumbnail" >
                    <img src="user-image.jpg" class="img-circle" style="margin-bottom:20px;" width="100">
                    <p style="font-weight:bold;font-size:10pt;" align="center"><a href="">{$user_name|default:'name'}</a></p>
                    <p align="center" style="margin-top:15px;">
                        <a href="">{$follow_number|default:'follow_num'}</a>&nbsp;&nbsp;
                        <a href="">{$follower_number|default:'follower_num'}</a>
                    </p>
                    <div class="button">
                        <div align="center" style="margin-top:10px;">
                            <a href="#" class="btn btn-default">解除</a>
                        </div>
                    </div>
                </div>
            </div>
        {/for}
    </div><!--/row-->
{/for}


