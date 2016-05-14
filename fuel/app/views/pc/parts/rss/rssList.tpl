
{foreach $rss_list  as $i => $rss_item}
	{View_Smarty::forge("parts/rss/template/{$rss_item['template']}", ['rss' => $rss_item])}
	<!-- ページャーを追加 -->
{foreachelse}
	RSSはありません。
{/foreach}
