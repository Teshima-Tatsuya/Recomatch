<?php

/**
 * movieのDTOクラス
 */
class DTO_Movie {

	private $title = "";
	private $comment = "";
	private $contents_type = Recomatch_Constants::CONTENTS_MYRECO;
	private $movie_id = -1;
	private $user_id = -1;
	private $created_at;
	private $updated_at;
	private $id;
                
	public function getUserId() {
		return $this->user_id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getContentsType() {
		return $this->contents_type;
	}

	public function getComment() {
		return $this->comment;
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

	public function setComment($comment) {
		$this->comment = $comment;
	}

	public function setContentsType($contents_type) {
		$this->contents_type = $contents_type;
	}

	public function setMovieId($movie_id) {
		$this->movie_id = $movie_id;
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
