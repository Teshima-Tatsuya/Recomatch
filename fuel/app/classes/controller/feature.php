<?php

class Controller_Feature extends MyController {

	public function action_index() {
		$count = Model_Feature::count();
		$pagination = Util_Pagination::create_link($count);
		$this->template->features = Model_Feature::getAll(
			$pagination->per_page,
			$pagination->offset
		);
		$this->template->content->set_safe('pagination', $pagination);
	}

	public function action_page($page) {
		$now = time();
		$feature = Model_Feature::query()->where("id", $page)
			->where(DB::expr("unix_timestamp(publish_date)"), "<=", $now)
			->get_one();
		
		if(is_null($feature)) {
			Response::redirect("/feature");
		}
		$data['feature'] = $feature;

		$data['myrecos'] = Model_Myreco::find("all", array(
			"where" => array(
				"title" => $feature->inner_title,
			),
			"order_by" => array(DB::expr("RAND()")),
			"limit" => parent::getPerPage("feature.page"),
		));

		$data['myrecos'] += Model_Myreco::getByTag($feature->inner_title);
	
		$content = View_Smarty::forge('feature/page/'.$page, $data, false)->render();
		$title = $feature->title. " ".$feature->append_title;
		$this->template->title = parent::getTitle("feature.page", array('{title}' => trim($title)));
                $count = Model_Feature::count();
		$pagination = Util_Pagination::create_link($count);
		$this->template->features = Model_Feature::getAll(
			$pagination->per_page,
			$pagination->offset
		);
		$this->template->set_safe('content', $content);
		
		// contentsを上書きしているので、再度set
		View::set_global("features_right", Model_Feature::getAll(5));
		
		// contentsを上書きしているので、再度set
		View::set_global("matomes_right", Model_Matome::find("all", array(
			"order_by" => array('id' => "DESC"),
			"limit" => 5,
		)));
		View::set_global("ranking_list", Model_Myreco::getMyrecoRegistRanking());
	}
}
