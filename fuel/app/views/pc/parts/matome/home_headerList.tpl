{foreach $matomes_home_header as $matome}
		{View_Smarty::forge("parts/matome/home_headerUnit", ['matome' => $matome])}
		
{foreachelse}
	特集はありません。
{/foreach}
