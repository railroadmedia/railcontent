<?php

namespace App\Modules\Content\DTOs;

use Carbon\Carbon;

class StreakData
{
    public int $totalCompletableLessons = 0;

    // computed values
    public bool $streakSaverUsed = false;
    public array $lessonsCompleted = [];

    public int $current = 0;
    public int $best = 0;
    public int $missedLessons = 0;
    public int $mileStonesAdded = 0;
    public bool $showActiveStreakSaver = false;

    public function __construct(
        public bool $lessonAdded,
        public ?Carbon $day,
        public int $totalStreakSavers = 0,
    ) {
    }

    public function addLessonCompleted(int $lessonId, ?bool $isMileStoneLesson)
    {
        if ($isMileStoneLesson) {
            $this->mileStonesAdded++;
        }
        $this->lessonsCompleted[] = $lessonId;
    }

    public function getLessonsCompleted(): int
    {
        return count($this->lessonsCompleted);
    }

    public static function getDecrementingStreakForNextDay(StreakData $previousStreak): StreakData
    {
        $streak = new StreakData(false, $previousStreak->day->copy()->addDay());
        $hasStreakSavers = $previousStreak->totalStreakSavers > 0;
        $streak->current = $hasStreakSavers ? $previousStreak->current : 0;
        $streak->totalStreakSavers = $hasStreakSavers ? $previousStreak->totalStreakSavers - 1 : 0;
        $streak->best = $previousStreak->best;
        $streak->missedLessons = $previousStreak->missedLessons;
        $streak->totalCompletableLessons = $previousStreak->totalCompletableLessons;
        return $streak;
    }

    public function toArray(): array
    {
        return [
            'best' => $this->best,
            'current' => $this->current,
            'missed' => $this->missedLessons,
            'milestones_added' => $this->mileStonesAdded,
            'show_active_streak_saver' => $this->showActiveStreakSaver,
            'remaining_rest_days' => $this->totalStreakSavers,
            'total_streak_savers' => $this->totalStreakSavers,
        ];
    }
}
