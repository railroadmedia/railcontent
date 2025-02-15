<?php

namespace App\Modules\Content\Models;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Content\Services\ChallengesStreakService;
use App\Services\UserTimezoneService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;
use App\Modules\Content\DTOs\ChallengeUserProgressLessonDatum;
use App\Modules\Content\DTOs\ChallengeUserProgressLessonDatumCollection;
use App\Modules\Content\DTOs\StreakData;
use App\Modules\Content\Enums\AwardTier;

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
            //'lessons_meta_data' => AsCollection::using(ChallengeUserProgressLessonDatumCollection::class),
            'lessons_meta_data' => 'array',
            'start_date' => 'datetime',
            'last_completed_date' => 'datetime',
        ];
    }

    public function getLessonsMetaData(): ChallengeUserProgressLessonDatumCollection
    {
        return new ChallengeUserProgressLessonDatumCollection($this->lessons_meta_data);
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
        //->where('start_date', '<=',  Carbon::now()->addHours(24));
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

    public function getStreakCurrentData(): StreakData
    {
        $today = Carbon::parse(Carbon::now()->timezone(UserTimezoneService::getUsersCurrentTimezone())->startOfDay()->toDateTimeString());
        // Carbon does messy things when comparing dates with 00:00:00
        $today->addSecond();
        return app(ChallengesStreakService::class)->generateStreaks(
            $this->getLessonsMetaData(),
            $today,
            startingStreakSavers: $this->getNumberOfCurriculumLessons() >= 10 ? 1 : 0,
        );
    }

    /**
     * @return - the largest streak of lessons in the current challenge
     */
    public function getBestCurrentStreak(): int
    {
        return $this->getStreakCurrentData()->best;
    }

    /**
     * @return - the current running streak of finished lessons
     */
    public function getCurrentStreak(): int
    {
        return $this->getStreakCurrentData()->current;
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
                    for ($reverseIndex = $lessonIndex - 1; $reverseIndex >= 0; $reverseIndex--) {
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
                    'is_milestone' => $lesson['is_milestone'] ?? false,
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
            'rest_days' => $streakData->totalStreakSavers,
            'is_unlocked' => !$this->is_locked,
            'best_completed_streak' => $this->completed_best_streak,
            'best_completed_time_practiced' => $this->completed_time_practiced,
            'last_completion_time' => $this->last_completed_date,
            'start_date' => $startEndDate['start_date'],
            'end_date' => $startEndDate['end_date'],
            'current_streak' => $streakData->current,
            'missed_lessons' => $streakData->missedLessons,
            'current_best_streak' => $streakData->best,
            'is_solo' => $this->is_solo,
            'minutes_practiced' => $this->getMinutesPracticed(),
            'completion_percent' => $this->getCompletionPercent(),
            'show_active_streak_saver' => $streakData->showActiveStreakSaver,
        ];
        return $data;
    }

    /**
     * Calculate the integer % of completed lessons
     * @return int
     */
    public function getCompletionPercent(): int
    {
        if (!$this->is_active) {
            return 0;
        }
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

    private function getNumberOfCurriculumLessons(): int
    {
        $curriculumLessons = array_filter($this->lessons_meta_data, function ($lesson) {
            return self::isCurriculumMetadataLesson($lesson);
        });
        return count($curriculumLessons);
    }

    /**
     * @param int $challengeId
     * @param int $userId
     * @return ChallengeUserProgress
     * @throws Exception
     */
    public static function whereChallengeIdAndUser(int $challengeId, int $userId): ChallengeUserProgress|null
    {
        $challengeUserCollection = self::onWriteConnection()
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
        $this->solo_notification_to_be_processed = 0;
        $this->save();
    }

    /**
     * Set lesson progress (completed and seconds_practiced) for a given lesson
     * @param int $lessonId
     * @param array $lessons - challenge lessons from sanity
     * @param bool $isCompleted
     * @param int|null $totalSecondsPracticed - if null, will not update the existing value
     * @return array -
     */
    public function updateLessonsProgress(
        int $lessonId,
        array $lessons,
        bool $isCompleted = true,
        ?int $totalSecondsPracticed = null,
        Carbon $completedTime = null
    ): array {
        /** @var StreakData $previousStreakData */
        $previousStreakData = $this->getStreakCurrentData();
        $results = [
            'added_to_streak' => false,
            'added_to_rest_days' => false,
        ];
        $lessonMetaData = $this->lessons_meta_data;
        foreach ($lessonMetaData as $index => $lessonMetaDatum) {
            // hack for V2 content Updates so we don't have to manually update everything in the db.
            // This can be removed in March 2025
            $lessonMetaData[$index]['is_milestone'] = $lessons[$index]['is_milestone'] ?? false;
            if ($lessonMetaDatum['content_id'] == $lessonId && !$lessonMetaDatum['completed']) {
                $lessonMetaData[$index]['completed'] = $isCompleted;
                $lessonMetaData[$index]['completed_at'] = ($completedTime ??
                    Carbon::parse(Carbon::now()->timezone(UserTimezoneService::getUsersCurrentTimezone())
                        ->toDateTimeString())->toISOString());
                if (!is_null($totalSecondsPracticed)) {
                    $lessonMetaData[$index]['seconds_practiced'] = $totalSecondsPracticed;
                }
                // remove March 2025
                break;
            }
        }
        $this->lessons_meta_data = $lessonMetaData;
        if ($this->is_active) {
            /** @var StreakData $currentStreakData */
            $currentStreakData = $this->getStreakCurrentData();
            $currentStreak = $currentStreakData->current;
            $hasStreakIncreased = $currentStreak != $previousStreakData->current;
            $results['added_to_streak'] = $hasStreakIncreased;
            $results['added_to_rest_days'] = $currentStreakData->mileStonesAdded > $previousStreakData->mileStonesAdded;
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
        $length = $this->getNumberOfCurriculumLessons();
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

    public static function isCurriculumMetadataLessonDTO(ChallengeUserProgressLessonDatum $metaDataLesson)
    {
        $isBonus = $metaDataLesson->isBonusContent;
        $isUnlocked = $metaDataLesson->isAlwaysUnlocked;
        return !($isBonus || $isUnlocked);
    }
}
