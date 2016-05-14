<?php

class Controller_Matome extends MyController {
	public function before() {
		parent::before();
	}

	public function action_index() {
		$count = Model_Feature::count();
		$pagination = Util_Pagination::create_link($count);
		$this->template->matomes = Model_Matome::find("all", array(
			"order_by" => array('id' => "DESC"),
			"limit" => $pagination->per_page,
			"offset" => $pagination->offset,
		));
		
		if(count($this->template->matomes) <= 0) {
			$this->template->matomes = array();
		}
		
		$this->template->content->set_safe('pagination', $pagination);
	}

	public function action_page($page) {
		$feature = Model_Matome::find($page);
		
		if(is_null($feature)) {
			Response::redirect("/feature");
		}

		$content = View_Smarty::forge('matome/page/'.$page, false)->render();
		$this->template->title = parent::getTitle("matome.page", array('{title}' => $feature->title));
		$this->template->set_safe('content', $content);
		
		// contentsを上書きしているので、再度set
		View::set_global("features_right", Model_Feature::find("all", array(
			"order_by" => array('id' => "DESC"),
			"limit" => 5,
		)));
		// contentsを上書きしているので、再度set
		View::set_global("matomes_right", Model_Matome::find("all", array(
			"order_by" => array('id' => "DESC"),
			"limit" => 5,
		)));
		View::set_global("ranking_list", Model_Myreco::getMyrecoRegistRanking());
	}
	
	public function action_edit() {
		// smartphone layout/matome_edit
		// pc layout/matome
	}

	public function action_reedit() {
		// smartphone layout/matome_edit
		// pc layout/matome
	}
	
	public function action_matome() {
	}
	
	public function action_good() {
		// layout/matome_contents
	}
	
	public function action_favorite() {
		// layout/matome_contents
	}

	public function action_contents($matome_id) {
		if(is_null($matome_id)) {
			throw new HttpNotFoundException();
		}
		
		$this->template->contents = Model_Matome_Contents::find('all', array(
			'where' => array(
				array('matome_id', $matome_id),
			),
			'order_by' => array('created_at' => 'DESC'),
		));
		
		// layout/matome_contents
	}

	public function action_add() {
		$matome_title = Input::post("matome_title");
		$contents = Input::post("contents");
		
		
		//TODO 配列で投稿する数の分だけループを回す
		$listDTO = new DTO_Matome_List();
		$listDTO->setUserId($this->me->id);
		$listDTO->setTitle($matome_title);

		$matome_list = Model_Matome_List::add($listDTO);

		// titleは必須項目なので、タイトルの入力数だけ回す
		for($i = 0; $i < count($contents['title']); $i++) {
			$title = $contents['title'][$i];
			$image_input = $contents["image_input"][$i];
			$item_url = $contents["item_url"][$i];
			$movie_url = $contents["movie_url"][$i];
			$comment = $contents["comment"][$i];
			
			
			$contentsDTO = new DTO_Matome_Contents();
			$contentsDTO->setMatomeId($matome_list->id);
			$contentsDTO->setUserId($this->me->id);
			$contentsDTO->setTitle($title);
			$contentsDTO->setComment($comment);

			// 画像が存在したら
			if(!empty($image_input)) {
				$itemDTO = new DTO_Item();

				// 画像が格納されているURLをセット
				$itemDTO->setDir($image_input);
				$itemDTO->setReproducedBy($item_url);
				$itemDTO->setService("amazon");

				// 適当に設定
				// 後に変更予定
				$itemDTO->setPrice(0);

				$item = Model_Item::add($itemDTO);
				$contentsDTO->setItemId($item->id);
			}

			if(!empty($movie_url)) {

				$movie_id = Model_Movie::parseMovieId($movie_url);

				// 動画IDが取得出来ない場合
				// バリデーションが必要
				if($movie_id != -1) {
					$movieDTO = new DTO_Movie();
					$movieDTO->setTitle($title);
					$movieDTO->setComment($comment);
					$movieDTO->setMovieId($movie_id);
					$movieDTO->setUserId($this->me->id);

					$movie = Model_Movie::add($movieDTO);

					$contentsDTO->setMovieId($movie->id);
				}
			}
			
			Model_Matome_Contents::add($contentsDTO);
		}
		
		Response::redirect("matome/index");
	}

}
