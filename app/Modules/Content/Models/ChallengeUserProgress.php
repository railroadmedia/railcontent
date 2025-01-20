<?php

namespace App\Modules\Content\Models;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Services\ChallengesService;
use App\Services\UserTimezoneService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;

enum AwardTier: string
{
    case GOLD = 'gold';
    case SILVER = 'silver';
    case BRONZE = 'bronze';
}

enum ChallengeUserProgressStatus: string
{
    case COMPLETED = 'completed';
    case NOTSTARTED = 'not_started';
    case ACTIVE = 'active';
    case INPROGRESS = 'in_progress';
}


/**
 * App\Modules\Content\Models\Content
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $user_id
 * @property boolean $is_locked
 * @property boolean $is_active
 * @property boolean $is_solo
 * @property boolean $solo_notification_to_be_processed
 * @property boolean $hide_completed_banner
 * @property integer $current_rest_days
 * @property array $lessons_meta_data - key: id to values: content_id,  completed, is_always_unlocked, is_bonus_content, seconds_practiced, unlock_date, completed_at
 * @property Carbon $start_date
 * @property Carbon $enroll_date
 * @property Carbon $last_completed_date
 * @property integer $completed_time_practiced
 * @property integer $completed_best_streak
 *
 */
class ChallengeUserProgress extends Model
{
    protected $table = 'challenges_user_progress';
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'lessons_meta_data' => 'array',
            'start_date' => 'datetime',
            'enroll_date' => 'datetime',
            'last_completed_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->whereNotNull('last_completed_date');
    }

    public function scopeLocked(Builder $query): Builder
    {
        return $query->where('is_locked', true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true);
            //->where('start_date', '<=',  Carbon::now()->addHours(24));
    }

    public function scopeCurrentlyActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true);
    }

    public function scopeSolo(Builder $query): Builder
    {
        return $query->where('is_solo', true);
    }

    public function scopeCommunity(Builder $query): Builder
    {
        return $query->where('is_solo', false);
    }

    public function scopeBrand(Builder $query, string $brand): Builder
    {
        // TODO TCH-112 - I don't think this branding works as expected, I don't know if content is linked this way
        if (Brand::tryFrom($brand)) {
            return $query->whereHas('content', fn (Builder $query) => $query->where('brand', $brand));
        }

        return $query;
    }

    public function scopeShowBadgeInBanner(Builder $query): Builder
    {
        return $query->where('hide_completed_banner', false);
    }

    public function getStartAndEndDate(): array
    {
        $startDate = $this->start_date;
        $finalStartDate = null;
        if ($startDate) {
            $endDate = Carbon::parse($startDate);
            foreach ($this->lessons_meta_data as $lesson) {
                if (is_null($finalStartDate) && self::isCurriculumMetadataLesson($lesson)) {
                    $finalStartDate = Carbon::parse($lesson['unlock_date']);
                }
                $unlockDate = Carbon::parse($lesson['unlock_date']);
                $endDate = max($endDate, $unlockDate);
            }
            $endDate = $endDate->toISOString();
        } else {
            $endDate = $startDate;
            $finalStartDate = $startDate;
        }
        return [
            'start_date' => $finalStartDate,
            'end_date' => $endDate,
        ];
    }

    public function getStreakCurrentData(): array
    {
        $userTimezone = UserTimezoneService::getUsersCurrentTimezone();
        $bestStreak = 0;
        $currentStreak = 0;
        $missedLessons = 0;
        $totalRestDaysUsed = 0; // Total rest days explicitly used via rest_day_used

        // Get today's date in the user's timezone
        $today = Carbon::parse(Carbon::now()->timezone($userTimezone)->startOfDay()->toDateTimeString());

        // A up all used rest days first so that they don't get
        // double-counted when a user uses rest days for past lesson
        foreach ($this->lessons_meta_data as $lesson) {
            $isCurriculumLesson = self::isCurriculumMetadataLesson($lesson);
            $unlockDate = Carbon::parse($lesson['unlock_date'])->startOfDay();

            // Skip lessons that are always unlocked, bonus, or unlock in the future
            if (!$isCurriculumLesson || $unlockDate->gt($today)) {
                continue;
            }

            // If the lesson doesn't have a "rest_day_used" field, initialize it
            $lesson['rest_day_used'] = $lesson['rest_day_used'] ?? false;

            if ($lesson['rest_day_used']) {
                $totalRestDaysUsed++; // Track total rest days used
            }
        }

        foreach ($this->lessons_meta_data as $lesson) {
            // Users today in their timezone should always compare directly with what unlock_date is in the DB
            $unlockDate = Carbon::parse($lesson['unlock_date'])->startOfDay();
            $completedAt = isset($lesson['completed_at']) ? Carbon::parse($lesson['completed_at']) : null;
            $isCurriculumLesson = self::isCurriculumMetadataLesson($lesson);

            // Skip lessons that are always unlocked, bonus, or unlock in the future
            if (!$isCurriculumLesson || $unlockDate->gt($today)) {
                continue;
            }

            // If the lesson doesn't have a "rest_day_used" field, initialize it
            $lesson['rest_day_used'] = $lesson['rest_day_used'] ?? false;

            // If the lesson unlock date is today, the user has until the end of the day to complete it
            // If it's already marked as a rest day, make sure to count for that
            if ($unlockDate->isSameDay($today) && !$completedAt) {
                continue;
            }

            // If the lesson was completed on its unlock date always award a streak
            if ($completedAt && $completedAt->isSameDay($unlockDate)) {
                $currentStreak++;
                $bestStreak = max($bestStreak, $currentStreak);
                continue;
            }

            // If the lesson has `rest_day_used = true`, do not count it as missed and maintain the streak but do not increase it
            if ($lesson['rest_day_used']) {
                // if a rest day was used, completing the lesson anytime should add to the streak,
                // otherwise it's a missed lesson
                if ($completedAt) {
                    $currentStreak++;
                    $bestStreak = max($bestStreak, $currentStreak);
                } else {
                    $missedLessons++;
                }

                continue;
            }

            // If this lesson is missed and it's in the past, only break the streak if
            // they don't have enough rest days to cover it if they were to complete the missed lesson in the future
            // and use up a rest day
            if (!$lesson['completed']) {
                $missedLessons++;
            }

            if ($missedLessons <= ($this->current_rest_days - $totalRestDaysUsed)) {
                continue;
            }

            // If the lesson is not completed and is a past lesson, and did not use a rest day, consider it missed.
            // If the lesson was completed, but it was at a later day than the unlock date and did not consume a rest day
            // break the streak.
            if ((!$lesson['completed'] && !$today->isSameDay($unlockDate)) ||
                (!empty($lesson['completed']) && !$completedAt->isSameDay($unlockDate))) {
                $currentStreak = 0; // Reset streak if the lesson was missed
            }

            $bestStreak = max($bestStreak, $currentStreak);
        }

        // Calculate the remaining rest days based on how many days explicitly used a rest day
        $remainingRestDays = max(0, $this->current_rest_days - $totalRestDaysUsed);

        return [
            'best' => $bestStreak,
            'current' => $currentStreak,
            'missed' => $missedLessons,
            'remaining_rest_days' => $remainingRestDays, // Include remaining rest days in output
        ];
    }

    /**
     * @return - the largest streak of lessons in the current challenge
     */
    public function getBestCurrentStreak()
    {
        return $this->getStreakCurrentData()['best'];
    }

    /**
     * @return - the current running streak of finished lessons
     */
    public function getCurrentStreak()
    {
        return $this->getStreakCurrentData()['current'];
    }

    /**
     * @return int - Sum of minutes practiced in this challenge run
     */
    public function getMinutesPracticed(): int
    {
        $secondsPracticed = 0;
        foreach ($this->lessons_meta_data as $lessonData) {
            $secondsPracticed += $lessonData['seconds_practiced'] ?? 0;
        }
        return (int)round($secondsPracticed / 60);
    }


    /**
     * Build the lessonsMetaData array for a given challenge
     * @param array $challenge - Sanity document for the challenge
     * @param Carbon|null $startDate - Start date for the challenge, if null we take the challenge published_on date, or now() whatever is older
     * @param bool $isUnlocked - Flag to indicate whether lessons are locked
     * @return array -
     */
    public static function defineLessonsMetaData(array $challenge, Carbon $startDate, bool $isChallengeLocked = true): array
    {
        $lessons = $challenge['lessons'];
        $startDate = Carbon::parse($startDate ?? $challenge['published_on']);
        $lessonMetaData = [];
        $rollingUnlockDate = $startDate->copy();
        $isSolo = $challenge['is_solo'] ?? false;

        foreach ($lessons as $lessonIndex => $lesson) {
            $isAlwaysUnlocked = $lesson['is_always_unlocked_for_challenge'] ?? false;
            $isBonusContent = $lesson['is_bonus_content_for_challenge'] ?? false;
            if ($isBonusContent) {
                if ($isSolo) {
                    // unlocked based on previous curriculum lesson's unlock_date
                    $unlockDate = null;
                    for ($reverseIndex = $lessonIndex -1; $reverseIndex >= 0; $reverseIndex--) {
                        $previousLesson = $lessons[$reverseIndex];
                        if (!$previousLesson['is_always_unlocked_for_challenge']) {
                            $previousLessonUnlockDate = $lessonMetaData[$reverseIndex]['unlock_date'];
                            $unlockDate = Carbon::parse($previousLessonUnlockDate);
                            break;
                        }
                    }
                    if (is_null($unlockDate)) {
                        $unlockDate = $startDate;
                    }
                } else {
                    // unlock based on published on date
                    $unlockDate = Carbon::parse($lesson['published_on']);
                }
            } elseif ($isAlwaysUnlocked) {
                $unlockDate = Carbon::parse($lesson['published_on']);
            } elseif ($isChallengeLocked) {
                $unlockDate = $rollingUnlockDate;
            } else { // unguided experience
                $unlockDate = $startDate;
            }
            $lessonPublishedDate = Carbon::parse($lesson['published_on']);
            $unlockDate = max($unlockDate, $lessonPublishedDate);


            // TODO, handle this in a specific field in the database
            // For solo challenges,
            // always set the first days unlock time to exactly when the student enrolling in UTC. We need this
            // for timezone calculations.
            if ($lessonIndex === 0) {
                $unlockDate = $startDate;
            }

            $lessonMetaData[] =
                [
                    'content_id' => $lesson['id'],
                    'is_bonus_content' => $isBonusContent,
                    'completed' => false,
                    'seconds_practiced' => 0,
                    'unlock_date' => $unlockDate->toISOString(),
                    'is_always_unlocked' => $isAlwaysUnlocked,
                    'completed_at' => null,
                    'rest_day_used' => false,
                ];
            $incrementRollingDayCounter = !(($isSolo && $isBonusContent) || $isAlwaysUnlocked);
            if ($incrementRollingDayCounter) {
                // TODO start of day? to hande daylight saving times
                $rollingUnlockDate->addDay();
            }
        }
        return $lessonMetaData;
    }

    public function getCompiledMetadata(): array
    {
        $streakData = $this->getStreakCurrentData();
        $startEndDate = $this->getStartAndEndDate();
        $data = [
            'is_active' => $this->is_active,
            'rest_days' => $streakData['remaining_rest_days'],
            'is_unlocked' => !$this->is_locked,
            'best_completed_streak' => $this->completed_best_streak,
            'best_completed_time_practiced' => $this->completed_time_practiced,
            'last_completion_time' => $this->last_completed_date,
            'start_date' => $startEndDate['start_date'],
            'end_date' => $startEndDate['end_date'],
            'current_streak' => $streakData['current'],
            'missed_lessons' => $streakData['missed'],
            'current_best_streak' => $streakData['best'],
            'is_solo' => $this->is_solo,
            'minutes_practiced' => $this->getMinutesPracticed(),
            'completion_percent' => $this->getCompletionPercent(),
        ];
        return $data;
    }

    /**
     * Calculate the integer % of completed lessons
     * @return int
     */
    public function getCompletionPercent(): int
    {
        if (!$this->is_active) return 0;
        $total = 0;
        $completed = 0;
        foreach ($this->lessons_meta_data as $lessons_meta_datum) {
            $isCurriculumLesson = self::isCurriculumMetadataLesson($lessons_meta_datum);
            if ($isCurriculumLesson) {
                $total++;
                $completed += $lessons_meta_datum['completed'] ? 1 : 0;
            }
        }
        return intval(($completed * 100) / $total);
    }


    /**
     * @param array $challenge - Sanity Document for the challenge
     * @return int - number of rest days
     */
    public static function calculateDefaultRestDays(array $challenge): int
    {
        return ChallengeUserProgress::getNumberOfCurriculumLessonsInSanityChallenge($challenge) >= 10 ? 1 : 0;
    }


    public static function getNumberOfCurriculumLessonsInSanityChallenge(array $challenge): int
    {
        $curriculumLessons = array_filter($challenge['lessons'], function ($lesson) {
            return self::isCurriculumSanityLesson($lesson);
        });
        return count($curriculumLessons);
    }

    private function getNumberOfCurruculumLessons(): int
    {
        $cirruculumLessons = array_filter($this->lessons_meta_data, function ($lesson) {
            return self::isCurriculumMetadataLesson($lesson);
        });
        return count($cirruculumLessons);
    }

    /**
     * @param int $challengeId
     * @param int $userId
     * @return ChallengeUserProgress
     * @throws Exception
     */
    public static function whereChallengeIdAndUser(int $challengeId, int $userId): ChallengeUserProgress|null
    {
        $challengeUserCollection = self::query()
            ->where('content_id', $challengeId)
            ->where('user_id', $userId)
            ->get();

        if ($challengeUserCollection->count() > 1) {
            throw new Exception(
                sprintf(
                    'Multiple %s found for Content %s and User %s',
                    class_basename(__CLASS__),
                    $challengeId,
                    $userId
                )
            );
        }
        if ($challengeUserCollection->isNotEmpty()) {
            return self::updateRestDaysIfRestDayUsed($challengeUserCollection->first());
        }

        return null;
    }

    /**
     * How this works: when a student completes a lesson and it's unlock day is in the past it will use up a rest day
     * to prevent their streak from breaking. A missed lesson must be completed to consume a rest day.
     * Streaks will never break unless the missed lesson count is greater than their available rest days.
     *
     * @param ChallengeUserProgress|null $challengeUserProgress
     * @return ChallengeUserProgress|null
     */
    public static function updateRestDaysIfRestDayUsed(?ChallengeUserProgress $challengeUserProgress): ?ChallengeUserProgress
    {
        if (!$challengeUserProgress) {
            return null;
        }

        $remainingRestDays = $challengeUserProgress->current_rest_days;
        $userTimezone = UserTimezoneService::getUsersCurrentTimezone();
        $today = Carbon::parse(Carbon::now()->timezone($userTimezone)->startOfDay()->toDateTimeString());

        // Extract lessons_meta_data as a separate variable
        $lessonsMetaData = $challengeUserProgress->lessons_meta_data;

        foreach ($lessonsMetaData as $index => &$lesson) {
            $unlockDate = Carbon::parse($lesson['unlock_date'])->startOfDay();
            $completedAt = $lesson['completed_at'] ? Carbon::parse($lesson['completed_at']) : null;

            // If the lesson doesn't have a "days_shifted" or "rest_day_used" field, initialize them
            $lesson['rest_day_used'] = $lesson['rest_day_used'] ?? false;

            // ignore if this is a bonus or always unlocked lesson
            if (!self::isCurriculumMetadataLesson($lesson) || $unlockDate->gt($today)) {
                continue;
            }

            // If the lesson has already used a rest day, skip it (do not reapply rest day logic)
            if ($lesson['rest_day_used']) {
                $remainingRestDays--;
                continue;
            }

            // If the lesson unlock date is today, the user has until the end of the day to complete it
            if ($unlockDate->isSameDay($today)) {
                continue;
            }

            // If the lesson was completed on its unlock date then no rest day is necessary
            if ($completedAt && $completedAt->isSameDay($unlockDate)) {
                continue;
            }

            // If a lesson was completed after it's unlock day, use a rest day on it if one is available
            if ($lesson['completed'] &&
                !$completedAt?->isSameDay($unlockDate) &&
                $remainingRestDays > 0
            ) {
                $remainingRestDays--;
                $lessonsMetaData[$index]['rest_day_used'] = true; // Explicitly mark that a rest day was used for this lesson
            }
        }

        // Reassign the updated array to lessons_meta_data if there was an update
        if (md5(json_encode($challengeUserProgress->lessons_meta_data)) !== md5(json_encode($lessonsMetaData))) {
            $challengeUserProgress->lessons_meta_data = $lessonsMetaData;
            $challengeUserProgress->save();
        }

        return $challengeUserProgress;
    }

    /**
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public static function whereUserIdAndActive(int $userId)
    {
        $challengeUserCollection = self::query()
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->orderBy('start_date')
            ->get();
        return collect($challengeUserCollection);
    }

    /**
     * @param int $userId
     * @param int $page
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public static function whereUserId(int $userId, int $page = 1, int $limit = 10): \Illuminate\Support\Collection
    {
        $challengeUserCollection = self::query()
            ->where('user_id', $userId)
            ->orderBy('start_date')
            ->paginate(
                $limit,
                ['*'],
                'page',
                $page
            )
            ->items();
        return collect($challengeUserCollection);
    }

    /**
     * @param int $userId
     * @param $page
     * @param $limit
     * @return \Illuminate\Support\Collection
     */
    public static function whereUserIdAndCompleted(
        int $userId,
        ?int $page = 1,
        ?int $limit = 10
    ): \Illuminate\Support\Collection {
        $challengeUserCollection = self::query()
            ->where('user_id', $userId)
            ->whereNotNull('last_completed_date')
            ->orderByDesc('last_completed_date')
            ->paginate(
                $limit,
                ['*'],
                'page',
                $page
            )
            ->items();

        return collect($challengeUserCollection);
    }

    /**
     * @param array $challengeIds
     * @param int $userId
     * @return Collection | null
     * @throws Exception
     */
    public static function whereChallengeIdsAndUser(array $challengeIds, int $userId): Collection|null
    {
        $challengeUserCollection = self::query()
            ->whereIn('content_id', $challengeIds)
            ->where('user_id', $userId)
            ->orderByDesc('start_date')
            ->get();
        return $challengeUserCollection;
    }


    public function leaveChallenge()
    {
        $this->is_active = false;
        $this->current_rest_days = 0;
        $this->lessons_meta_data = [];
        $this->is_locked = true;
        $this->start_date = null;
        $this->save();
    }

    /**
     * Set lesson progress (completed and seconds_practiced) for a given lesson
     * @param int $lessonId
     * @param bool $isCompleted
     * @param int|null $totalSecondsPracticed - if null, will not update the existing value
     * @return array -
     */
    public function updateLessonsProgress(
        int $lessonId,
        bool $isCompleted = true,
        ?int $totalSecondsPracticed = null,
        Carbon $completedTime = null
    ): array {
        $previousStreakData = $this->getStreakCurrentData();
        $results = [
            'is_milestone' => false,
            'added_to_streak' => false,
            'added_to_rest_days' => false,
        ];
        $lessonMetaData = $this->lessons_meta_data;
        $wereAllLessonsCompleted = $this->areAllLessonsCompleted();
        foreach ($lessonMetaData as $index => $lessonMetaDatum) {
            if ($lessonMetaDatum['content_id'] == $lessonId && !$lessonMetaDatum['completed']) {
                $lessonMetaData[$index]['completed'] = $isCompleted;
                $lessonMetaData[$index]['completed_at'] = ($completedTime ??
                    Carbon::parse(Carbon::now()->timezone(UserTimezoneService::getUsersCurrentTimezone())
                        ->toDateTimeString())->toISOString());
                if (!is_null($totalSecondsPracticed)) {
                    $lessonMetaData[$index]['seconds_practiced'] = $totalSecondsPracticed;
                }
                break;
            }
        }
        $this->lessons_meta_data = $lessonMetaData;
        $areAllLessonsCompleted = $this->areAllLessonsCompleted();
        if ($this->is_active) {
            $currentStreakData = $this->getStreakCurrentData();
            $totalLessons = $this->getNumberOfCurruculumLessons();
            /**
             * Milestones will need basic logic
             * 30-day challenge - every 5 days
             * 10-day challenge - one at 5 days
             * 1-9  day challenge - none, other than completion
             * 10-19 day challenges - Every Days / 2 - Integer only (default integer behaviour for rounding purposes)
             * 20-29 day - Every Days / 4 - Integer only  (default integer behaviour for rounding purposes)
             * Example: 29 / 2 = 15. Day 15 milestone & completion milestone
             * Every milestone is +1 rest day
             */
            $currentStreak = $currentStreakData['current'];
            $hasStreakIncreased = $currentStreak != $previousStreakData['current'];
            $results['added_to_streak'] = $hasStreakIncreased;
            if ($hasStreakIncreased) {
                if ($totalLessons >= 10) {
                    if ($totalLessons == 10 || $totalLessons == 30) {
                        $isMilestoneStreak = ($currentStreak % 5 == 0);
                    } elseif (20 <= $totalLessons && $totalLessons <= 29) {
                        $oneQuarter = $totalLessons / 4;
                        $milestones = [];
                        foreach ([1,2,3,4] as $m) {
                            $milestones[] = round($m * $oneQuarter);
                        }
                        $isMilestoneStreak = in_array($currentStreak, $milestones);
                    } else {
                        $isMilestoneStreak = $totalLessons == $currentStreak || round(
                            $totalLessons / 2
                        ) == $currentStreak;
                    }
                    $results['is_milestone'] = $isMilestoneStreak;

                    // If a rest day is used to maintain the streak, we need to make sure the difference in
                    // rest day change is accounted for here since the database doesn't get updated until
                    // after the new $currentStreakData() is calculated. This has code smell.
                    $this->current_rest_days += $isMilestoneStreak ? (1 + ($currentStreakData['remaining_rest_days'] - $previousStreakData['remaining_rest_days'])) : 0;

                    $results['added_to_rest_days'] = $isMilestoneStreak;
                } else {
                    $results['is_milestone'] = $totalLessons == $currentStreak;
                }
            }
            if ($areAllLessonsCompleted && !$wereAllLessonsCompleted) {
                $results['is_milestone'] = true;
            }
        }
        $this->save();
        return $results;
    }

    /**
     * @return bool
     */
    public function isCompleteAndNotActive(): bool
    {
        return !$this->is_active && !is_null($this->last_completed_date);
    }

    /**
     * @return bool - if all non-intro lessons are completed
     */
    public function areAllLessonsCompleted(): bool
    {
        foreach ($this->lessons_meta_data as $lessons_meta_datum) {
            $isCurriculumLesson = self::isCurriculumMetadataLesson($lessons_meta_datum);
            $isCompleted = $lessons_meta_datum['completed'];
            if ($isCurriculumLesson && !$isCompleted) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param int $id - Content Id
     * @return array | null;
     */
    public function getMetaDatumForContent(int $id): array|null
    {
        foreach ($this->lessons_meta_data as $lessonDatum) {
            if ($lessonDatum['content_id'] == $id) {
                return $lessonDatum;
            }
        }
        return null;
    }


    public function getAwardTier(): AwardTier
    {
        $length = $this->getNumberOfCurruculumLessons();
        $bestStreak = $this->completed_best_streak;
        $halfLength = $length / 2;
        if ($length == $bestStreak) {
            return AwardTier::GOLD;
        } elseif ($length < 10 || $bestStreak < $halfLength) {
            return AwardTier::BRONZE;
        } else {
            return AwardTier::SILVER;
        }
    }

    public static function isCurriculumSanityLesson($sanityLesson)
    {
        $isBonus = $sanityLesson['is_bonus_content_for_challenge'];
        $isUnlocked = $sanityLesson['is_always_unlocked_for_challenge'];
        return !($isBonus || $isUnlocked);
    }

    public static function isCurriculumMetadataLesson($metaDataLesson)
    {
        $isBonus = $metaDataLesson['is_bonus_content'];
        $isUnlocked = $metaDataLesson['is_always_unlocked'];
        return !($isBonus || $isUnlocked);
    }
}
