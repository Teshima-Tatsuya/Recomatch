<table>
	{$column = 4}
	{foreach $items as $item}
		{if !empty($item['MediaUrl'])}
			{if ($item@iteration % $column == 1)}
				<tr height='200'>
			{/if}
				<td width='200' align='center'>
					<img height='90%' width='90%' src="{$item['MediaUrl']}" itemURL="{$item['SourceUrl']}">
				</td>
			{if (($item@iteration % $column) == $column)}
				</tr>
			{/if}
		{/if}
	{foreachelse}
		<span>キーワードに該当する商品がありません。</span>
	{/foreach}
</table>