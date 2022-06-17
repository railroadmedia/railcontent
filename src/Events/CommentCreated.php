<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class CommentCreated extends Event
{
    /**
     * @var integer
     */
    public $commentId;
    /**
     * @var
     */
    public $userId;
    /**
     * @var integer
     */
    public $parentId;
    /**
     * @var string
     */
    public $commentText;
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed|string
     */
    private $brand;

    /**
     * @param $commentId
     * @param $userId
     * @param $parentId
     * @param $commentText
     * @param string|null $brand
     */
    public function __construct($commentId, $userId, $parentId, $commentText, ?string $brand = null)
    {
        $this->commentId = $commentId;
        $this->userId = $userId;
        $this->parentId = $parentId;
        $this->commentText = $commentText;
        $this->brand = $brand ?? config('railcontent.brand');
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getCommentText()
    {
        return $this->commentText;
    }

    /**
     * @param string $commentText
     */
    public function setCommentText(string $commentText)
    {
        $this->commentText = $commentText;
    }

    /**
     * @return int
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @param int $commentId
     */
    public function setCommentId(int $commentId)
    {
        $this->commentId = $commentId;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }
}