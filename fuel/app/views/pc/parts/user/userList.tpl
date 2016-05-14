{$column = 3}
{foreach $users as $user}
	{if $user@iteration == 1}
		<div class="contents">
	{/if}
		{if $user@iteration % $column == 1}
			<div class="pure-g userList" align="center" style="margin-top:20px;">
		{/if}
			{View_Smarty::forge("parts/user/userUnit", ['user' => $user])}
			{$div_flag = false}
		{if $user@iteration % $column == 0}
			</div>
			{$div_flag = true}
		{/if}
	{if $user@iteration == count($users)}
		{if $div_flag == false}{* div[class="userList"]の2重閉じ防止 *}
			</div>
		{/if}
		{$pagination|default:"" nofilter}
		</div>
	{/if}
{foreachelse}
	ユーザはいません。
{/foreach}
