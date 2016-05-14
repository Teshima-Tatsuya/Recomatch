<!doctype html>
<html lang="en">
    <head>
        {View_Smarty::forge('parts/head', ['title' => {$title|default:'must set'}])}
    </head>
    <body>
        <div id="layout">
            {View_Smarty::forge("/parts/common/side_menu")}

            <div id="main-contents">
                {View_Smarty::forge("/parts/common/header")}
                {View_Smarty::forge("/parts/matome/contents_menu")}
                <div class="grids-example" style="margin-top:45px;">
                    <div class="pure-g" style="padding-top:25px;padding-bottom:15px;">
                        <div class="pure-u-1 pure-u-md-4-4">
                            <div class="l-box">
                                <div align="center">
                                    <h3>オススメのアニソン</h3>
                                    <h4>フランクリーフリンクス</h4>
                                    <div align="center">
                                        <a class="pure-button" href="#">{Asset::img('icon/good.png', ['width' => 24, 'class' => 'icon'])}好きに追加</a>
                                        <a class="pure-button" href="#">{Asset::img('icon/favorite.png', ['width' => 24, 'class' => 'icon'])}お気に入りに追加</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content" style="margin-top:10px;padding-left:9px;padding-right:7px;">
                    {$content}
                </div>
            </div>
        </div>

        {View_Smarty::forge("parts/js")}

    </body>
</html>
