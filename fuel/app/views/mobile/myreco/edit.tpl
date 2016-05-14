<div class="edit_page">
	{View_Smarty::forge('/parts/error/errors')}
	{$form_input = Session::get_flash('form_input')}
    <form class="pure-form pure-form-aligned edit_form" role="form" action="/myreco/add" method="POST">
        <fieldset>
            <div class="pure-control-group">
                <label>作品名</label>
                <input class="pure-input-1" id="title" type="text" name="title" value="{$form_input['title']|default:""}" placeholder="作品名を入力してください">
				<div align="right"><button class="pure-button pure-button-primary get-image">画像取得</button></div>
            </div>
			<div class="loading" align="center" style="display:none">
				<img src ="/assets/img/common/loading.gif">
				<p>読み込み中</p>
			</div>
			<div class="got_image_area" align="center"></div>

            <div class="pure-control-group" style="margin-top:20px;">
                <label>カテゴリー</label>
                <select class="pure-input-2-3" name="category">
                    <option value="0">必ず選択して下さい</option>
                    {foreach Model_Category::getAll() as $category}
                        <option value="{$category->id}" {if $form_input['category'] == $category->id} selected="selected"{/if}>{$category->name}</option>
                    {/foreach}
                </select>
            </div>
                
            <div class="pure-control-group" style="margin-top:20px;">
                <label>タグ</label>
                <input class="pure-input-1" type="text" name="tag" value="{$form_input['tag']|default:""}" placeholder="タグは,(カンマ)で区切って下さい">
            </div>

            <div class="pure-control-group" style="margin-top:20px;">
                <label>ムービー</label>
                <input class="pure-input-1" type="text" name="movie_url" value="{$form_input['movie_url']|default:""}" placeholder="YoutubeのURLを入力してください">
            </div>
                
            <div class="pure-control-group" style="margin-top:20px;">
                <label>コメント</label>
                <textarea class="pure-input-1" rows="6" name="comment" placeholder="この作品のおすすめポイント">{$form_input['comment']|default:""}</textarea>
            </div>
            <div align="right">
                <button type="submit" class="pure-button pure-button-primary">投稿</button>
            </div> 
        </fieldset>
    </form>
</div>