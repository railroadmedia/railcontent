<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class UserContentProgressSaved extends Event
{
    public $userId;
    public $contentId;

    /**
     * @param int $userId
     * @param int $contentId
     */
    public function __construct($userId, $contentId)
    {
        $this->userId = $userId;
        $this->contentId = $contentId;
    }
}