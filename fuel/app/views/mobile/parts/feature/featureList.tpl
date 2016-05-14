{foreach $features as $feature}
	{View_Smarty::forge("parts/feature/featureUnit", ['feature' => $feature])}
	{if $feature@iteration == count($features)}
		{$pagination|default:"" nofilter}
	{/if}
{foreachelse}
	特集はありません。
{/foreach}
