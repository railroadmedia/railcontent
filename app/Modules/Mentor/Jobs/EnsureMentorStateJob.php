<?php

namespace App\Modules\Mentor\Jobs;

use App\Jobs\BaseJob;
use App\Modules\Mentor\Services\MentorService;
use App\Modules\UserManagementSystem\Services\UserService;
use Exception;

class EnsureMentorStateJob extends BaseJob
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function handle(UserService $userService, MentorService $mentorService)
    {
        $user = $userService->getByIdOrNull($this->userId);
        if (!$user) {
            throw new Exception("User $this->userId does not exist");
        }
        $mentorService->ensureMentorState($user);
        $mentor = $user->mentorStudent?->mentor;
        if ($mentor) {
            $mentorService->recalculateMentorTotals();
        }
    }
}
