<!DOCTYPE html>
<html lang="ja">
    <head>
        {View_Smarty::forge('parts/head', ['title' => {$title|default:'must set'}])}
    </head>
    <body class="bgimage">
        <div id="layout">
            <!-- Menu toggle -->

            {View_Smarty::forge("/parts/common/side_menu")}
			{View_Smarty::forge("/parts/common/header")}
            <div class="content" id="main-contents">
                {$content} 

            </div>
        </div>
</body>
</html>
