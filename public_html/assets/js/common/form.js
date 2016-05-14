$(function() {
	$("#open-form").click(function(e) {
		// formのsubmitをキャンセル
		e.preventDefault();


		$(".closable-form").slideToggle(500);
	});

	// errorが存在した場合はフォームを開く
	if($(".error").length) {
		$("#open-form").trigger("click");
	};
});
