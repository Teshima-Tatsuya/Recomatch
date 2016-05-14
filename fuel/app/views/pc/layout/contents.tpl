<!DOCTYPE html>
<html lang="ja">
    <head>
        {View_Smarty::forge('parts/head', ['title' => {$title|default:'must set'}])}
    </head>
    <body>
        <div id="layout">
            <!-- Menu toggle -->

            {View_Smarty::forge("/parts/common/side_menu")}
            <div class="content"　id="main-contents">
				{View_Smarty::forge("/parts/contents/header")}
                <div class="contents_area">				
					{$content} 
				</div>
            </div>
        </div>
    </body>
</html>
