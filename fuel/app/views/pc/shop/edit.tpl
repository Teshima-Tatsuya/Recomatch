<div>
	{View_Smarty::forge('/parts/error/errors')}
	{$form_input = Session::get_flash('form_input')}
	<form class="pure-form pure-form-aligned edit_form" role="form" action="/myreco/add" method="POST">
		<fieldset>
			<div class="pure-control-group">
				<label>作品名</label>
				<input class="pure-input-2-3" id="title" type="text" name="title" value="{$form_input['title']|default:""}" placeholder="作品名を入力してください">
			</div>

			<div class="pure-control-group">
				<label>画像URL</label>
				<input class="pure-input-2-3" id="title" type="text" name="title" value="{$form_input['title']|default:""}" placeholder="作品名を入力してください">
			</div>

			<div class="pure-control-group">
				<label>発売日</label>
				<input class="pure-input-2-3" id="title" type="text" name="title" value="{$form_input['title']|default:""}" placeholder="作品名を入力してください">
			</div>

			<div class="pure-control-group" style="margin-top:20px;">
				<label>カテゴリー</label>
				<select class="pure-input-1-3" name="category">
					<option value="0">必ず選択して下さい</option>
					{foreach Model_Category::getAll() as $category}
						<option value="{$category->id}" {if $form_input['category'] == $category->id} selected="selected"{/if}>{$category->name}</option>
					{/foreach}
				</select>
			</div>


			<div class="pure-control-group" style="margin-top:20px;">
				<label>概要orコメント</label>
				<textarea class="pure-input-2-3" rows="6" name="comment">{$form_input['comment']|default:""}</textarea>
			</div> 
			<div align="right">
				<button type="submit" class="pure-button pure-button-primary">投稿</button>
			</div> 
		</fieldset>
	</form>
</div>