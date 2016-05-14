
{foreach $communities as $community}
	{View_Smarty::forge("parts/community/communityUnit", ['community' => $community])}
	{if $community@iteration == count($communities)}
		{$pagination|default:"" nofilter}
	{/if}
{foreachelse}
	コミュニティはありません。
{/foreach}
