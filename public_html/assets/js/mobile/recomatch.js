$(function() {
	// 質問お気に入りボタン
	$(document).on('click', '.favorite_question_button', function() {
		var id = $(this).attr('id');
		toggleButton(this, 'favorite', 'question', id, 'お気に入り', '解除');
		return false;
	});

	// 回答お気に入りボタン
	$(document).on('click', '.favorite_answer_button', function() {
		var id = $(this).attr('id');
		toggleButton(this, 'favorite', 'answer', id, 'お気に入り', '解除');
		return false;
	});

	// 質問スキボタン
	$(document).on('click', '.good_question_button', function() {
		var id = $(this).attr('id');
		toggleButton(this, 'good', 'question', id, 'スキ', '解除');
		return false;
	});

	// 回答スキボタン
	$(document).on('click', '.good_answer_button', function() {
		var id = $(this).attr('id');
		toggleButton(this, 'good', 'answer', id, 'スキ', '解除');
		return false;
	});

	// Amazon画像取得	
	$("#get_image").click(function(event) {
		var area = "#got_image_area";
		var query = $("#title").val();
		
		if(query == '') {
			alert("キーワードを入力してください");
			return false;
		}

		$.ajax({
			type: 'POST',
			url: '/myreco/get_item',
			dataType: 'html',
			data: {title: query},
			success: function(data)
			{
				$("#got_image_area").html(data);
				$("#loading").fadeOut();
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
				$("form").append("<input type='hidden' id='image_input' name='image_input' value='" + str + "'>");
				$("form").append("<input type='hidden' id='itemURL' name='itemURL' value='" + itemURL + "'>");
				$(this).css({opacity: 1.0});
				$(area + " img").not(this).css({opacity: 0.1});
			}
		});
	});

	$(document).on("click", '.delete_question', function() {
		if (confirm("選択された質問を削除しますか？")) {
			var question_id = $(this).attr('question_id');
			$.post(
					"/question/question_delete",
					{question_id: question_id}
			);
			$("#question_div_" + question_id).hide("slow");
		}

	});
	
	$(document).on("click", '.delete_answer', function() {
		if (confirm("選択された回答を削除しますか？")) {
			var answer_id = $(this).attr('answer_id');
			var answer_link = $('.answer_link:first span');
			var answer_num = answer_link.text();

			$.post(
					"/question/answer_delete",
					{answer_id: answer_id}
			);
			$("#answer_div_" + answer_id).hide("slow");
			answer_link.text(--answer_num);
		}

	});
        
        
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
	/*
	 * @brief 投稿form確認
	 * 
	 * 投稿時入力チェック、タイトル、タグ、コメントが無いものは投稿せず、
	 * 条件を満たした場合は確認メッセージをはさみ、サブミットする。
	 * 
	 * 
	 * @returns {Boolean}
	 * 
	 */
	$("#question_submit").submit(function() {

		if ($("input[name='title']").val() == "" || $("input[name='tag']").val() == "" || $("textarea[name='comment']").val() == "") {
			alert("タイトル、タグ、コメントは必ず入力してください");
			return false;
		}
		$("input[name='question_form_button']").attr('disabled', 'disabled').val('送信中...');
		return true;

	});

	$("#answer_submit").submit(function() {
		if ($("textarea[name='answer']").val() == "") {
			alert("コメントは必ず入力してください");
			return false;
		}
		$("#answer_form_button").attr('disabled', 'disabled').val('送信中...');
		return true;
	});


});


