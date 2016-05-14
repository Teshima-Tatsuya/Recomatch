<div align="right"><button id="open-form" class="pure-button pure-button-primary">回答を作成</button></div>
	{View_Smarty::forge('/parts/error/errors')}
	{$form_input = Session::get_flash('form_input')}
	<form class="pure-form pure-form-aligned edit_form closable-form enable-validation" role="form" action="/community/addAnswer" method="POST">
		<fieldset style="background-color:#F7F7F7;">
			<div class="pure-control-group">
				<label>作品名</label>
				<input class="pure-input-1-2 validate[required]" id="title" type="text" name="title" value="{$form_input['title']|default:""}" placeholder="作品名を入力してください">
				<button  class="pure-button pure-button-primary get-image">画像取得</button>
			</div>
			<div class="loading" align="center" style="display:none">
				<img src ="/assets/img/common/loading.gif">
				<p>読み込み中</p>
			</div>
			<div class="got_image_area" align="center"></div>

			<div class="pure-control-group" style="margin-top:20px;">
				<label>ムービー</label>
				<input class="pure-input-2-3 validate[custom[url]]" type="text" name="movie_url" value="{$form_input['movie_url']|default:""}" placeholder="YoutubeのURL(任意)">
			</div>

			<div class="pure-control-group" style="margin-top:20px;">
				<label>コメント</label>
				<textarea class="pure-input-2-3 validate[required]" rows="3" name="comment" placeholder="コメント">{$form_input['comment']|default:""}</textarea>
			</div>
			<input type="hidden" name="community_id" value="{Uri::segment(3)}" />
			<input type="hidden" class="validate[required]"name="image_input" id="image_input" value=""/>
			<div align="right">
				<button type="submit" class="pure-button pure-button-primary">投稿</button>
			</div> 
		</fieldset>
	</form>