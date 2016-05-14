{foreach $features_home_header as $feature}
	{if $feature@iteration == 1}
		<div class="contents">
		{/if}
		{View_Smarty::forge("parts/feature/featureUnit", ['feature' => $feature])}
		{if $feature@iteration == count($feature)}
		</div>
	{/if}
{foreachelse}
	特集はありません。
{/foreach}
