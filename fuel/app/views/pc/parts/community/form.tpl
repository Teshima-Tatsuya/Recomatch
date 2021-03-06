{View_Smarty::forge('/parts/error/errors')}
{$form_input = Session::get_flash('form_input')}
<div align="right"><button id="open-form" class="pure-button pure-button-primary">お題作成</button></div>
<form class="pure-form pure-form-aligned edit_form closable-form" role="form" action="/community/add" method="POST">
	<fieldset style="background-color:#F7F7F7;">
		<div class="pure-control-group">
			<label>お題</label>
			<input class="pure-input-1-2" type="text" name="title" value="{$form_input['title']|default:""}" placeholder="お題を入力して下さい">
		</div>
		<div class="pure-control-group">
			<label>お題の画像</label>
			<input class="pure-input-1-2" id="title" type="text" value="{$form_input['title']|default:""}" placeholder="記入例 ワンピース">
			<button  class="pure-button pure-button-primary get-image">画像取得</button>
		</div>
		<div class="loading" align="center" style="display:none">
			<img src ="/assets/img/common/loading.gif">
			<p>読み込み中</p>
		</div>
		<div class="got_image_area" align="center"></div>

		<div class="pure-control-group" style="margin-top:20px;">
			<label>内容</label>
			<textarea class="pure-input-2-3" rows="3" name="comment" placeholder="内容">{$form_input['comment']|default:""}</textarea>
		</div> 
		<div align="right">
			<button type="submit" class="pure-button pure-button-primary">投稿</button>
		</div> 
	</fieldset>
</form>
