<?php

/**
 * The ClassName Conommunity
 *
 *
 *
 * @package
 * @extends  MyController
 */
class Controller_Community extends MyController
{

	public function action_index()
	{
		// 特定のAssetの設定
		Asset::js("common/form.js", array(), 'add_js');

		$count = Model_Community::count();
		$pagination = Util_Pagination::create_link($count);

		// pagerを実装しなければ…
		// paginationを追加する。
		$this->template->communities = Model_Community::find('all', [
				'order_by' => array('created_at' => 'DESC'),
		]);
	}

	public function action_page($id)
	{
		if(!is_numeric($id)) {
			throw new HttpNotFoundException();
		}
		
		// 特定のAssetの設定
		Asset::js("common/form.js", array(), 'add_js');

		$this->template->community = Model_Community::find($id);
		$this->template->answers = Model_Community_Page::find("all" , [
			'where' => array(
				array('community_id', $id),
			),
			'order_by' => array('created_at' => 'DESC')
		]);
	}

	public function action_likeAdd() {
		$community_id = Input::post("community_id");
		
		if (!is_numeric($community_id)) {
			return false;
		}
		
		$result = Model_Community::incrementLikeNum($community_id);
		
		if(is_null($result)) {
			return false;
		} else {
			return true;
		}
	}	
	
	public function action_pageLikeAdd() {
		$answer_id = Input::post("answer_id");
		
		if (!is_numeric($answer_id)) {
			return false;
		}
		
		$result = Model_Community_Page::incrementLikeNum($answer_id);
		
		if(is_null($result)) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * モバイル専用のフォーム
	 */
	public function action_form()
	{
		
	}

	public function action_add()
	{
		$val = Model_Community::validate("add");

		// 画像については追加でヴァリデーション
		$val->add('image_input', "画像")
			->add_rule('required')
			->add_rule('valid_url');
		$val->add('itemURL', '商品URL')
			->add_rule('valid_url');

		// バリデーション失敗
		if (!$val->run()) {
			Session::set_flash('form_input', Input::post());
			Session::set_flash('errors', $val->error());

			Response::redirect("/community");
		}

		$input = $val->validated();

		$dto = new Dto\Community();
		$dto->title($input['title']);
		$dto->comment($input['comment']);

		// 画像の設定
		$itemDTO = new DTO_Item();

		// 画像が格納されているURLをセット
		$itemDTO->setDir($input["image_input"]);
		$itemDTO->setReproducedBy($input["itemURL"]);
		$itemDTO->setService("amazon");

		// 適当に設定
		$itemDTO->setPrice(0);

		$item = Model_Item::add($itemDTO);
		$dto->itemId($item->id);

		Model_Community::insert($dto);
		Session::set_flash("result", true);

		Response::redirect("/community");
	}

	public function action_addAnswer()
	{
		// リファラの取得
		$referrer = Input::referrer("/"); 
		
		$val = Model_Community_Page::validate(__FUNCTION__);

		// 画像については追加でヴァリデーション
		$val->add('image_input', "画像")
			->add_rule('required')
			->add_rule('valid_url');
		$val->add('itemURL', '商品URL')
			->add_rule('valid_url');
		$val->add('movie_url', "YoutubeのURL")
			->add_rule('valid_url');

		// バリデーション失敗
		if (!$val->run()) {
			Session::set_flash('form_input', Input::post());
			Session::set_flash('errors', $errors);

			Response::redirect($referrer);
		}

		$input = $val->validated();
		
		// 投稿したユーザIDの設定
		if (Recomatch_Util::isLogin()) {
			$user_id  = $this->me->id;
		} else {
			$user_id = Model_User::USER_GUEST;
		}

		$dto = new Dto\Community\Page();		
		$dto->userId($user_id);
		$dto->communityId($input['community_id']);
		$dto->title($input['title']);
		$dto->comment($input['comment']);

		// 画像の設定
		$itemDTO = new DTO_Item();

		// 画像が格納されているURLをセット
		$itemDTO->setDir($input["image_input"]);
		$itemDTO->setReproducedBy($input["itemURL"]);
		$itemDTO->setService("amazon");

		// 適当に設定
		$itemDTO->setPrice(0);

		$item = Model_Item::add($itemDTO);
		$dto->itemId($item->id);
		
		// 動画が投稿された場合
		if (!empty($input['movie_url'])) {
			$youtube_id = Model_Movie::parseMovieId($input['movie_url']);
			
			if($youtube_id != -1 && preg_match("/[a-zA-Z0-9_-]{11}/", $youtube_id)) {
				$movieDTO = new DTO_Movie();
				$movieDTO->setMovieId($youtube_id);
				$movieDTO->setTitle($input['title']);
				$movieDTO->setComment($input['comment']);
				$movieDTO->setUserId($user_id);
				$movie = Model_Movie::add($movieDTO);
			
				$dto->movieId($movie->id);
			}
		}

		$result = Model_Community_Page::insert($dto);
		
		// 回答数の更新
		$find = Model_Community::find($input['community_id']);
		$find->comment_num += 1;
		$find->save();
		
		Session::set_flash("result", true);
		
		Response::redirect($referrer);
	}
}
