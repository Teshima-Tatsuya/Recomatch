<div>
	{View_Smarty::forge('/parts/error/errors')}
	{$form_input = Session::get_flash('form_input')}
    <form class="pure-form pure-form-aligned edit_form" role="form" action="/movie/add" method="POST">
        <fieldset>
            <legend>ムービー作成</legend>        
            <div class="pure-control-group">
                <label>タイトル</label>
                <input class="pure-input-2-3" type="text" name="title" value="{$form_input['title']|default:""}" placeholder="タイトルを入力してください(必須)">
            </div>
            <div class="pure-control-group" style="margin-top:20px;">
                <label>ムービー</label>
                <input class="pure-input-2-3" type="text" name="movie_url" value="{$form_input['movie_url']|default:""}" placeholder="YoutubeのURLを入力してください(必須)">
            </div>
            <div class="pure-control-group" style="margin-top:20px;">
                <label>コメント</label>
                <textarea class="pure-input-2-3" rows="6" name="comment" placeholder="(任意)">{$form_input['comment']|default:""}</textarea>
            </div>
			<div align="right">
                <button type="submit" class="pure-button pure-button-primary">投稿</button>
            </div> 
        </fieldset>
    </form>
</div>
