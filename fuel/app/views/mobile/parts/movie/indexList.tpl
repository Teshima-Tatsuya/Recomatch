{foreach $movies as $movie}
	{if $movie@iteration == 1}
		<div>
	{/if}
	{View_Smarty::forge("parts/movie/indexUnit", ['movie' => $movie])}
	{if $movie@iteration == count($movies)}
		{$pagination|default:"" nofilter}
		</div>
	{/if}
{foreachelse}
	<p style="margin-top:30px;">動画の投稿はありません</p>	
{/foreach}

