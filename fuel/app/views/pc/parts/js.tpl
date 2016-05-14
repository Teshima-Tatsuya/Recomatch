<script src="//code.jquery.com/jquery-2.0.2.min.js"></script>
{Asset::js('common/jquery/jquery.validationEngine.js')}
{Asset::js('common/jquery/jquery.validationEngine-ja.js')}
{Asset::js('pc/jquery-ui-1.10.3.custom.min.js')}
{Asset::js('common/jquery/jquery.infinitescroll.min.js')}
{Asset::js('common/infiniteScroll.js')}
{Asset::js('common/recomatch.js')}
{Asset::js('common/googleAnalytics.js')}
{Asset::render('add_js')}
<script>
	$(function () {
		$(".enable-validation").validationEngine();
	});
</script>
