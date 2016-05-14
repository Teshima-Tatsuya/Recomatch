{foreach $ranking_list as $key => $ranking}
	{View_Smarty::forge("parts/home/rankingUnit", ['ranking' => $ranking, 'key' => $key])}
{foreachelse}
	ランキングはありません。
{/foreach}
