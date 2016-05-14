<div style="margin-top:30px;margin-bottom:-40px;">
	<h2>「{$tag_name|default:"タグの名前"}」</h2>
</div>
{View_Smarty::forge("parts/myreco/myrecoList", ['myrecos' => $myrecos])}
