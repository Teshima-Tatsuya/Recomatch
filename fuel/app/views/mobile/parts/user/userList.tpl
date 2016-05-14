<div style="margin-top:62px;">
{foreach $users as $user}
		{View_Smarty::forge("parts/user/userUnit", ['user' => $user])}
		{if $user@iteration == count($users)}
			{$pagination|default:"" nofilter}
		{/if}
{foreachelse}
	ユーザーはいません
{/foreach}
</div>
