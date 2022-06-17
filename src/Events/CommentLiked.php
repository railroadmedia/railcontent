<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class CommentLiked extends Event
{
    /**
     * @var integer
     */
    public $commentId;
    /**
     * @var integer
     */
    public $userId;
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed|string
     */
    private $brand;

    /**
     * @param $commentId
     * @param $userId
     * @param string|null $brand
     */
    public function __construct($commentId, $userId, ?string $brand = null)
    {
        $this->commentId = $commentId;
        $this->userId = $userId;
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
}