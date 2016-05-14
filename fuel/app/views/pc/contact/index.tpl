<div>
	{View_Smarty::forge('/parts/error/errors')}
	<form class="pure-form pure-form-aligned" role="form" action="/contact/confirmation" method="POST">
		<fieldset> 
			<legend>お問い合わせ入力フォーム</legend>
			<div align="right">
				<button class="pure-button pure-button-primary">確認画面へ</button>
			</div> 
			<div class="pure-control-group">
				<label>メールアドレス</label>
				<input class="pure-input-2-3" type="text" name="mailaddress" value="{Session::get_flash('mailaddress')}" placeholder="メールアドレス入力してください">
			</div>

			<div class="pure-control-group" style="margin-top:20px;">
				<label>お問い合わせ内容</label>
				<textarea class="pure-input-2-3" rows="6" name="body" placeholder="お問い合わせ内容を入力してください">{Session::get_flash('body')}</textarea>
			</div> 
		</fieldset>
	</form>
</div>