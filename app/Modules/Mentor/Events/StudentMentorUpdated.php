<?php

namespace App\Modules\Mentor\Events;

class StudentMentorUpdated
{
    private int $userId;
    private int $mentorUserId;

    public function __construct(int $userId, int $mentorUserId)
    {
        $this->userId = $userId;
        $this->mentorUserId = $mentorUserId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getMentorUserId(): int
    {
        return $this->mentorUserId;
    }

}
