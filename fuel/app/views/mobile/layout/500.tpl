<!doctype html>
<html lang="en">
    <head>
        {View_Smarty::forge('parts/head', ['title' => {$title|default:'must set'}])}
    </head>
    <body class="bgimage">
        <div id="layout">
            {View_Smarty::forge("/parts/common/side_menu")}

            <div id="main-contents">
                <div class="content" style="padding-left:9px;padding-right:7px;">
                    {View_Smarty::forge("/parts/common/header")}
                    {$content}
                </div>
            </div>
        </div>

        {View_Smarty::forge("parts/js")}
        
    </body>
</html>
