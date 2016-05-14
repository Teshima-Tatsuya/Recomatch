<div class="grids-example">
    <div class="pure-g" style="padding:30px;">
        <div class="pure-u-1 pure-u-md-4-4">
            <div class="l-box">
                <div align="center">
                    <h1 class="contents-title">{$myreco->title|default:"設定してね"}</h1>
                    <div  style="margin-top:10px;">
                        {foreach $myreco->tags as $tag}<a href="/myreco/tag/{$tag->tag}" class="tag">{$tag->tag|default:"設定されてません"}</a>{/foreach}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>