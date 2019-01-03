<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class UserContentProgressSaved extends Event
{
    public $userId;
    public $contentId;
    public $bubble = true;

    /**
     * @param int $userId
     * @param int $contentId
     */
    public function __construct($userId, $contentId, $bubble = true)
    {
        $this->userId = $userId;
        $this->contentId = $contentId;
        $this->bubble = $bubble;
    }
}