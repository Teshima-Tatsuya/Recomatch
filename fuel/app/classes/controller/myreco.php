<?php

class Controller_Myreco extends MyController {
	/**
	 * URLがmyreco_category_menuである場合
	 * １．PC：myreco/indexへリダイレクト
	 * ２．MOBILE：そのまま
	 */
	public function before() {
		if (Uri::string() === "myreco/category_menu") {
			if(!Agent::is_smartphone()) {
				Response::redirect("/myreco/index");
			}
		}
		parent::before();
	}

	public function action_index() {
		$count = Model_Myreco::count();
		$pagination = Util_Pagination::create_link($count);
		$this->template->myrecos = Model_Myreco::getAll($pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}
	
	public function action_edit() {
		// 未ログインならばログインページに遷移
		if(!Recomatch_Util::isLogin()) {
			Response::redirect("/login");
		}
	}

	public function action_category($category_name = null) {
		if(is_null($category_name)) {
			throw new HttpNotFoundException();
		}
		try {
			$category_id = Model_Category::getId($category_name);
		} catch(CategoryNotFoundException $e) {
			throw new HttpNotFoundException();
		}
		
		$myrecos = Model_Myreco::getByCategoryId($category_id);
		$count = count($myrecos);
			
		$pagination = Util_Pagination::create_link($count);
		$this->template->myrecos = Model_Myreco::getByCategoryId($category_id, null, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
	}

	/**
	 * タグ検索のページ
	 * @param type $tag 検索するタグ
	 * @return type
	 */
	public function action_tag($tag) {
		$myrecos = Model_Myreco::getByTag($tag);
		$count = count($myrecos);
			
		$pagination = Util_Pagination::create_link($count);
		$this->template->myrecos = Model_Myreco::getByTag($tag, $pagination->per_page, $pagination->offset);
		$this->template->content->set_safe('pagination', $pagination);
		$this->template->tag_name = $tag;
	}	
	
	/**
	 * モバイル専用ページ
	 */
	public function action_category_menu() {
	}

	public function action_matome() {
		throw new HttpNotFoundException();
		// layout/myreco_matome
	}

	public function action_add() {
		$val = Validation::forge();
		$val->add('title', "タイトル")
			->add_rule('required');
		
		$val->add('category', "カテゴリー")
			->add_rule('required_category');
		
		$val->add('movie_url', 'URL');

		// バリデーション失敗
		if(!$val->run()) {
			Session::set_flash('form_input', Input::post());
			Session::set_flash('errors', $val->error());
			
			Response::redirect("/myreco/edit");
		}
		
		$myrecoDTO = new DTO_Myreco();
		$myrecoDTO->setUserId($this->me->id);
		$myrecoDTO->setTitle(Input::post("title"));
		$myrecoDTO->setCategoryId(Input::post('category'));
		$myrecoDTO->setComment(Input::post('comment'));

		// 画像が存在したら
		if(!is_null(Input::post("image_input"))) {
			$itemDTO = new DTO_Item();
					
			// 画像が格納されているURLをセット
			$itemDTO->setDir(Input::post("image_input"));
			$itemDTO->setReproducedBy(Input::post("itemURL"));
			$itemDTO->setService("amazon");
			
			// 適当に設定
			// 後に変更予定
			$itemDTO->setPrice(0);
			
			$item = Model_Item::add($itemDTO);
			$myrecoDTO->setItemId($item->id);
		}
		
		$tags = Input::post('tag');
		
		if(!empty(Input::post('movie_url'))){
			$movie_url = Input::post('movie_url');
			$youtube_id = Model_Movie::parseMovieId($movie_url);
			
			if($youtube_id != -1 && preg_match("/[a-zA-Z0-9_-]{11}/", $youtube_id)) {
				$movieDTO = new DTO_Movie();
				$movieDTO->setMovieId($youtube_id);
				$movieDTO->setTitle(Input::post("title"));
				$movieDTO->setComment(Input::post('comment'));
				$movieDTO->setUserId($this->me->id);
				$movie = Model_Movie::add($movieDTO);
			
				$myrecoDTO->setMovieId($movie->id);
			}
		}
		
		$myreco = Model_Myreco::add($myrecoDTO, $tags);	
		
		Response::redirect("/myreco/");
	}
	
	/**
	 * マイレコの削除を行う
	 * Ajax通信限定
	 * @return type
	 */
	public function action_delete() {
		if(Input::is_ajax()) {
			$myreco_id = Input::post('myreco_id');
			$user_id = $this->me->id;
			
			$result = Model_Myreco::remove($myreco_id, $user_id);
			return $result;
		}
	}
	
	/**
	 * amazonから画像を取得して表示
	 */
	public function action_get_item() {
		require_once 'Services/Amazon.php';

		Config::load('amazon', true);
		$amazon_config = Config::get('amazon');
		$keyword = input::post('title');

		// 正規表現を使用しない場合はstrtrが高速
		// スペースをプラスに置換
		$replace_keyword = strtr($keyword, array(' ' => '+', '　' => '+'));

		$amazon = new Services_Amazon($amazon_config['access_key_id'], $amazon_config['secret_access_key'], $amazon_config['associate_tag']);
		$amazon->setLocale('JP');
		$amazon->setVersion('2011-08-02');

		$options = array();

//		$options['ResponseGroup'] = 'Small, Images'; //取得したい情報
		$options['ResponseGroup'] = 'Large'; //取得したい情報
		$options['Keywords'] = $replace_keyword;
		$result = $amazon->ItemSearch('All', $options);
		
		$ex_items = array();
		if(PEAR::isError($result)) {
			$items = array();
		} else {
			$items = $result['Item'];
			$ex_items = self::excludeAdultItem($items);
		}
		return View_Smarty::forge('parts/common/amazonItemList', array('items' => $ex_items), false);
	}
	
	// amazonから取得した情報からアダルト商品を削除
	private static function excludeAdultItem(array $items) {
		$exclude_word = array("アダルト", "AV");
		$items2 = array();
		
		foreach($items as $item) {
			// アダルトフラグオンでコンティニュー
			if(isset($item['ItemAttributes']['IsAdultProduct']) && $item['ItemAttributes']['IsAdultProduct'] == 1) {
				continue;
			}
			
			// 商品にアダルト情報があればコンティニュー
			if(isset($item['ItemAttributes']['Format'])) {
				if(is_array($item['ItemAttributes']['Format'])) {
					foreach ($item['ItemAttributes']['Format'] as $format) {
						foreach($exclude_word as $word){
							if(mb_strpos($format, $word) !== false) {
								continue 3; // 多重ループを抜ける
							}
						}
					}
				} else {
					foreach($exclude_word as $word){
						if(mb_strpos($item['ItemAttributes']['Format'], $word) !== false) {
							continue 2; // 多重ループを抜ける
						}
					}
				}
			}

			if(isset($item['ItemAttributes']['Title'])) {
				foreach($exclude_word as $word){
					if(mb_strpos($item['ItemAttributes']['Title'], $word) !== false) {
						continue 2;
					}
				}
			}

			if(!empty($item['MediumImage'])) {
				array_push($items2, $item);
			}
		}
		
		return $items2;
	}

}
