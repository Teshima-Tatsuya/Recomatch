<div class="pure-g contents_list rss-contents">
	<div class="pure-u-1 pure-u-md-5-24">
		<div style="padding-left:10px;">
			<div class='index_list'><a href="{$rss['link']}" target="_blank">{$rss['title']|default:""}</a></div> <!-- 記事の内容（一部） -->
                        <p class="rss-label"><span class="_game">4gamer.net</span></p>
		</div>
	</div>
	<div class="pure-u-1 pure-u-md-19-24">
		<div style="padding-left:10px;">
			<a href="{$rss['link']}" target="_blank">{if !empty($rss['description'])}{$rss['description']}{/if}</a>
		</div>
	</div>
</div>
