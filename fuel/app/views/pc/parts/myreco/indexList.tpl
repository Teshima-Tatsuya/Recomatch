{foreach $myrecos as $myreco}
	{if $myreco@iteration == 1}
		<div class="contents">
		{/if}
		{View_Smarty::forge("parts/myreco/indexUnit", ['myreco' => $myreco])}
		{if $myreco@iteration == count($myrecos)}
			{$pagination|default:"" nofilter}
		</div>
	{/if}
{foreachelse}
	マイレコの登録はありません
{/foreach}
