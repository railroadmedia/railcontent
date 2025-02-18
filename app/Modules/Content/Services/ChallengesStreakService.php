<?php

namespace App\Modules\Content\Services;

use App\Modules\Content\DTOs\ChallengeUserProgressLessonDatumCollection;
use App\Modules\Content\DTOs\ChallengeUserProgressLessonDatum;
use App\Modules\Content\DTOs\StreakData;
use Carbon\Carbon;

class ChallengesStreakService
{
    public function __construct()
    {
    }

    public function generateStreaks(
        ChallengeUserProgressLessonDatumCollection $lessonsMetaData,
        Carbon $endDate,
        int $startingStreakSavers
    ): StreakData {

        // This algorithm does a forward iteration of all days in the streak based on the current date (passed in as
        // $streaks has all days as sequential indexes  so the algorithm can walk backwards as necessary
        // $streaks has an upper limit of the number of days that it will be included.
        // Part 0 - Generate empty streakData elements based on the curriculum lessons in the challenge.
        // Part 1 - First we check if the challenge has started based on the first curriculum day. Return
        // - This currently is short circuted in generateStreakDataForUnstartedChallenge
        // Part 2 -  - If the user has not started lessons we don't run the algorithm (this saves streak savers until the user has started
        // Part 2.5 - The first time a lesson is completed we start tracking streak values
        // Part 2.9 - Return empty streak data
        // Part 3 - Update streak, streakSavers, and missedLessons based on yesterdays values
        // Part 4 - Explicit handling of situations - logic for "today" is different than day's in the past
        // Part 5 - If the user has not completed the challenge and we are calculating for streaks a long time is the future, we iterate (and decrement) the streak data until we have 0 SS savers.
        // Part 6 - Calculate maximum streak - this is handled in an other function where we walk the streak data again. It is much simplier to do a once over post process than track in the incremental algorithm
        $index = ChallengesStreakService::keyFromDate($endDate);


        // Only curriculum lessons are considered in the algorithm
        $curriculumLessons = $lessonsMetaData->filter(function ($lessonDatum) {
            return $lessonDatum->isCurriculumLesson;
        });
        // Part 2 - If the user hasn't completed any lessons, we don't consume streak savers yet
        // these two methods iterate over the $curriculumLessons array and could be combined into a single iteration for performance
        if (!$this->hasUserCompletedLessons($curriculumLessons, $endDate)) {
            // This is technically a short circuit of part 2 in the incremental algorithm and could be removed
            return $this->generateStreakDataForUnstartedChallenge($curriculumLessons, $endDate, $startingStreakSavers);
        }


        $streaks = $this->getUncalculatedStreakElements($curriculumLessons, $endDate);
        // This is also a duplication of Part 2 and likely could be removed for performance
        // The problem with writing algorithms sequentionally is that I find better ways to do it after I've written it
        if (!$streaks) {
            $streak = new StreakData(false, null);
            $streak->totalStreakSavers = $startingStreakSavers;
            return $streak;
        }

        $finalStreakData = $this->calculateStreakDataIncremental($streaks, $startingStreakSavers, $endDate);
        $finalStreakData->best = $this->calculateMaxStreaks($streaks);
        return $finalStreakData;
    }

