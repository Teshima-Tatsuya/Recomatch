
<a href="/contents/{Uri::segment(2)}/{$info->contents_id}"">

	<li>
		<span style="font-weight:bold;">{$info->info_num|default:"登録してるユーザー数"}人</span>が{$info->myreco->title}を<span style="font-weight:bold;">{Recomatch_Constants::$ACTION_MAP[$info->action_type]['ja']}</span>に追加しました
	</li>
</a>
