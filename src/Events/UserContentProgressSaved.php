<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class UserContentProgressSaved extends Event
{
    public $userId;
    public $contentId;
    public $progressPercent;
    public $progressStatus;
    public $bubble = true;

    /**
     * @param int $userId
     * @param int $contentId
     * @param $progressPercent
     * @param $progressStatus
     */
    public function __construct($userId, $contentId, $progressPercent, $progressStatus, $bubble = true)
    {
        $this->userId = $userId;
        $this->contentId = $contentId;
        $this->progressPercent = $progressPercent;
        $this->progressStatus = $progressStatus;
        $this->bubble = $bubble;
    }
}