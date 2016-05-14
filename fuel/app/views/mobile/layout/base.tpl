<!DOCTYPE html>
<html lang="ja">
    <head>
        {View_Smarty::forge('parts/head', ['title' => {$title|default:'must set'}])}
    </head>
    <body>
        <div id="layout">
            <!-- Menu toggle -->

            {View_Smarty::forge("/parts/common/side_menu")}
            <div id="main">

            </div>
            {View_Smarty::forge("/parts/home/header")}

            <div class="content">

                {$content} 

            </div>
        </div>
</body>
</html>
