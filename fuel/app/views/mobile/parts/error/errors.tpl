{if $errors = Session::get_flash('errors')}
<div class="errors">
	{foreach $errors as $error}
		<p class="error">{$error|default:"エラーを表示"}</p>
	{/foreach}
</div>
{/if}