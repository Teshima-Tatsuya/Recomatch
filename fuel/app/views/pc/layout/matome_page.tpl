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
					<div class="pure-u-1 pure-u-md-16-24">
						{$content}
						<p align="right"><a href="/matome/index">まとめ一覧へ</a></p>
					</div>
					<div class="pure-u-1 pure-u-md-8-24">
						{View_Smarty::forge("/parts/common/side_contents_right")}
					</div>
				</div>
            </div>
        </div>
	</body>
</html>
