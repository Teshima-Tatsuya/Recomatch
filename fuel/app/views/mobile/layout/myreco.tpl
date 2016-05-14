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
					{$content}
                    <div align="center" style="margin-top:10px;margin-bottom:30px;"><a href="#main-contents"><button class="pure-button delete-button" href="#">トップへ戻る</button></a></p>
                    </div>
                    <!-- AMoAd Zone: [Recomatch／320×50] -->
                    <div class="amoad_frame sid_62056d310111552cb5b0b732f20cd9de0944bf8670c96707c9429b2dd8fcdf6b container_div color_#0000CC-#444444-#FFFFFF-#0000FF-#009900 sp fit"></div>
                    <script src='//j.amoad.com/js/aa.js' type='text/javascript' charset='utf-8'></script>
				</div>
            </div>
        </div>

        {View_Smarty::forge("parts/js")}

    </body>
</html>
