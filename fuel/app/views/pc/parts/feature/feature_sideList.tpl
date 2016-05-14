{foreach $features_right as $feature}
	{if $feature@iteration == 1}
		<div class="contents">
		{/if}
		{View_Smarty::forge("parts/feature/feature_sideUnit", ['feature' => $feature])}
		{if $feature@iteration == count($feature)}
		</div>
	{/if}
{foreachelse}
	特集はありません。
{/foreach}
