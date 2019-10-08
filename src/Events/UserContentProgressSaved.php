<?php

namespace Railroad\Railcontent\Events;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\User;

class UserContentProgressSaved extends Event
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Content
     */
    public $content;

    public $userId;
    public $contentId;
    public $progressPercent;
    public $progressStatus;
    public $bubble = true;

    /**
     * UserContentProgressSaved constructor.
     *
     * @param User $user
     * @param Content $content
     */
    public function __construct(User $user, Content $content, $progressPercent, $progressStatus, $bubble = true)
    {
        $this->user = $user;
        $this->content = $content;

        $this->userId = $user->getId();
        $this->contentId = $content->getId();
        $this->progressPercent = $progressPercent;
        $this->progressStatus = $progressStatus;
        $this->bubble = $bubble;
    }
}