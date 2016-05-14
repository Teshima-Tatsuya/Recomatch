<?php

class Controller_Search extends MyController {

	public function before() {
		parent::before();
	}

	public function action_index() {
		throw new HttpNotFoundException();
	}
	
	public function action_myreco() {
		$val = Validation::forge();
		
		$key = Input::get('key');

		// 検索ワードが空白ならば、リファラに飛ばす
		// リファラがなければ、/myreco/indexに飛ばす
		if(empty($key)) {
			Response::redirect(Input::referrer("/myreco/index"));
		}
		
		// とりあえずタイトルだけで検索しています。
		$query = Model_Myreco::query()->where(DB::expr('MATCH(title_ngram)'), ' ', DB::expr('AGAINST(\''.Util_Ngram::to_query($key).'\' IN BOOLEAN MODE)'));
		$count = $query->count();
		
		$pagination = Util_Pagination::create_link($count);
		$this->template->myrecos = $query->order_by('created_at', 'DESC')
									->limit($pagination->per_page)
									->offset($pagination->offset)
									->get();
		$this->template->content->set_safe('pagination', $pagination);
			
		$this->template->key = $key;
	}
}
