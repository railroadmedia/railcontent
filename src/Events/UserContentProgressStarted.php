<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;

class UserContentProgressStarted extends Event
{
    public $userId;
    public $contentId;
    public $progressPercent;

    /**
     * UserContentProgressStarted constructor.
     *
     * @param User $user
     * @param Content $content
     * @param $progressPercent
     */
    public function __construct(User $user, Content $content, $progressPercent)
    {
        $this->userId = $user->getId();
        $this->contentId = $content->getId();
        $this->progressPercent = $progressPercent;
    }
}