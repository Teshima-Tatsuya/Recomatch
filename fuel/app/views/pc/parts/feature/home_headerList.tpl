{foreach $features_home_header as $feature}
		{View_Smarty::forge("parts/feature/home_headerUnit", ['feature' => $feature])}
		
{foreachelse}
	特集はありません。
{/foreach}
