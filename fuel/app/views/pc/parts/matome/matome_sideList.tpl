{foreach $matomes_right as $matome}
	{if $matome@iteration == 1}
		<div class="contents">
		{/if}
		{View_Smarty::forge("parts/matome/matome_sideUnit", ['matome' => $matome])}
		{if $matome@iteration == count($matome)}
		</div>
	{/if}
{foreachelse}
	特集はありません。
{/foreach}
