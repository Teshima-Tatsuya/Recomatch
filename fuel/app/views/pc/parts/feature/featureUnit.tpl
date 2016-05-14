<div class="pure-g contents_list">
	<div class="pure-u-1 pure-u-md-6-24">
		{Asset::img($feature->image_url,['class' => 'pure-img-responsive'])}
	</div>
	<div class="pure-u-1 pure-u-md-18-24">
		<div style="padding-left:10px;">
			<h5><a href="/feature/page/{$feature->id}">{$feature->title}</a></h5>
			<div class='index_list'>
				{$feature->comment|mb_strimwidth:0:200:"…"|nl2br|auto_link}
			</div>
			<p align="right">{Model_UserActionHistory::getPageView("feature/page/{$feature->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span>&nbsp;&nbsp;&nbsp;<a href="/feature/page/{$feature->id}">続きを読む</a>
			</p>
		</div>
	</div>
</div>