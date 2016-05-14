<?php

/**
 * commentのDTOクラス
 */
class DTO_Comment {

	private $user_id;
	private $myreco_id;
	private $comment;
	private $item_id;
	private $good_num;
	private $favorite_num;
	private $created_at;
	private $updated_at;
	private $id;
	
	public function getUserId() {
		return $this->user_id;
	}

	public function getMyrecoId() {
		return $this->myreco_id;
	}

	public function getComment() {
		return $this->comment;
	}

	public function getGoodNum() {
		return $this->good_num;
	}

	public function getFavoriteNum() {
		return $this->favorite_num;
	}

	public function getItemId() {
		return $this->item_id;
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

	public function setMyrecoId($myreco_id) {
		$this->myreco_id = $myreco_id;
	}
	
	public function setComment($comment) {
		$this->comment = $comment;
	}

	public function setGoodNum($good_num) {
		$this->good_num = $good_num;
	}

	public function setFavoriteNum($favorite_num) {
		$this->favorite_num = $favorite_num;
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
