{foreach $features as $feature}
	{View_Smarty::forge("parts/feature/featureUnit", ['feature' => $feature])}
	<div class="pure-u-1" align="center">
	{if $feature@iteration == count($features)}
		{$pagination|default:"" nofilter}
	{/if}	
	</div>
{foreachelse}
	特集はありません。
{/foreach}
