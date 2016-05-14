<div style="margin-top:78px;">
    <a href="/matome/contents">
        <div class="matome_list" >
            <div class="pure-u">
                {Asset::img('common/testimage.jpg',['width' => 70, 'style' => 'margin-top:2px;'])}
            </div>

            <div class="pure-u-3-4">

                <h4 class="title">アニメ主題歌でカッコいい曲をまとめました</h4>
                <div class="matome_content" align='right'>
                    {Asset::img('icon/good.png', ['width' => 20, 'class' => 'icon'])}{$myreco->good_num|default:"0"}&nbsp;
                    {Asset::img('icon/favorite.png', ['width' => 20, 'class' => 'icon'])}{$myreco->bookmark_num|default:"0"}
                </div>
            </div>
        </div>
    </a>
                
</div>
                


