{foreach $communities as $community}
	{View_Smarty::forge("parts/community/communityUnit", ['community' => $community])}
	<div class="pure-u-1" align="center">
	{if $community@iteration == count($communities)}
		{$pagination|default:"" nofilter}
	{/if}	
	</div>
{foreachelse}
	コミュニティはありません
{/foreach}
