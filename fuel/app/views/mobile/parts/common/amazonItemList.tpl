<p>画像タップして選択して下さい</p>
<table>
	{$column = 3}
	{foreach $items as $item}
		{if ($item@iteration % $column) == 1}
			<tr>
		{/if}
			<td width="200" align="center">
				<img src="{$item['MediumImage']['URL']}" itemURL="{$item['DetailPageURL']}" width="80">
			</td>
		{if ($item@iteration % $column) == $column}
			</tr>
		{/if}
	{foreachelse}
		<span>キーワードに該当する商品がありません。</span>
	{/foreach}
</table>