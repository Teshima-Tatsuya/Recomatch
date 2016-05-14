<?php

class DTO_News {
	private $url;
	private $comment;
	private $user_id;
	private $myreco_id = -1;
	private $created_at;
	private $updated_at;
	private $id;
	
	public function getUrl() {
		return $this->url;
	}

	public function getComment() {
		return $this->comment;
	}

	public function getUserId() {
		return $this->user_id;
	}

	public function getMyrecoId() {
		return $this->myreco_id;
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

	public function setUrl($url) {
		$this->url = $url;
	}

	public function setComment($comment) {
		$this->comment = $comment;
	}

	public function setUserId($user_id) {
		$this->user_id = $user_id;
	}

	public function setMyrecoId($myreco_id) {
		$this->myreco_id = $myreco_id;
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
