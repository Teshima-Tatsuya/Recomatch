{foreach $newses as $news}
<div class="col-md-8 col-md-offset-2" style="margin-bottom:50px;">
    <div class="row">
        <div class="col-md-2" align="right">
            <img src="{Model_User::getUserImageUrl($news->user_id)}" width="70" class="img-circle" ><!-- ユーザ画像 -->
                <p align="center" style="color:#ccc;margin-top:10px;">{$news->created_at|default:time()}</p>
        </div>
        <div class="col-md-10">
            <legend><a href="" style="font-size:10pt;">{Model_User::getName($news->user_id)|default:"名無し"}</a></legend>
            <div style="margin-top:-10px;margin-bottom:5px;" align="right">
                <a href="#" >{Asset::img('icon/good.png', ['width' => 26])}{$good_number|default:0}</a>&nbsp;&nbsp;
                <a href="#" >{Asset::img('icon/favorite.png', ['width' => 24])}{$favorite_number|default:0}</a>
            </div>
            <p>{$news->comment|nl2br|default:"コメント"}</p>
            <!-- url入力で取得した情報表示 -->
            <table id="scrapper_text_holder" style="padding: 2px; margin: 2px;"><tbody><tr><td><div id="scrapper_title" style="font-weight: bold; font-size: 14px;">{$link_title|default:"link_title"}</div></td></tr><tr><td><a href="" id="scrapper_url">{$news->url|default:"link_url"}</a></td></tr><tr><td><br><div id="scrapper_description" style="font-weight:bold;">{$news->comment|default:"link_comment"}</div></td></tr></tbody></table>
            <!-- ここまで -->
            <div align="center" style="margin-top:20px;">
                <a href="#" >{Asset::img('icon/good.png', ['width' => 26])}好きに追加</a>
                <a href="#" >{Asset::img('icon/favorite.png', ['width' => 24])}お気に入りに追加</a>
            </div>
        </div>
    </div>
</div>
{/foreach}