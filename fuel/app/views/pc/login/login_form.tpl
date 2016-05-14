<div style="margin-top:60px;" align="center">
	<h4>Recomatchのアカウントでログイン</h4>
	{View_Smarty::forge('/parts/error/errors')}
	{$form_input = Session::get_flash('form_input')}
	<form class="pure-form pure-form-aligned" role="form" action="/login/normal" method="POST">
		<fieldset>
			<div class="pure-control-group">
				<input type="text" name="id" value="{$form_input['id']|default:""}" placeholder="ID">
				<input type="password" name="password" value="{$form_input['password']|default:""}" placeholder="パスワード">
				<button type="submit" name="login" value="login" class="pure-button pure-button-primary">ログイン</button>
				<button type="submit" name="new" value="new" class="pure-button pure-button-primary">新規登録</button>
			</div>
		</fieldset>
	</form>
</div>