<?php

namespace Railroad\Railcontent\Listeners;

use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Services\UserContentProgressService;

class UserContentProgressEventListener extends Event
{
    private $userContentProgressService;

    public function __construct(UserContentProgressService $userContentProgressService)
    {
        $this->userContentProgressService = $userContentProgressService;
    }

    public function handle(UserContentProgressSaved $event)
    {
        $this->userContentProgressService->bubbleProgress($event->userId, $event->contentId);
    }
}