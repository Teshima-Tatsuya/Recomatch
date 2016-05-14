<table>
	{$column = 4}
	{foreach $items as $item}
		{if ($item@iteration % $column) == 1}
			<tr height='200'>
		{/if}
			<td width='200' align='center'>
				<img src="{$item['MediumImage']['URL']}" itemURL="{$item['DetailPageURL']}">
			</td>
		{if ($item@iteration % $column) == $column}
			</tr>
		{/if}
	{foreachelse}
		<span>キーワードに該当する商品がありません。</span>
	{/foreach}
</table>