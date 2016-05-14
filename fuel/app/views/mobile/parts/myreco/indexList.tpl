{foreach $myrecos as $myreco}
	{if $myreco@iteration == 1}
		<div>
	{/if}
	{View_Smarty::forge("parts/myreco/indexUnit", ['myreco' => $myreco])}
	{if $myreco@iteration == count($myrecos)}
		{$pagination|default:"" nofilter}
		</div>
	{/if}
{foreachelse}
	<p style="margin-top:30px;">マイレコの登録はありません</p>
{/foreach}
