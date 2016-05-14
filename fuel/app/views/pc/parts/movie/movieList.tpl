{foreach $movies as $movie}
	{if $movie@iteration == 1}
		<div class="contents">
	{/if}
	{View_Smarty::forge("parts/movie/movieUnit", ['movie' => $movie])}
	{if $movie@iteration == count($movies)}
		{$pagination|default:"" nofilter}
		</div>
	{/if}
{foreachelse}
	動画の投稿はありません	
{/foreach}

