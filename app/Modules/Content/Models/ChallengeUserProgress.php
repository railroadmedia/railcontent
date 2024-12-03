<?php

namespace App\Modules\Content\Models;

use App\Modules\Brand\Enums\Brand;
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
 * @property boolean $hide_completed_banner
 * @property integer $current_rest_days
 * @property array $lessons_meta_data - key: id to values: content_id,  completed, is_always_unlocked, is_bonus_content, seconds_practiced, unlock_date
 * @property Carbon $start_date
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
            'start_date' => 'date',
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

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->where('start_date', '<=',  Carbon::now()->addHours(24));
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
        if ($startDate) {
            $endDate = Carbon::parse($startDate);
            foreach ($this->lessons_meta_data as $lesson) {
                $unlockDate = Carbon::parse($lesson['unlock_date']);
                $endDate = max($endDate, $unlockDate);
            }
        } else {
            $endDate = $startDate;
        }
        return [
            'start_date' => $startDate,
            'end_date' => $endDate->toISOString(),
        ];
    }

    public function getStreakCurrentData(): array
    {
        $bestStreak = 0;
        $currentStreak = 0;
        $missedLessons = 0;
        $remainingRestDays = $this->current_rest_days; // Use the available rest days
        $today = Carbon::now()->startOfDay();

        foreach ($this->lessons_meta_data as $lesson) {
            $unlockDate = Carbon::parse($lesson['unlock_date'])->startOfDay();
            $completedAt = isset($lesson['completed_at']) ? Carbon::parse($lesson['completed_at'])->startOfDay() : null;

            // Skip lessons that are always unlocked, bonus, or unlock in the future
            if ($lesson['is_always_unlocked'] || $unlockDate > $today) {
                continue;
            }

            if ($completedAt) {
                // Completion counts toward streak only if completed on the day it was unlocked
                if ($completedAt->isSameDay($unlockDate)) {
                    $currentStreak++;
                } else {
                    // Use a rest day if available
                    if ($remainingRestDays > 0) {
                        $remainingRestDays--; // Consume one rest day
                        $currentStreak++; // Continue streak as if the day was completed
                    } else {
                        // Reset streak if no rest days remain
                        $currentStreak = 0;
                    }
                }
            } elseif (!Carbon::now()->isSameDay($unlockDate)) {
                // Use a rest day for non-completions if it's a passed day
                if ($remainingRestDays > 0) {
                    $remainingRestDays--; // Consume one rest day
                    $currentStreak++; // Count the skipped day toward the streak
                } else {
                    // Reset streak if no rest days remain
                    $currentStreak = 0;
                    $missedLessons++;
                }
            }

            $bestStreak = max($bestStreak, $currentStreak);
        }

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
    public static function defineLessonsMetaData(array $challenge, Carbon $startDate, bool $isLocked = true): array
    {
        $lessons = $challenge['lessons'];
        $startDate = Carbon::parse($startDate ?? $challenge['published_on'])->startOfDay();
        $lessonMetaData = [];
        //TODO does this need to be moved to the user's timezone?
        // Document says only for solo challenges
        // https://musora.atlassian.net/browse/TCH-40
        $rollingUnlockDate = $startDate->copy();
        foreach ($lessons as $lesson) {
            $isAlwaysUnlocked = $lesson['is_always_unlocked_for_challenge'] ?? false;
            $unlockDate = !$isLocked || $isAlwaysUnlocked ? $startDate : $rollingUnlockDate;
            $lessonPublishedDate = Carbon::parse($lesson['published_on']);
            $unlockDate = max($unlockDate, $lessonPublishedDate);
            $lessonMetaData[] =
                [
                    'content_id' => $lesson['id'],
                    'is_bonus_content' => $lesson['is_bonus_content_for_challenge'] ?? false,
                    'completed' => false,
                    'seconds_practiced' => 0,
                    'unlock_date' => $unlockDate->toISOString(),
                    'is_always_unlocked' => $isAlwaysUnlocked,
                    'completed_at' => null,
                ];
            if (!$lesson['is_always_unlocked_for_challenge']) {
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
            'rest_days' => $this->current_rest_days,
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
        $total = 0;
        $completed = 0;
        foreach ($this->lessons_meta_data as $lessons_meta_datum) {
            if (!$lessons_meta_datum['is_always_unlocked']) {
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
        return ChallengeUserProgress::getNumberOfLessonDaysInChallenge($challenge) >= 10 ? 1 : 0;
    }


    public static function getNumberOfLessonDaysInChallenge(array $challenge): int
    {
        $lessonLessonsAsOpposedToIntroLessons = array_filter($challenge['lessons'], function ($lesson) {
            return !($lesson['is_always_unlocked_for_challenge'] ?? false);
        });
        return count($lessonLessonsAsOpposedToIntroLessons);
    }

    private function getNumberOfLessonDays(): int
    {
        $lessonLessonsAsOpposedToIntroLessons = array_filter($this->lessons_meta_data, function ($lesson) {
            return !$lesson['is_always_unlocked'];
        });
        return count($lessonLessonsAsOpposedToIntroLessons);
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
        return $challengeUserCollection->first();
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
        ?int $totalSecondsPracticed = null
    ): array {
        $previousStreakData = $this->getStreakCurrentData();
        $results = [
            'is_milestone' => false,
            'added_to_streak' => false,
            'added_to_rest_days' => false,
        ];
        $lessonMetaData = $this->lessons_meta_data;

        foreach ($lessonMetaData as $index => $lessonMetaDatum) {
            if ($lessonMetaDatum['content_id'] == $lessonId) {
                $lessonMetaData[$index]['completed'] = $isCompleted;
                $lessonMetaData[$index]['completed_at'] = Carbon::now()->toISOString();
                if (!is_null($totalSecondsPracticed)) {
                    $lessonMetaData[$index]['seconds_practiced'] = $totalSecondsPracticed;
                }
                break;
            }
        }
        $this->lessons_meta_data = $lessonMetaData;
        if ($this->is_active) {
            $currentStreakData = $this->getStreakCurrentData();
            $totalLessons = $this->getNumberOfLessonDays();
            /**
             * Milestones will need basic logic
             * 30-day challenge - every 5 days
             * 10-day challenge - one at 5 days
             * 1-9  day challenge - none, other than completion
             * 11-29 day challenges - Every Days / 2 - Integer only (default integer behaviour for rounding purposes)
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
                    } else {
                        $isMilestoneStreak = $totalLessons == $currentStreak || ceil(
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
            if ($lessons_meta_datum['is_always_unlocked']) {
                continue;
            }
            if (!$lessons_meta_datum['completed']) {
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
        $length = $this->getNumberOfLessonDays();
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
}
