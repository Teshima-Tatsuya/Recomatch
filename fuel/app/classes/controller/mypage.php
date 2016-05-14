<?php

class Controller_Mypage extends MyController {
	public function before() {
		// 未ログインならばログインページヘリダイレクト
		if(!Recomatch_Util::isLogin()) {
			Response::redirect("/login");
		}
		parent::before();
	}
	
	/**
	 * mypage/myrecoにリダイレクト
	 */
	public function action_index() {
		Response::redirect("/mypage/myreco");
	}
	
	public function action_myreco() {
		$query = Model_Myreco::query()->where('user_id', $this->me->id);
		$count = $query->count();
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->myrecos = $query->order_by('created_at', 'DESC')
									->limit($pagination->per_page)
									->offset($pagination->offset)
									->get();
		$this->template->content->set_safe('pagination', $pagination);
	}

	public function action_movie() {
		$query = Model_Movie::query()
			->where('user_id', $this->me->id)
			->where('contents_type', Recomatch_Constants::CONTENTS_MOVIE);
		$count = $query->count();
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->movies = $query->order_by('created_at', 'DESC')
									->limit($pagination->per_page)
									->offset($pagination->offset)
									->get();
		$this->template->content->set_safe('pagination', $pagination);
	}	

	/**
	 * 今は不要なので４０４
	 * @return type
	 */
	public function action_matome() {
		throw new HttpNotFoundException();
		// layout/mypage_matome
	}

}
