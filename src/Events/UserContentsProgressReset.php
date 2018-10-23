<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class UserContentsProgressReset extends Event
{
    public $userId;
    public $contentIds;

    /**
     * @param int $userId
     * @param array $contentIds
     */
    public function __construct($userId, array $contentIds)
    {
        $this->userId = $userId;
        $this->contentIds = $contentIds;
    }
}