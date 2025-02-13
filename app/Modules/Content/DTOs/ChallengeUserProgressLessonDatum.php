<?php

namespace App\Modules\Content\DTOs;

use App\Services\UserTimezoneService;
use Illuminate\Support\Carbon;

class ChallengeUserProgressLessonDatum
{
    public int $contentId;
    public bool $completed;
    public bool $isAlwaysUnlocked;
    public bool $isBonusContent;
    public bool $isMilestone;
    public int $secondsPracticed;
    public Carbon $unlockDate;
    public ?Carbon $completedAt;
    public bool $isCurriculumLesson;

    public function __construct($lessonDatum)
    {
        $this->contentId = $lessonDatum['content_id'];
        $this->completed = $lessonDatum['completed'];
        $this->isAlwaysUnlocked = $lessonDatum['is_always_unlocked'];
        $this->isBonusContent = $lessonDatum['is_bonus_content'];
        $this->isMilestone = $lessonDatum['is_milestone'] ?? false;
        $this->secondsPracticed = $lessonDatum['seconds_practiced'];
        $this->unlockDate =  Carbon::parse($lessonDatum['unlock_date']);
        $this->completedAt = $lessonDatum['completed_at'] ? Carbon::parse($lessonDatum['completed_at']) : null;
        $this->isCurriculumLesson = !($this->isBonusContent || $this->isAlwaysUnlocked);
    }

    public function isCompletedOnDay(Carbon $day): bool
    {
        return $this->completedAt?->isSameDay($day) ?? false;
    }

    public function isUnlockedOnDay(Carbon $day): bool
    {
        return $this->unlockDate->isSameDay($day);
    }
}
