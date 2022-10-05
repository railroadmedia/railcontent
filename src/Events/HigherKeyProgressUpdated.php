<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class HigherKeyProgressUpdated extends Event
{
    public $userId;
    public $contentId;
    public $higherKeyProgress;

    /**
     * @param $userId
     * @param $contentId
     * @param $higherKeyProgress
     */
    public function __construct($userId, $contentId, $higherKeyProgress)
    {
        $this->userId = $userId;
        $this->contentId = $contentId;
        $this->higherKeyProgress = $higherKeyProgress;
    }
}