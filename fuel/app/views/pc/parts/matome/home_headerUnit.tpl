<div class="pure-u-1 pure-u-md-1-1">
	<a href="/matome/page/{$matome->id}">
		<div style='padding:5px;'>
			{Asset::img($matome->image_url,['width' => '100%','height' => '250'])}
			<h3 style="margin:0px;">{$matome->title}</h3>
			<p align="right" style="margin:0px;">{Model_UserActionHistory::getPageView("matome/page/{$matome->id}")|default:0}<span style="font-size:8pt;font-weight: bold;">view</span></p>
		</div>
	</a>
</div>