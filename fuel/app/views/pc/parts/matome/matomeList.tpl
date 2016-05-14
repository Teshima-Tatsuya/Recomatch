{foreach $matomes as $matome}
	{View_Smarty::forge("parts/matome/matomeUnit", ['matome' => $matome])}
	
{foreachelse}
	まとめはありません。
{/foreach}
