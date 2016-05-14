$(function() {
	$(document).on("submit", ".good_add_form, .good_delete_form, .favorite_add_form, .favorite_delete_form, .follow_add_form, .follow_delete_form", function(e) {
		// formのsubmitをキャンセル
		e.preventDefault();

		var form = $(this);
		var button = form.find("button");

		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: form.serialize(),
			timeout: 10000,
			// 送信前
			beforeSend: function(xhr, settings) {
				button.attr("disabled", true);
			},
			// 応答後
			complete: function(xhr, textStatus) {
				button.attr("disabled", false);
			},
			// 通信成功時
			success: function(result, textStatus, xhr) {
			// 削除による数値減少処理
			//if(button.find(".button-string").text() === "取り消し"){
				if (button.hasClass("pushed-button")) {
					button.toggleClass("pushed-button");
					form.attr("action", form.attr("action").replace(/delete/,'add'));
					button.find("img").attr("src", function(i, val) {
						var contents = button.attr("class");
						var ext = ".png";
						var prefix = "/assets/img/icon/";
						var icon = "";
						switch (contents.match(/good|favorite|follow/).toString()) {
							case "good":
								icon = "good";
// favorite good follow のコンテンツ取得
								var myrecoUnit = button.parents("div[class $= 'Unit']");

// 親の要素からたどって、該当のlinkを取得
								var link = myrecoUnit.find(".good_num");

// linkの値を更新
								var link_num = link.text();
								link.text(--link_num);
								button.find(".button-string").text("好き");
								break;
							case "favorite":
								icon = "favorite";
// favorite good follow のコンテンツ取得
								var myrecoUnit = button.parents("div[class $= 'Unit']");
// 親の要素からたどって、該当のlinkを取得
								var link = myrecoUnit.find(".favorite_num");
// linkの値を更新
								var link_num = link.text();
								link.text(--link_num);
								button.find(".button-string").text("お気に入り");
								break;
							case "follow":
								icon = "user";
								button.find(".button-string").text("フォロー");
								break;
							default:
								alert("error");
								break;
						}
						// ここにswitch文で分岐して、画像のURLを返却
						return prefix + icon + ext;
					});
				// 追加による値増加処理
				} else {
					button.toggleClass("pushed-button");
					form.attr("action", form.attr("action").replace(/add/,'delete'));
					button.find("img").attr("src", function(i, val) {
						var contents = button.attr("class");
						var ext = ".png";
						var prefix = "/assets/img/icon/";
						var icon = "";
						switch (contents.match(/good|favorite|follow/).toString()) {
							case "good":
								icon = "pushed-good";
// favorite good follow のコンテンツ取得
								var myrecoUnit = button.parents("div[class $= 'Unit']");

// 親の要素からたどって、該当のlinkを取得
								var link = myrecoUnit.find(".good_num");

// linkの値を更新
								var link_num = link.text();
								link.text(++link_num);

								break;
							case "favorite":
								icon = "pushed-favorite";
// favorite good follow のコンテンツ取得
								var myrecoUnit = button.parents("div[class $= 'Unit']");
// 親の要素からたどって、該当のlinkを取得
								var link = myrecoUnit.find(".favorite_num");
// linkの値を更新
								var link_num = link.text();
								link.text(++link_num);
								break;
							case "follow":
								icon = "pushed-follow";

								break;
							default:
								alert("error");
								break;
						}
// ここにswitch文で分岐して、画像のURLを返却
						return prefix + icon + ext;
					});
					button.find(".button-string").text("取り消し");

				}
			}
		});
		return false;
	});

	// Amazon画像取得	
	$(".get-image").click(function(event) {
		var area = ".got_image_area";
		var query = $("#title").val();

		if (query == '') {
			alert("キーワードを入力してください");
			return false;
		}

		$(".loading").fadeIn();
		$.ajax({
			type: 'POST',
			url: '/myreco/get_item',
			dataType: 'html',
			data: {title: query},
			success: function(data)
			{
				$(".got_image_area").html(data);
				$(".loading").fadeOut();
				$(area).show();
			}
		});

		$(document).on("click", area + ' img', function() {
			var image_src = $(this).attr("src");
			var itemURL = $(this).attr("itemURL");

			if (confirm("この画像でよろしいですか？")) {
				$("#image_input").children().remove();
				/* Amazon仕様に倣ってURLを600×600で取得する。 */
				var str = image_src.replace(/_SL160_/, "_AA540_");
				$("form").append("<input type='hidden' class='validate[required]' id='image_input' name='image_input' value='" + str + "'>");
				$("form").append("<input type='hidden' class='validate[required]' id='itemURL' name='itemURL' value='" + itemURL + "'>");
				$(this).css({opacity: 1.0});
				$(area + " img").not(this).css({opacity: 0.1});
			}
		});

		return false;
	});

	$(document).on("submit", '.myreco_delete_form, .movie_delete_form', function(e) {
		// formのsubmitをキャンセル
		e.preventDefault();

		var form = $(this);
		var button = form.find("button");
		console.log();

		if (confirm("削除してよろしいですか？")) {
			$.ajax({
				url: form.attr("action"),
				type: form.attr("method"),
				data: form.serialize(),
				timeout: 10000,
				// 送信前
				beforeSend: function(xhr, settings) {
					button.attr("disabled", true);
				},
				// 応答後
				complete: function(xhr, textStatus) {
					button.attr("disabled", false);
				},
				// 通信成功時
				success: function(result, textStatus, xhr) {
					var unit = button.closest("div[class$='Unit']");
					// hide後にremoveさせるため。
					// ２行に分けるとremoveが早すぎて一瞬で消される。
					unit.hide("slow", function() {
						unit.remove();
					});
				}
			});
		}
	});
	
	$('.user-image').error(function(){
		$(this).attr('src', "/assets/img/common/load-fail.png");
	});

	/*
	 $("#title").autocomplete({
	 source: function(req, resp){
	 $.ajax({
	 url: "/autocomplete.php",
	 type: "POST",
	 cache: false,
	 dataType: "json",
	 data: {
	 param1: req.term
	 },
	 success: function(o){
	 resp(o);
	 },
	 error: function(xhr, ts, err){
	 resp(['']);
	 }
	 });
	 
	 }
	 });
	 */
	
	
	/**
	 * コミュニティページの回答ボタン
	 * クリックすると、like_numを増加
	 */
	$(".answer-like-button").click(function(e){
		$community_like_button = $(this).next();
		$community_id = $(this).attr('answer_id');

		$.post('/community/pageLikeAdd', {
			answer_id: $community_id
		});
		// クリックするごとに数を１つずつ増やす
		$community_like_button.text(parseInt($community_like_button.text()) + 1);
		
		// 画像の切り替え
		$(this).attr("src", "/assets/img/icon/answer_onclick.png");
		
	});

	/**
	 * コミュニティページの回答ボタン
	 * クリックすると、like_numを増加
	 */
	$(".community-like-button").click(function(e){
		$community_like_button = $(this).next();
		$community_id = $(this).attr('answer_id');

		$.post('/community/likeAdd', {
			community_id: $community_id
		});
		// クリックするごとに数を１つずつ増やす
		$community_like_button.text(parseInt($community_like_button.text()) + 1);
		
		// 画像の切り替え
		$(this).attr("src", "/assets/img/icon/answer_onclick.png");
		
	});

});


