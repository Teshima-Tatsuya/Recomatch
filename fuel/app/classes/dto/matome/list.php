<?php

/**
 * myrecoのDTOクラス
 */
class DTO_Matome_List {

	private $user_id;
	private $title;
	private $title_ngram;
	private $bookmark_num;
	private $good_num;
	private $created_at;
	private $updated_at;
	private $id;
                
	public function getUserId() {
		return $this->user_id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getTitleNgram() {
		return $this->title_ngram;
	}

	public function getBookmarkNum() {
		return $this->bookmark_num;
	}

	public function getGoodNum() {
		return $this->good_num;
	}

	public function getItemId() {
		return $this->item_id;
	}

	public function getMovieId() {
		return $this->movie_id;
	}

	public function getCreatedAt() {
		return $this->created_at;
	}

	public function getUpdatedAt() {
		return $this->updated_at;
	}

	public function getId() {
		return $this->id;
	}

	public function setUserId($user_id) {
		$this->user_id = $user_id;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setTitleNgram($title_ngram) {
		$this->title_ngram = $title_ngram;
	}

	public function setBookmarkNum($bookmark_num) {
		$this->bookmark_num = $bookmark_num;
	}

	public function setGoodNum($good_num) {
		$this->good_num = $good_num;
	}

	public function setItemId($item_id) {
		$this->item_id = $item_id;
	}

	public function setCreatedAt($created_at) {
		$this->created_at = $created_at;
	}

	public function setUpdatedAt($updated_at) {
		$this->updated_at = $updated_at;
	}

	public function setId($id) {
		$this->id = $id;
	}

}
