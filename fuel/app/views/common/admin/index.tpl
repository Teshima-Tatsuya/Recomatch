<div class="pure-g">
	<div class="pure-u-1 pure-u-md-1-1">
		<div class="main_contents">
			<table class="pure-table pure-table-bordered">
				<thead>
					<tr>
						<th>ユーザーID</th>
						<th>ユーザー名</th>
						<th>IPアドレス</th>
						<th>開いたページ</th>
						<th>アクセス日時</th>
					</tr>
				</thead>

				<tbody>
					{foreach $uahs as $uah}
						<tr>
							<td>{$uah->user_id}</td>
							<td>{$uah->user->name|default:"guest"}</td>
							<td>{$uah->ip_address}</td>
							<td>{$uah->visit_page}</td>
							<td>{$uah->visit_time}</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
			{$pagination}
		</div>
	</div>
</div>
