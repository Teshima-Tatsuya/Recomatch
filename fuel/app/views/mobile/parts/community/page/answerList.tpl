{foreach $answers as $answer}
	{View_Smarty::forge("parts/community/page/answerUnit", ['answer' => $answer])}
	<div class="pure-u-1" align="center">
	{*if $community@iteration == count($communities)*}
		{$pagination|default:"" nofilter}
	{*/if*}	
	</div>
{foreachelse}
	回答はありません
{/foreach}
