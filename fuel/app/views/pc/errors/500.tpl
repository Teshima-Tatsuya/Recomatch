<div align="center" style="margin-top:50px;">
	<h1>システムエラー</h1>
	<div>
		<form class="pure-form pure-form-aligned" role="form" action="/contact/confirmation" method="POST">
			<fieldset> 
				<h3>エラー報告フォーム</h3>
				<div align="right">
					<button class="pure-button pure-button-primary">確認画面へ</button>
				</div> 
				<div class="pure-control-group">
					<label>メールアドレス</label>
					<input class="pure-input-2-3" type="text" name="mailaddress" value="{Session::get_flash('mailaddress')}" placeholder="メールアドレス入力してください">
				</div>

				<div class="pure-control-group" style="margin-top:20px;">
					<label>エラー内容</label>
					<textarea class="pure-input-2-3" rows="6" name="body" placeholder="エラー内容を入力してください。">{Session::get_flash('body')}</textarea>
				</div> 
			</fieldset>
		</form>
	</div>
</div>


