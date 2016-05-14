<!DOCTYPE html>
<html lang="ja">
    <head>
        {View_Smarty::forge('parts/head', ['title' => {$title|default:'must set'}])}
    </head>
    <body>
        <div id="layout">
            <!-- Menu toggle -->

            {View_Smarty::forge("/parts/common/side_menu")}
            {View_Smarty::forge("/parts/common/header")}    
            <div class="content" id="main-contents">
                <div class="pure-g">
                    <div class="pure-u-1 pure-u-md-3-4">
                        {$content}
                    </div>
                    <div class="pure-u-1 pure-u-md-1-4">
                        {View_Smarty::forge("/parts/common/side_contents_right")}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
