<?php

namespace App\Modules\Content\ApiResources\Challenges;

use App\Modules\Content\Models\ChallengeUserProgress;
use Carbon\Carbon;

class UserProgressDataForMusoraCenter
{
    public function __construct(
        public readonly string $brand,
        public readonly int $challengeId,
        public readonly bool $owned,
        public readonly string $name,
        public readonly bool $isSolo,
        public readonly bool $isCurrentlyEnrolled,
        public readonly bool $isInUnguidedExperience,
        public readonly string $mostRecentEnrollDate,
        public readonly string $startDate,
    ) {}

    public static function fromUserAndChallenge(ChallengeUserProgress $userProgress, array $challenge)
    {
        $owned = false;
        return new UserProgressDataForMusoraCenter(
            $challenge['brand'],
            $challenge['id'],
            $owned,
            $challenge['title'],
            $userProgress->is_solo,
            $userProgress->is_active,
            !$userProgress->is_locked,
            $userProgress->enroll_date?->toISOString() ?? '',
            $userProgress->start_date?->toISOString() ?? '',
        );
    }
}
