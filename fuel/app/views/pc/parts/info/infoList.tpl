<div class="contents_area">
	<ul class="info_list contents_area" style="list-style:none;">
		{foreach $infos as $info}
			{View_Smarty::forge("parts/info/infoUnit", ['info' => $info])}
		{foreachelse}
			<li>お知らせはありません</li>
			{/foreach}
	</ul>
</div>    
