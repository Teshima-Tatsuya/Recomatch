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
				<div class="contents">
                    <div style="padding:10px;margin-bottom:-70px;">
                        {View_Smarty::forge("/parts/feature/view_tweet")}
                    </div>
					{$content}
                    {View_Smarty::forge("/parts/feature/myreco_button")}
                    <div class="amoad_frame sid_62056d310111552cb5b0b732f20cd9de0944bf8670c96707c9429b2dd8fcdf6b container_div color_#0000CC-#444444-#FFFFFF-#0000FF-#009900 sp fit"></div>
<script src='//j.amoad.com/js/aa.js' type='text/javascript' charset='utf-8'></script>
                    <div class="pure-g" style="background-color: #47AFF3;padding-left:5px;color:#fff;letter-spacing: 0em;">
                        <a href="">関連マイレコ</a>
                    </div>
                    {View_Smarty::forge("/parts/myreco/indexList")}
                    <div class="home_bar" style="background-color: #F46272;padding-left:5px;padding-top:5px;padding-bottom:5px;color:#fff;letter-spacing: 0em;">
                        <a href="/feature/index">特集</a>
                    </div>
                    {View_Smarty::forge("/parts/feature/featureList")}
                    <div align="center" style="margin-top:10px;margin-bottom:30px;"><a href="/feature/index"><button class="pure-button delete-button" href="#">特集一覧へ</button></a></p>
                    </div>
				</div>                 
            </div>
        </div>
        {View_Smarty::forge("parts/js")}

    </body>
</html>