    /**
     * @param ChallengeUserProgressLessonDatumCollection $curriculumLessons
     * @return bool
     */
    private function hasUserCompletedLessons(
        ChallengeUserProgressLessonDatumCollection $curriculumLessons,
        Carbon $endDate
    ): bool {
        /** @var ChallengeUserProgressLessonDatum $curriculumLesson */
        foreach ($curriculumLessons as $curriculumLesson) {
            if ($curriculumLesson->completed) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param ChallengeUserProgressLessonDatumCollection $lessonMetaData
     * @param Carbon $endDate
     * @param int $startingStreakSavers
     * @return StreakData
     */
    private function generateStreakDataForUnstartedChallenge(ChallengeUserProgressLessonDatumCollection $lessonMetaData, Carbon $endDate, int $startingStreakSavers): StreakData
    {
        $missedLessons = 0;
        /** @var ChallengeUserProgressLessonDatum $lessonMetaDatum */
        foreach ($lessonMetaData as $lessonMetaDatum) {
            $unlockDay = $lessonMetaDatum->unlockDate->copy()->startOfDay();
            if (self::isAPastDay($unlockDay, $endDate)) {
                $missedLessons++;
            } else {
                break;
            }
        }
        $streak = new StreakData(false, $endDate, totalStreakSavers: $startingStreakSavers);
        $streak->missedLessons = $missedLessons;
        return $streak;
    }

    /**
     * @param ChallengeUserProgressLessonDatumCollection $curriculumLessons
     * @param Carbon $endDay
     * @return ?array|StreakData[]
     */
    private function getUncalculatedStreakElements(
        ChallengeUserProgressLessonDatumCollection $curriculumLessons,
        Carbon $endDay
    ): ?array {
        // This generates an uncalculated StreakData object for each day from the start of the challenge to $endDay
        // Part 0.1 - for each lesson add an lessonAdded streak
        // Part 0.2 - add each completed lesson to the StreakData
        // Part 0.3 - fill in any missing days
        // Part 0.4 - Clip long running challenge data in the future for users who haven't finished the challenge
        // Part 0.5 - Calculate total completeable lessons - we cannot calculate these in the first pass as bonus lesson days are not yet included in the array
        // clip the streaks array to the last completed lesson + 10 days so that we don't continue running streaks forever

        $firstDay = Carbon::parse($curriculumLessons->first()->unlockDate)->startOfDay();
        // Part2 - included yet again short circuit algorithm if we are before the first curriculum lesson
        if ($endDay->lessThan($firstDay)) {
            return null;
        }
        $lastCompletedLessonDay = null;

        $streakElements = [];
        /** @var  ChallengeUserProgressLessonDatum $curriculumLesson */
        foreach ($curriculumLessons as $curriculumLesson) {
            $unlockDay = $curriculumLesson->unlockDate->startOfDay();
            $completedAtDay = isset($curriculumLesson->completedAt) ? $curriculumLesson->completedAt->startOfDay(
            ) : null;


            if ($completedAtDay && (!$lastCompletedLessonDay || $lastCompletedLessonDay->lessThan($completedAtDay))) {
                $lastCompletedLessonDay = $completedAtDay->copy();
            }
            // Part 0.1 -
            $dayKey = ChallengesStreakService::keyFromDate($unlockDay);
            if (isset($streakElements[$dayKey])) {
                //This situation shouldn't arise as we go sequentially. Can't promise admin's won't mess up my day though
                $streakElements[$dayKey]->lessonAdded = true;
            } else {
                $streakElements[$dayKey] = new StreakData(true, $unlockDay);
            }
            // Part 0.2 - Complete any lessons on that day
            if ($completedAtDay) {
                $completedAtDayKey = ChallengesStreakService::keyFromDate($completedAtDay);
                if (!isset($streakElements[$completedAtDayKey])) {
                    // This accounts for bonus days and days past the end of the challenge
                    $streakElements[$completedAtDayKey] = new StreakData(false, $completedAtDay);
                }
                $streakElements[$completedAtDayKey]->addLessonCompleted(
                    $curriculumLesson->contentId,
                    $curriculumLesson->isMilestone
                );
            }
            $lastCurriculumDay = $curriculumLesson->unlockDate;
        }

        $todayOrLastLessonDay = max($lastCurriculumDay, $endDay);
        // Part 0.3 - Fill in missing days
        while (self::isAPastDay($firstDay, $todayOrLastLessonDay)) {
            $dayKey = ChallengesStreakService::keyFromDate($firstDay);
            if (!isset($streakElements[$dayKey])) {
                $streakElements[$dayKey] = new StreakData(false, $firstDay->copy());
            }
            $firstDay->addDay();
        }
        ksort($streakElements);

        // Part 0.4 - clip streak data
        // this can be improved I'm sure, but we don't know how many milestones there are, so 10 is a graceous number
        $lastDayToCalculate = max($lastCompletedLessonDay, $lastCurriculumDay)->copy();
        /** @var StreakData $element */
        $lastDayToCalculate->addDays(10);
        $streakElements = array_filter($streakElements, function ($element) use ($lastDayToCalculate) {
            return self::isAPastDay($element->day, $lastDayToCalculate);
        });

        // Part 0.5 - Calculate total completable lessons
        $totalCompletableLessons = 0;
        $totalCompletedLessons = 0;
        /** @var StreakData $streakElement */
        foreach ($streakElements as $streakElement) {
            $totalCompletableLessons += $streakElement->lessonAdded ? 1 : 0;
            $lessonsCompleted = $streakElement->getLessonsCompleted();
            $totalCompletedLessons += $lessonsCompleted;
            $streakElement->totalCompletableLessons = $totalCompletableLessons;
            $streakElement->missedLessons = $totalCompletableLessons - $totalCompletedLessons;
            if ($totalCompletableLessons == 0) {
                $streakElement->missedLessons = 0;
            } elseif ($totalCompletableLessons > 0 && $streakElement->day->isSameDay($endDay) && $streakElement->lessonAdded && $lessonsCompleted == 0) {
                $streakElement->missedLessons--;
            }
        }

        return $streakElements;
    }

    /**
     * @param array{
     *     StreakData
     * } $streaks
     * @param int $startingStreakSavers
     * @param Carbon $endDate - final date of the algorithm
     * @return StreakData -- current streak for the $endDate provided
     */
    private function calculateStreakDataIncremental(
        array &$streaks,
        int $startingStreakSavers,
        Carbon $endDate
    ): StreakData {
        $currentCompletedLessons = 0;
        $currentCompletableLessons = 0;
        $hasUserCompletedALesson = false;
        /** @var ?Carbon $lastCompletedDay */
        $lastCompletedDay = null;
        /** @var StreakData $streak */
        foreach ($streaks as $index => $streak) {
            $previousIndex = ChallengesStreakService::keyFromDate(Carbon::parse($index)->subDays(1));
            // Part 1 - Return an empty streak object
            // Part X  the previous streak calculated
            if (self::isAPastDay($endDate, $streak->day)) {
                return $streaks[$previousIndex] ?? new StreakData(false, $endDate->copy(), $startingStreakSavers);
            }
            $lessonsCompleted = $streak->getLessonsCompleted();
            $currentCompletedLessons += $lessonsCompleted;
            $currentCompletableLessons += $streak->lessonAdded ? 1 : 0;

            // Part 2 - Only start when the user has completed a lesson
            if ($currentCompletedLessons == 0) {
                $streak->totalStreakSavers = $startingStreakSavers;
                continue;
            }

            if ($lessonsCompleted > 0 && (is_null($lastCompletedDay) || self::isAPastDay($lastCompletedDay, $streak->day))) {
                $lastCompletedDay = $streak->day->copy();
            }
            $streak->showActiveStreakSaver = $streaks[$previousIndex]?->streakSaverUsed ?? false;

            // Part 2.5 First time completing a lesson
            if ($lessonsCompleted && !$hasUserCompletedALesson) {
                $streak->current = $lessonsCompleted;
                // and god forbid the first lesson they do is a milestone lesson, but hey, it's accounted for here (and it tests)
                $streak->totalStreakSavers = $startingStreakSavers + $streak->mileStonesAdded;
                $streak->missedLessons = $currentCompletableLessons - $currentCompletedLessons;
                if ($endDate->isSameDay($streak->day) && $streak->missedLessons > 0 && $streak->lessonAdded) {
                    $streak->missedLessons -= 1;
                }
                $hasUserCompletedALesson = true;
                continue;
            }

            // Part 3 - Increment data
            $streak->current = ($streaks[$previousIndex]?->current ?? 0) + $lessonsCompleted;
            $streak->totalStreakSavers = ($streaks[$previousIndex]->totalStreakSavers ?? $startingStreakSavers) + $streak->mileStonesAdded;
            $streak->missedLessons = $currentCompletableLessons - $currentCompletedLessons;

            // Part 4 - Explicit handling of situations
            if ($currentCompletableLessons == $currentCompletedLessons) {
                // user has completed all lessons, nothing to do
                // this accounts for bonus days as well as curriculum days
            } elseif ($endDate->isSameDay($streak->day)) {
                // only break streaks when the day is in the past
                // Missed lessons is adjusted, this made sense in my head and now I can't explain it
                // If we added a lesson today, don't count that lesson
                // If we have previous missed lessons, we include it unless it's a bonus day? Something like that
                //                $streak->missedLessons -= $streak->lessonAdded ? 1 : 0;
                $previousMissedLessons = $streaks[$previousIndex]->missedLessons ?? 0;
                $isCatchup = $previousMissedLessons > 0;
                if ($isCatchup) {
                    if ($streak->lessonAdded) {
                        if ($lessonsCompleted > 0) {
                            $streak->missedLessons = max(0, $previousMissedLessons - $lessonsCompleted + 1);
                        } else {
                            $streak->missedLessons = $previousMissedLessons;
                        }

                    } else {
                        // if it's a bonus day, we
                        //$streak->missedLessons
                    }
                    return $streak;
                }
                // don't count today's lesson in the missed lessons
                $streak->missedLessons -= $streak->lessonAdded ? 1 : 0;
                return $streak;
            } elseif (!$hasUserCompletedALesson || $lessonsCompleted > 0) {
                // user has either completed their lesson for the day, or hasn't completed any lessons.
                // Either way we ignore modifying streak data in this case
            } elseif ($streak->totalStreakSavers > 0) {
                // remove a streak saver if available
                $streak->streakSaverUsed = true;
                $streak->totalStreakSavers--;
            } else {
                // oh noo!! we broke the streak
                $streak->current = 0;
            }
        }


        // Part 2.9 - User has not started, return an empty streak with missed lessons
        if (is_null($lastCompletedDay)) {
            $emptyStreak = new StreakData(false, $endDate->copy());
            $emptyStreak->missedLessons = $currentCompletableLessons;
            $emptyStreak->totalCompletableLessons = $currentCompletableLessons;
            return $emptyStreak;
        }

        // Part 5 - Future situations
        while (self::isAPastDay($streak->day, $endDate)) {
            if ($streak->totalStreakSavers == 0) {
                // Set the streak value to the 0 and the final day
                $brokenStreak = new StreakData(false, $streak->day->copy()->addDay());
                $brokenStreak->day = $endDate->copy();
                $brokenStreak->missedLessons = $currentCompletableLessons - $currentCompletedLessons;
                return $brokenStreak;
            } else {
                $streak = StreakData::getDecrementingStreakForNextDay($streak);
            }
        }
        return $streak;
    }


    /**
     * @param array{
     *      StreakData
     *  } $streaks
     * @return int
     */
    private function calculateMaxStreaks(array &$streaks): int
    {
        // Part 6 - Calculate maximum streak by iterating through all data
        $maxStreak = 0;
        /** @var StreakData $streak */
        foreach ($streaks as $streak) {
            $maxStreak = max($maxStreak, $streak->current);
            $streak->best = $maxStreak;
        }
        return $maxStreak;
    }

    private static function keyFromDate(Carbon $date)
    {
        $date = $date->startOfDay();
        return $date->toDateString();
    }

    private static function isAPastDay(Carbon $date1, Carbon $date2)
    {
        return $date1->lessThan($date2) && !$date1->isSameDay($date2);
    }

}
