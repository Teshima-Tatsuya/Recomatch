$ ->
	$(document).on "submit", ".good_add_form, .good_delete_form, .favorite_add_form, .favorite_delete_form, .follow_add_form, .follow_delete_form", (e) ->

# formのsubmitをキャンセル
e.preventDefault()
form = $(this)
button = form.find("button")
$.ajax
url: form.attr("action")
type: form.attr("method")
data: form.serialize()
timeout: 10000

# 送信前
beforeSend: (xhr, settings) ->
button.attr "disabled", true
return


# 応答後
complete: (xhr, textStatus) ->
button.attr "disabled", false
return


# 通信成功時
success: (result, textStatus, xhr) ->

# 削除による数値減少処理
#if(button.find(".button-string").text() === "取り消し"){
if button.hasClass("pushed-button")
button.toggleClass "pushed-button"
form.attr "action", form.attr("action").replace(/delete/, "add")
button.find("img").attr "src", (i, val) ->
contents = button.attr("class")
ext = ".png"
prefix = "/assets/img/icon/"
icon = ""
switch contents.match(/good|favorite|follow/).toString()
when "good"
icon = "good"

# favorite good follow のコンテンツ取得
myrecoUnit = button.parents("div[class $= 'Unit']")

# 親の要素からたどって、該当のlinkを取得
link = myrecoUnit.find(".good_num")

# linkの値を更新
link_num = link.text()
link.text --link_num
button.find(".button-string").text "好き"
when "favorite"
icon = "favorite"

# favorite good follow のコンテンツ取得
myrecoUnit = button.parents("div[class $= 'Unit']")

# 親の要素からたどって、該当のlinkを取得
link = myrecoUnit.find(".favorite_num")

# linkの値を更新
link_num = link.text()
link.text --link_num
button.find(".button-string").text "お気に入り"
when "follow"
icon = "user"
button.find(".button-string").text "フォロー"
else
alert "error"

# ここにswitch文で分岐して、画像のURLを返却
prefix + icon + ext


# 追加による値増加処理
else
button.toggleClass "pushed-button"
form.attr "action", form.attr("action").replace(/add/, "delete")
button.find("img").attr "src", (i, val) ->
contents = button.attr("class")
ext = ".png"
prefix = "/assets/img/icon/"
icon = ""
switch contents.match(/good|favorite|follow/).toString()
when "good"
icon = "pushed-good"

# favorite good follow のコンテンツ取得
myrecoUnit = button.parents("div[class $= 'Unit']")

# 親の要素からたどって、該当のlinkを取得
link = myrecoUnit.find(".good_num")

# linkの値を更新
link_num = link.text()
link.text ++link_num
when "favorite"
icon = "pushed-favorite"

# favorite good follow のコンテンツ取得
myrecoUnit = button.parents("div[class $= 'Unit']")

# 親の要素からたどって、該当のlinkを取得
link = myrecoUnit.find(".favorite_num")

# linkの値を更新
link_num = link.text()
link.text ++link_num
when "follow"
icon = "pushed-follow"
else
alert "error"

# ここにswitch文で分岐して、画像のURLを返却
prefix + icon + ext

button.find(".button-string").text "取り消し"
return

false


# Amazon画像取得	
$(".get-image").click (event) ->
area = ".got_image_area"
query = $("#title").val()
if query is ""
alert "キーワードを入力してください"
return false
$(".loading").fadeIn()
$.ajax
type: "POST"
url: "/myreco/get_item"
dataType: "html"
data:
title: query

success: (data) ->
$(".got_image_area").html data
$(".loading").fadeOut()
$(area).show()
return

$(document).on "click", area + " img", ->
image_src = $(this).attr("src")
itemURL = $(this).attr("itemURL")
if confirm("この画像でよろしいですか？")
$("#image_input").children().remove()

# Amazon仕様に倣ってURLを600×600で取得する。 
str = image_src.replace(/_SL160_/, "_AA540_")
$("form").append "<input type='hidden' id='image_input' name='image_input' value='" + str + "'>"
$("form").append "<input type='hidden' id='itemURL' name='itemURL' value='" + itemURL + "'>"
$(this).css opacity: 1.0
$(area + " img").not(this).css opacity: 0.1
return

false

$(document).on "submit", ".myreco_delete_form, .movie_delete_form", (e) ->

# formのsubmitをキャンセル
e.preventDefault()
form = $(this)
button = form.find("button")
console.log()
if confirm("削除してよろしいですか？")
$.ajax
url: form.attr("action")
type: form.attr("method")
data: form.serialize()
timeout: 10000

# 送信前
beforeSend: (xhr, settings) ->
button.attr "disabled", true
return


# 応答後
complete: (xhr, textStatus) ->
button.attr "disabled", false
return


# 通信成功時
success: (result, textStatus, xhr) ->
unit = button.closest("div[class$='Unit']")

# hide後にremoveさせるため。
# ２行に分けるとremoveが早すぎて一瞬で消される。
unit.hide "slow", ->
unit.remove()
return
return
return
return