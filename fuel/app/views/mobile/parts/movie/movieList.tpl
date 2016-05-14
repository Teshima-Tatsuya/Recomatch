{foreach $movies as $movie}
	{if $movie@iteration == 1}
		<div class="contents" style="padding-left:8pt;padding-right:7pt;">
	{/if}
	{View_Smarty::forge("parts/movie/movieUnit", ['movie' => $movie])}
	{if $movie@iteration == count($movies)}
		{$pagination|default:"" nofilter}
		</div>
	{/if}
{foreachelse}
	<p style="margin-top:30px;">動画の投稿はありません</p>	
{/foreach}

