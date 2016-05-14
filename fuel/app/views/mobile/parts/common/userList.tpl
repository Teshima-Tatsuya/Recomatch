{$column = 3}
{foreach $user_ids as $user_id}
	{if $user_id@iteration % $column == 1}
	<div class="row" style="margin-top:30px;">
	{/if}
		{View_Smarty::forge("parts/common/userUnit", ['user_id' => $user_id])}
	{if $user_id@iteration % $column == 0}
	</div>
	{/if}
{foreachelse}
	ユーザは存在しません
{/foreach}
{if $user_id@iteration % $column != 0}
</div>
{/if}
