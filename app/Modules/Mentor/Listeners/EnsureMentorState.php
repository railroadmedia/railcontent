<?php

namespace Modules\Mentor\Listeners;

use App\Modules\Mentor\Services\MentorService;
use Railroad\Ecommerce\Events\GiveContentAccess;

class EnsureMentorState
{
    private MentorService $mentorService;

    public function __construct(MentorService $mentorService)
    {
        $this->mentorService = $mentorService;
    }

    public function handle(GiveContentAccess $event): void
    {
        $userId = $event->order->getUser()->getId();
        $this->mentorService->ensureMentorState($userId);
    }
}
