<?php

class Controller_Movie extends MyController {

	public function action_index() {
		$query = Model_Movie::query()
			->where('contents_type', Recomatch_Constants::CONTENTS_MOVIE);
		$count = $query->count();
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->movies = $query->order_by('created_at', 'DESC')
									->limit($pagination->per_page)
									->offset($pagination->offset)
									->get();
		$this->template->content->set_safe('pagination', $pagination);
	}
	
	public function action_edit() {
		// 未ログインならばログインページに遷移
		if(!Recomatch_Util::isLogin()) {
			Response::redirect("/login");
		}
	}

	public function action_add() {
		$val = Validation::forge();
		
		$val->add("title", "タイトル")
			->add_rule("required");
		$val->add("movie_url", "ムービー")
			->add_rule("required")
			->add_rule("valid_youtube_url");
		
		// バリデーション失敗
		if(!$val->run()) {
			Session::set_flash('form_input', Input::post());
			Session::set_flash('errors', $val->error());
			
			Response::redirect("/movie/edit");
		}
		
		$title = Input::post("title");
		$comment = Input::post("comment");
		$movie_url = Input::post("movie_url");
		
		$movie_id = Model_Movie::parseMovieId($movie_url);
		
		// 動画IDが取得出来ない場合
		// バリデーションが必要
		if($movie_id == -1) {
			Response::redirect("/movie");
		}
			
		$movieDTO = new DTO_Movie();
		$movieDTO->setTitle($title);
		$movieDTO->setContentsType(Recomatch_Constants::CONTENTS_MOVIE);
		$movieDTO->setComment($comment);
		$movieDTO->setMovieId($movie_id);
		$movieDTO->setUserId($this->me->id);

		Model_Movie::add($movieDTO);
		
		Response::redirect("/movie");
	}

	/**
	 * ムービーの削除を行う
	 * Ajax通信限定
	 * @return type
	 */
	public function action_delete() {
		if(Input::is_ajax()) {
			$movie_id = Input::post('movie_id');
			$user_id = $this->me->id;
			
			$result = Model_Movie::remove($movie_id, $user_id);
			return $result;
		}
	}
}
