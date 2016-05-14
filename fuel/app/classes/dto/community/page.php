<?php
namespace Dto\Community;

use Model_User;

class Page
{

	/**
	 * 登録ユーザID
	 * default : Model_User::USER_GUEST
	 * @var int
	 */
	private $user_id = Model_User::USER_GUEST;

	/**
	 * コミュニティID
	 * @var int
	 */
	private $community_id;

	/**
	 * タイトル
	 * @var String
	 */
	private $title;

	/**
	 * コメント
	 * @var string
	 */
	private $comment;

	/**
	 * 共感の数
	 * 初期値は0
	 * @var int
	 */
	private $like_num = 0;

	/**
	 * 画像URL
	 * 初期値は-1
	 * @var int
	 */
	private $item_id = -1;

	/**
	 * ムービーID
	 * 初期値は-1
	 * @var int
	 */
	private $movie_id = -1;
	private $created_at;
	private $updated_at;
	private $id;

	public function userId($value = null)
	{
		if (is_null($value)) {
			return $this->user_id;
		}
		$this->user_id = $value;
	}

	public function communityId($value = null)
	{
		if (is_null($value)) {
			return $this->community_id;
		}
		$this->community_id = $value;
	}

	public function title($value = null)
	{
		if (is_null($value)) {
			return $this->title;
		}
		$this->title = $value;
	}

	public function comment($value = null)
	{
		if (is_null($value)) {
			return $this->comment;
		}
		$this->comment = $value;
	}

	public function likeNum($value = null)
	{
		if (is_null($value)) {
			return $this->like_num;
		}
		$this->like_num = $value;
	}

	public function itemId($value = null)
	{
		if (is_null($value)) {
			return $this->item_id;
		}
		$this->item_id = $value;
	}

	public function movieId($value = null)
	{
		if (is_null($value)) {
			return $this->movie_id;
		}
		$this->movie_id = $value;
	}

	public function createdAt($value = null)
	{
		if (is_null($value)) {
			return $this->created_at;
		}
		$this->created_at = $value;
	}

	public function updatedAt($value = null)
	{
		if (is_null($value)) {
			return $this->updated_at;
		}
		$this->updated_at = $value;
	}

	public function id($value = null)
	{
		if (is_null($value)) {
			return $this->id;
		}
		$this->id = $value;
	}

}
