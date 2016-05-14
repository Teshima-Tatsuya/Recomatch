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
                </div>                 
            </div>
        </div>
        {View_Smarty::forge("parts/js")}

    </body>
</html>
