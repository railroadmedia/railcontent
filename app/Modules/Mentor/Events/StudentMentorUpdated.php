<?php

namespace App\Modules\Mentor\Events;

class StudentMentorUpdated
{
    private int $userId;
    private int $mentorUserId;
    private string $primaryBrand;

    public function __construct(int $userId, int $mentorUserId, ?string $primaryBrand)
    {
        $this->userId = $userId;
        $this->mentorUserId = $mentorUserId;
        $this->primaryBrand = $primaryBrand ?? '';
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getMentorUserId(): int
    {
        return $this->mentorUserId;
    }

    public function getPrimaryBrand(): string
    {
        return $this->primaryBrand;
    }

}
