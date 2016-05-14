<?php

class DTO_Matome_Contents {

	private $user_id;
	private $matome_id;
	private $title;
	private $title_ngram;
	private $item_id = -1;
	private $movie_id = -1;
	private $comment = "";
	private $created_at;
	private $updated_at;
	private $id;
                
	public function getUserId() {
		return $this->user_id;
	}

	public function getMatomeId() {
		return $this->matome_id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getTitleNgram() {
		return $this->title_ngram;
	}

	public function getItemId() {
		return $this->item_id;
	}

	public function getMovieId() {
		return $this->movie_id;
	}

	public function getComment() {
		return $this->comment;
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

	public function setMatomeId($matome_id) {
		$this->matome_id = $matome_id;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setTitleNgram($title_ngram) {
		$this->title_ngram = $title_ngram;
	}

	public function setItemId($item_id) {
		$this->item_id = $item_id;
	}

	public function setMovieId($movie_id) {
		$this->movie_id = $movie_id;
	}

	public function setComment($comment) {
		$this->comment = $comment;
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
