<div id="pagination" align="center">
	<a href="{Uri::create(Input::uri(), [], ['page' => (intval(Input::get('page', 1)) + 1), 'key' => Input::get('key')])}"></a>
</div><!-- /#pagination -->
