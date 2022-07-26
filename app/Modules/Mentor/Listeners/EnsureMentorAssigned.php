<?php

namespace App\Modules\Mentor\Listeners;

use App\Modules\Mentor\Services\MentorService;
use Railroad\Ecommerce\Events\GiveContentAccess;

class EnsureMentorAssigned
{
    private MentorService $mentorService;

    public function __construct(MentorService $mentorService)
    {
        $this->mentorService = $mentorService;
    }

    public function handle(GiveContentAccess $event)
    {
        $userId = $event->order->getUser()->getId();
        $this->mentorService->ensureMentorAssigned($userId);
    }
}
