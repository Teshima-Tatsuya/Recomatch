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
						<div class="main_contents">
							{View_Smarty::forge("/parts/feature/view_tweet")}
							{$content}
							<h1 class="feature-subhead">関連マイレコ</h1>
							{View_Smarty::forge("/parts/feature/myreco_button")}
							{View_Smarty::forge("/parts/myreco/indexList")}
						<p align="right"><a href="/feature/index">特集一覧へ</a></p>
						</div>
					</div>
					<div class="pure-u-1 pure-u-md-8-24">
						{View_Smarty::forge("/parts/common/side_contents_right")}
					</div>
				</div>
            </div>
        </div>
	</body>
</html>
