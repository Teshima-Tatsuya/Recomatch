<?php

namespace Dto;

class Community
{

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
     * コメント数
     * 初期値は0
     * @var int 
     */
    private $comment_num = 0;

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
    private $created_at;
    private $updated_at;
    private $id;

    public function title($value = null)
    {
        if (is_null($value)) {
            return $this->title;
        } else {
            $this->title = $value;
        }
    }

    public function comment($value = null)
    {
        if (is_null($value)) {
            return $this->comment;
        } else {
            $this->comment = $value;
        }
    }

    public function commentNum($value = null)
    {
        if (is_null($value)) {
            return $this->comment_num;
        } else {
            $this->comment_num = $value;
        }
    }

    public function likeNum($value = null)
    {
        if (is_null($value)) {
            return $this->like_num;
        } else {
            $this->like_num = $value;
        }
    }

    public function itemId($value = null)
    {
        if (is_null($value)) {
            return $this->item_id;
        } else {
            $this->item_id = $value;
        }
    }

    public function createdAt($value = null)
    {
        if (is_null($value)) {
            return $this->created_at;
        } else {
            $this->created_at = $value;
        }
    }

    public function updatedAt($value = null)
    {
        if (is_null($value)) {
            return $this->updated_at;
        } else {
            $this->updated_at = $value;
        }
    }

    public function id($value = null)
    {
        if (is_null($value)) {
            return $this->id;
        } else {
            $this->id = $value;
        }
    }
}
