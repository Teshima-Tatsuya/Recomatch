<div class="pure-g contents_list">
	<div class="pure-u-1 pure-u-md-1-1">
		{Asset::img($matome->image_url,['class' => 'pure-img-responsive'])}
	</div>
	<div class="pure-u-1 pure-u-md-1-1">
		<div style="padding-left:10px;">
			<h5><a href="/matome/page/{$matome->id}">{$matome->title}</a></h5>
			<div class='index_list'>
				{$matome->comment|mb_strimwidth:0:200:"…"|nl2br|auto_link}
			</div>
			<p align="right" style="margin:0px;">{Model_UserActionHistory::getPageView("matome/page/{$matome->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span></p>
			<p align="right" style="margin:0px;"><a href="/matome/page/{$matome->id}">続きを読む</a></p>
		</div>
	</div>
</div>