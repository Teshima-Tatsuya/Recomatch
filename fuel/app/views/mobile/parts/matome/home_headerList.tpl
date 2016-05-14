{foreach $matomes_home_header as $matome}
	{if $matome@iteration == 1}
		<div class="contents">
		{/if}
		{View_Smarty::forge("parts/matome/matomeUnit", ['matome' => $matome])}
		{if $matome@iteration == count($matome)}
		</div>
	{/if}
{foreachelse}
	特集はありません。
{/foreach}
