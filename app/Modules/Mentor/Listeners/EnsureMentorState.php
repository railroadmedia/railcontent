<?php

namespace Modules\Mentor\Listeners;

use App\Modules\EventDataSynchronizer\Events\UserMembershipDateUpdated;
use App\Modules\Mentor\Jobs\EnsureMentorStateJob;
use App\Modules\Mentor\Services\MentorService;
use Modules\UserManagementSystem\Events\OnboardingInstrumentUpdated;

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
        $mentor = $event->getUser()->mentorStudent?->mentor;
        if ($mentor) {
            $this->mentorService->recalculateMentorTotals();
        }
    }

    public function handleOnboardingInstrumentUpdated(OnboardingInstrumentUpdated $event): void
    {
        dispatch(new EnsureMentorStateJob($event->getUserId()));
    }
}
