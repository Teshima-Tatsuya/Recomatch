<div style="margin-top:40px;">  
	<ul class="info_list" style="list-style:none;margin-left:-40px;">
		{foreach $infos as $info}
			{View_Smarty::forge("parts/info/infoUnit", ['info' => $info])}
		{foreachelse}
			<li>お知らせはありません</li>
			{/foreach}
	</ul>           
</div>   
