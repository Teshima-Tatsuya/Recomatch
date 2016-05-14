$(function() {
  $('#main-contents').infinitescroll({
    navSelector: "#pagination",
    nextSelector: "#pagination a",
    itemSelector: ".contents",
    dataType: "php",
    loading: {
      finishedMsg: '<span id="finishedMsg">すべての読み込みが終了しました。</span>',
      msgText: '<span id="loadingMsg">読み込み中...</span>',
      speed: 'fast'
    }
  }, function(arrayOfNewElems) {
    twttr.widgets.load();
  });
});
