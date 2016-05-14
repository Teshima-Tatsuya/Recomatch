<div class="pure-g contents_list">
	<div class="pure-u-3-4 pure-u-md-5-24">
		<div style="padding-left:10px;">
			<div class='index_list'><a href="{$rss['link']}" target="_blank">{$rss['title']|default:""}</a></div> <!-- 記事の内容（一部） -->
            <p class="rss-label"><span class="label rss_game">4gamer.net</span></p>
		</div>
	</div>
	<div class="pure-u-1-4 pure-u-md-19-24">
		<div style="padding-left:10px;">
			<a href="{$rss['link']}" target="_blank">{if !empty($rss['description'])}{$rss['description']}{/if}</a>
		</div>
	</div>
</div>
