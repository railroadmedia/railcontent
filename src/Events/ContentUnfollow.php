<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class ContentUnfollow extends Event
{
    /**
     * @var integer
     */
    public $contentId;

    /**
     * @var integer
     */
    public $userId;

    /**
     * @param $contentId
     * @param $userId
     */
    public function __construct($contentId, $userId)
    {
        $this->contentId = $contentId;
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getContentId()
    {
        return $this->contentId;
    }
}