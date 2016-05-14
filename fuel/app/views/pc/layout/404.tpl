<!DOCTYPE html>
<html lang="ja">
    <head>
        {View_Smarty::forge('parts/head', ['title' => {$title|default:'must set'}])}
		<meta http-equiv="refresh" content="3;URL=/">
    </head>
    <body class="bgimage">
        <div id="layout">
            <!-- Menu toggle -->

            {View_Smarty::forge("/parts/common/side_menu")}
            <div class="content" id="main-contents">
                {$content} 
            </div>
        </div>
</body>
</html>
