<?php

namespace Modules\Mentor\Listeners;

use App\Modules\EventDataSynchronizer\Events\UserMembershipDateUpdated;
use App\Modules\Mentor\Services\MentorService;

class EnsureMentorState
{
    private MentorService $mentorService;

    public function __construct(MentorService $mentorService)
    {
        $this->mentorService = $mentorService;
    }

    public function handle(UserMembershipDateUpdated $event): void
    {
        $this->mentorService->ensureMentorState($event->getUser());
    }
}
