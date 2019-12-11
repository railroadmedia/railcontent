<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class UserContentProgressStarted extends Event
{
    public $userId;
    public $contentId;
    public $progressPercent;

    /**
     * @param int $userId
     * @param int $contentId
     * @param $progressPercent
     */
    public function __construct($userId, $contentId, $progressPercent)
    {
        $this->userId = $userId;
        $this->contentId = $contentId;
        $this->progressPercent = $progressPercent;
    }
}