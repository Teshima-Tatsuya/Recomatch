$(function() {
	$('#main-contents').infinitescroll({
		navSelector: "#pagination", // ナビゲーション要素を指定します。
		nextSelector: "#pagination a", // ナビゲーションの「次へ」の要素を指定します。
		itemSelector: ".contents", // 表示させる要素を指定します。
		dataType: "php", // 読み込むデータの形式を指定します。
		loading: {
			finishedMsg: '<span id="finishedMsg">すべての読み込みが終了しました。</span>',
			msgText: '<span id="loadingMsg">読み込み中...</span>',
			speed: 'fast'
		},
	},
	function(arrayOfNewElems) {
		twttr.widgets.load();
	});
});