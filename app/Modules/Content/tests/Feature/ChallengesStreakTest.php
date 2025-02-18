<?php

namespace Modules\Content\tests\Feature;

use App\Modules\Content\DTOs\ChallengeUserProgressLessonDatum;
use App\Modules\Content\DTOs\ChallengeUserProgressLessonDatumCollection;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Services\ChallengesStreakService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ChallengesStreakTest extends TestCase
{
    private const int D1 = 1;
    private const int D2 = 2;
    private const int D3 = 3;
    private const int D4 = 4;
    private const int D5 = 5;
    private const int D6 = 8;
    private const int D7 = 9;
    private const int D8 = 10;
    private const int D9 = 11;
    private const int D10 = 12;
    private const int D11 = 15;
    private const int D12 = 16;
    private const int D13 = 17;
    private const int D14 = 18;
    private const int D15 = 19;
    private const int D16 = 22;
    private const int D17 = 23;
    private const int D18 = 24;
    private const int D19 = 25;
    private const int D20 = 26;

    private ChallengesStreakService $challengesStreakService;
    /**
     * @var array|ExpectedDayData[]
     */
    private array $leadingDaysBeforeCurriculum;
    private ChallengeUserProgressLessonDatumCollection $collection;

    public function setUp(): void
    {
        parent::setUp();
        $this->challengesStreakService = app()->make(ChallengesStreakService::class);
        $this->collection = $this->buildLessonsMetaDetails();
        $this->leadingDaysBeforeCurriculum = $this->buildLeadingDaysBeforeCurriculum();
    }

    public function test_completion_of_lesson_during_today(): void
    {
        $firstCurriculumDay = end($this->leadingDaysBeforeCurriculum)->day->copy()->addDay();

        $streak = $this->challengesStreakService->generateStreaks($this->collection, $firstCurriculumDay->copy(), 1);
        $this->assertEquals(0, $streak->current, 'Expected Streak');
        $this->assertEquals(1, $streak->totalStreakSavers, 'Expected Total StreakSavers');
        $this->assertEquals(0, $streak->mileStonesAdded, 'Expected milestones added');
        $this->assertEquals(0, $streak->streakSaverUsed, 'Expected streak savers used');
        $this->assertEquals(0, $streak->missedLessons, "Expected missed lessons");
        $this->assertEquals(0, $streak->best, "Expected max streak");

        $this->collection[1]->completedAt = $firstCurriculumDay->copy();
        $this->collection[1]->completed = true;

        $streak = $this->challengesStreakService->generateStreaks($this->collection, $firstCurriculumDay->copy(), 1);
        $this->assertEquals(1, $streak->current, 'Expected Streak');
        $this->assertEquals(1, $streak->totalStreakSavers, 'Expected Total StreakSavers');
        $this->assertEquals(0, $streak->mileStonesAdded, 'Expected milestones added');
        $this->assertEquals(0, $streak->streakSaverUsed, 'Expected streak savers used');
        $this->assertEquals(0, $streak->missedLessons, "Expected missed lessons");
        $this->assertEquals(1, $streak->best, "Expected max streak");


        $fourthDay = $firstCurriculumDay->copy()->addDays(4);
        $streak = $this->challengesStreakService->generateStreaks($this->collection, $fourthDay->copy(), 1);
        $this->assertEquals(0, $streak->current, 'Expected Streak');
        $this->assertEquals(0, $streak->totalStreakSavers, 'Expected Total StreakSavers');
        $this->assertEquals(0, $streak->mileStonesAdded, 'Expected milestones added');
        $this->assertEquals(0, $streak->streakSaverUsed, 'Expected streak savers used');
        $this->assertEquals(3, $streak->missedLessons, "Expected missed lessons");
        $this->assertEquals(1, $streak->best, "Expected max streak");

        for ($i = 2; $i <= 5; $i++) {
            // Sequentially complete each lesson.
            // Streak should go up, missed lessons down
            // Milestones added on lesson 5
            $this->collection[$i]->completedAt = $fourthDay->copy();
            $this->collection[$i]->completed = true;

            $streak = $this->challengesStreakService->generateStreaks($this->collection, $fourthDay->copy(), 1);
            $this->assertEquals($i - 1, $streak->current, 'Expected Streak');
            $this->assertEquals($i == 5 ? 1 : 0, $streak->totalStreakSavers, 'Expected Total StreakSavers');
            $this->assertEquals($i == 5 ? 1 : 0, $streak->mileStonesAdded, 'Expected milestones added');
            $this->assertEquals(0, $streak->streakSaverUsed, 'Expected streak savers used');
            $this->assertEquals(5 - $i, $streak->missedLessons, "Expected missed lessons");
            $this->assertEquals($i - 1, $streak->best, "Expected max streak");
        }
    }

    public function test_completing_a_milestone_day_grants_milestone(): void
    {
        $rollingDay = end($this->leadingDaysBeforeCurriculum)->day->copy();
        $dayIndexToLessonsCompletedMap = [
            ... $this->leadingDaysBeforeCurriculum,
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D1], 1, 1, 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D2], 2, 1, 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D3], 3, 1, 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D4], 4, 1, 4),
        ];
        $metaData = $this->mapCompletedLessonsToMetaData($dayIndexToLessonsCompletedMap, $this->collection);

        $day4 = end($dayIndexToLessonsCompletedMap)->day->copy();

        $streak = $this->challengesStreakService->generateStreaks($metaData, $day4->copy()->addDay(), 1);
        $this->assertEquals(4, $streak->current, 'Expected Streak');
        $this->assertEquals(1, $streak->totalStreakSavers, 'Expected Total StreakSavers');
        $this->assertEquals(0, $streak->mileStonesAdded, 'Expected milestones added');
        $this->assertEquals(0, $streak->streakSaverUsed, 'Expected streak savers used');
        $this->assertEquals(0, $streak->missedLessons, "Expected missed lessons");
        $this->assertEquals(4, $streak->best, "Expected max streak");

        // metaData is offset 7 days of from the Day values
        $metaData[self::D5 + 7]->completed = true;
        $metaData[self::D5 + 7]->completedAt = $day4->copy()->addDay();

        $streak = $this->challengesStreakService->generateStreaks($metaData, $day4->copy()->addDay(), 1);
        $this->assertEquals(5, $streak->current, 'Expected Streak');
        $this->assertEquals(2, $streak->totalStreakSavers, 'Expected Total StreakSavers');
        $this->assertEquals(1, $streak->mileStonesAdded, 'Expected milestones added');
        $this->assertEquals(0, $streak->streakSaverUsed, 'Expected streak savers used');
        $this->assertEquals(0, $streak->missedLessons, "Expected missed lessons");
        $this->assertEquals(5, $streak->best, "Expected max streak");
    }

    public function test_not_starting_a_lesson_doesnt_consume_streak_saver(): void
    {
        // This test is best run by debugging to make sure the shortcut code works
        $firstDay = $this->collection->first()->unlockDate->copy();
        $rollingDay = end($this->leadingDaysBeforeCurriculum)->day->copy();
        $dayIndexToLessonsCompletedMap = [
            ... $this->leadingDaysBeforeCurriculum,
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D1], 1, 1, 1, 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D2], 2, 1, 2, 3), //bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 2, 1, 2, 3), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D3], 3, 0, 3, 3, streakSaverUsedYesterday: true),
        ];

        $metaData = $this->mapCompletedLessonsToMetaData($dayIndexToLessonsCompletedMap, $this->collection);
        $this->compareMetaDataToExpectedData($metaData, $dayIndexToLessonsCompletedMap, $firstDay->startOfDay());
    }

    public function test_many_days_after_last_completion(): void
    {
        // This test is best run by debugging to make sure the shortcut code works
        // ChallengeStreakService->
        $firstDay = $this->collection->first()->unlockDate->copy();
        $rollingDay = end($this->leadingDaysBeforeCurriculum)->day->copy();
        $dayIndexToLessonsCompletedMap = [
            ... $this->leadingDaysBeforeCurriculum,
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D1], 1, 1, 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 1, 1, 1),
            new ExpectedDayData(
                $rollingDay->addDay()->copy(),
                [],
                1,
                0,
                1,
                streakSaverUsedYesterday: true,
                missedLessons: 1
            ),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 4), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 4), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 4),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 5),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 6),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 7),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 8),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 9), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 9), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 9),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 10),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 11),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 12),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 13),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 14), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 14), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 14),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 15),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 16),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 17),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 18),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 19), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 19), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 19),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 19),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, missedLessons: 19),
        ];

        $metaData = $this->mapCompletedLessonsToMetaData($dayIndexToLessonsCompletedMap, $this->collection);

        $this->compareMetaDataToExpectedData($metaData, $dayIndexToLessonsCompletedMap, $firstDay->startOfDay());
    }

    // Tests below are generated run through the entire challenge and verify the expected streaks/milestones/streaksavers
    // are shown correctly. The expected values are DURING that day. So loss of streak and consumption of SS are not shown until the next day
    // This means that streaks and streak savers are propagated one day forward as they have not yet been consumed.
    // The $expectedStreakSaverUsedYesterday is used as we must display a different icon if the user consumed a streak saver the previous day
    public function test_generate_streaks_for_perfect_case(): void
    {
        $firstDay = $this->collection->first()->unlockDate->copy();
        $rollingDay = end($this->leadingDaysBeforeCurriculum)->day->copy();
        $dayIndexToLessonsCompletedMap = [
            ... $this->leadingDaysBeforeCurriculum,
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D1], 1, 1, 1, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D2], 2, 1, 2, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D3], 3, 1, 3, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D4], 4, 1, 4, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D5], 5, 2, 5, 0, milestonesAdded: 1),// Friday
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 5, 2, 5, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 5, 2, 5, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D6], 6, 2, 6, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D7], 7, 2, 7, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D8], 8, 2, 8, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D9], 9, 2, 9, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D10], 10, 3, 10, 0, milestonesAdded: 1), // Friday
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 10, 3, 10, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 10, 3, 10, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D11], 11, 3, 11, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D12], 12, 3, 12, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D13], 13, 3, 13, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D14], 14, 3, 14, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D15], 15, 4, 15, 0, milestonesAdded: 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D15 + 1], 15, 4, 15, 0), //bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D15 + 2], 15, 4, 15, 0), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D16], 16, 4, 16, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D17], 17, 4, 17, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D18], 18, 4, 18, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D19], 19, 4, 19, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D20], 20, 4, 20, 0),
        ];
        $metaData = $this->mapCompletedLessonsToMetaData($dayIndexToLessonsCompletedMap, $this->collection);

        $this->compareMetaDataToExpectedData($metaData, $dayIndexToLessonsCompletedMap, $firstDay->startOfDay());
    }

    public function test_test_case_2_break_first_streaks_use_remaining_to_save_streak(): void
    {
        $firstDay = $this->collection->first()->unlockDate->copy();
        $rollingDay = end($this->leadingDaysBeforeCurriculum)->day->copy();
        $dayIndexToLessonsCompletedMap = [
            ... $this->leadingDaysBeforeCurriculum,
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D1], 1, 1, 1, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D2], 2, 1, 2, 0),
            // Streak saver consumed on this day, but recorded on the following day. See note above
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 2, 1, 2, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D3], 3, 0, 3, 1, streakSaverUsedYesterday: true),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D4], 4, 0, 4, 1), // Friday
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 4, 0, 4, 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 4, 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D5, self::D6], 2, 1, 4, 0, milestonesAdded: 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D7], 3, 1, 4, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D8], 4, 1, 4, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D9], 5, 1, 5, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D10], 6, 2, 6, 0, milestonesAdded: 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 6, 2, 6, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 6, 2, 6, 0),
            // Streak saver consumed on this day, but recorded on the following day. See note above
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 6, 2, 6, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 6, 1, 6, 1, streakSaverUsedYesterday: true),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D11], 7, 0, 7, 2, streakSaverUsedYesterday: true),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D12], 8, 0, 8, 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D13], 9, 0, 9, 2),
            //challenge technically ends
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D14], 10, 0, 10, 1), //bonus days playing catchup
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D15], 11, 1, 11, 0, milestonesAdded: 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D16], 12, 1, 12, 0),
            // Streak saver consumed on this day, but recorded on the following day. See note above
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 12, 1, 12, 0),
            new ExpectedDayData(
                $rollingDay->addDay()->copy(),
                [self::D17, self::D18],
                14,
                0,
                14,
                0,
                streakSaverUsedYesterday: true
            ),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D19], 15, 0, 15, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D20], 16, 0, 16, 0),
        ];
        $metaData = $this->mapCompletedLessonsToMetaData($dayIndexToLessonsCompletedMap, $this->collection);

        $this->compareMetaDataToExpectedData($metaData, $dayIndexToLessonsCompletedMap, $firstDay->startOfDay());
    }

    public function test_test_case_3_break_first_streak_cram_finish(): void
    {
        $firstDay = $this->collection->first()->unlockDate->copy();
        $rollingDay = end($this->leadingDaysBeforeCurriculum)->day->copy();
        $dayIndexToLessonsCompletedMap = [
            ... $this->leadingDaysBeforeCurriculum,
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D1], 1, 1, 1, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D2], 2, 1, 2, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 2, 1, 2, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D3], 3, 0, 3, 1, streakSaverUsedYesterday: true),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D4], 4, 0, 4, 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 4, 0, 4, 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 4, 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D5, self::D6], 2, 1, 4, 0, milestonesAdded: 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D7], 3, 1, 4, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D8], 4, 1, 4, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 4, 1, 4, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D9], 5, 0, 5, 1, streakSaverUsedYesterday: true),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D10], 6, 1, 6, 0, milestonesAdded: 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 6, 1, 6, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D11], 7, 1, 7, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D12], 8, 1, 8, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D13], 9, 1, 9, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 9, 1, 9, 0),
            new ExpectedDayData(
                $rollingDay->addDay()->copy(),
                [self::D14],
                10,
                0,
                10,
                1,
                streakSaverUsedYesterday: true
            ),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D15], 11, 1, 11, 0, milestonesAdded: 1), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D15 + 1, self::D15 + 2], 11, 1, 11, 0), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D16], 12, 1, 12, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 12, 1, 12, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 12, 0, 12, 1, streakSaverUsedYesterday: true),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D17, self::D18, self::D19], 3, 0, 12, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D20], 4, 0, 12, 0),
        ];
        $metaData = $this->mapCompletedLessonsToMetaData($dayIndexToLessonsCompletedMap, $this->collection);

        $this->compareMetaDataToExpectedData($metaData, $dayIndexToLessonsCompletedMap, $firstDay->startOfDay());
    }

    public function test_test_case_4_break_3_times_never_finish(): void
    {
        $firstDay = $this->collection->first()->unlockDate->copy();
        $rollingDay = end($this->leadingDaysBeforeCurriculum)->day->copy();
        $dayIndexToLessonsCompletedMap = [
            ... $this->leadingDaysBeforeCurriculum,
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D1], 1, 1, 1, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 1, 1, 1, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 1, 0, 1, 1, streakSaverUsedYesterday: true),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 4), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D2, self::D3], 2, 0, 2, 2), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 2, 0, 2, 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D4], 1, 0, 2, 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D5], 2, 1, 2, 3, milestonesAdded: 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D6], 3, 1, 3, 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D7], 4, 1, 4, 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 4, 1, 4, 3), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D8], 5, 0, 5, 2, streakSaverUsedYesterday: true), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D9], 6, 0, 6, 2, ),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D10], 7, 1, 7, 2, milestonesAdded: 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D11], 8, 1, 8, 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 8, 1, 8, 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 8, 0, 8, 3, streakSaverUsedYesterday: true),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 4), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 4), // bonus day
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 4),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 5),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 6),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 7),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 8),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 9),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 9),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 8, 9),
        ];
        $metaData = $this->mapCompletedLessonsToMetaData($dayIndexToLessonsCompletedMap, $this->collection);

        $this->compareMetaDataToExpectedData($metaData, $dayIndexToLessonsCompletedMap, $firstDay->startOfDay());
    }

    public function test_test_case_5_breaks_streaks_then_completes_on_final_day(): void
    {
        $firstDay = $this->collection->first()->unlockDate->copy();
        $rollingDay = end($this->leadingDaysBeforeCurriculum)->day->copy();
        $dayIndexToLessonsCompletedMap = [
            ... $this->leadingDaysBeforeCurriculum,
            new ExpectedDayData($rollingDay->addDay()->copy(), [self::D1], 1, 1, 1, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 1, 1, 1, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 1, 0, 1, 1, streakSaverUsedYesterday: true),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 4),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 4),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 4),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 5),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 6),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 7),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 8),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 9),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 9),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 9),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 10),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 11),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 12),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 13),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 14),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 14),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 14),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 15),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 16),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 17),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 0, 1, 18),
            new ExpectedDayData($rollingDay->addDay()->copy(), [
                self::D2,
                self::D3,
                self::D4,
                self::D5,
                self::D6,
                self::D7,
                self::D8,
                self::D9,
                self::D10,
                self::D11,
                self::D12,
                self::D13,
                self::D14,
                self::D15,
                self::D16,
                self::D17,
                self::D18,
                self::D19,
                self::D20,
            ], 19, 3, 19, 0, milestonesAdded: 3),
        ];

        $metaData = $this->mapCompletedLessonsToMetaData($dayIndexToLessonsCompletedMap, $this->collection);

        $this->compareMetaDataToExpectedData($metaData, $dayIndexToLessonsCompletedMap, $firstDay->startOfDay());
    }

    public function test_test_case_6_completes_all_lessons_on_final_day(): void
    {
        $firstDay = $this->collection->first()->unlockDate->copy();
        $rollingDay = end($this->leadingDaysBeforeCurriculum)->day->copy();
        $dayIndexToLessonsCompletedMap = [
            ... $this->leadingDaysBeforeCurriculum,
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 0),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 1),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 2),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 3),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 4),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 5),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 5),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 5),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 6),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 7),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 8),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 9),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 10),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 10),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 10),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 11),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 12),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 13),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 14),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 15),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 15),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 15),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 16),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 17),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 18),
            new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 19),
            new ExpectedDayData($rollingDay->addDay()->copy(), [
                self::D1,
                self::D2,
                self::D3,
                self::D4,
                self::D5,
                self::D6,
                self::D7,
                self::D8,
                self::D9,
                self::D10,
                self::D11,
                self::D12,
                self::D13,
                self::D14,
                self::D15,
                self::D16,
                self::D17,
                self::D18,
                self::D19,
                self::D20,
            ], 20, 4, 20, 0, milestonesAdded: 3),
        ];

        $metaData = $this->mapCompletedLessonsToMetaData($dayIndexToLessonsCompletedMap, $this->collection);

        $this->compareMetaDataToExpectedData($metaData, $dayIndexToLessonsCompletedMap, $firstDay->startOfDay());
    }

    private function buildLessonsMetaDetails(): ChallengeUserProgressLessonDatumCollection
    {
        $path = Storage::disk("content_test_resources")->path('challenge.json');
        $challengeJson = json_decode(file_get_contents($path), true);
        $firstLesson = $challengeJson['lessons'][0];
        $courseStart = Carbon::parse('February 06 2025');
        $rollingLessonDay = Carbon::parse('February 13 2025');
        $firstLessonDay = $rollingLessonDay->copy();

        $firstLesson['published_on'] = $courseStart->toISOString();
        $firstLesson['is_bonus_content_for_challenge'] = true;
        $firstLesson['is_always_unlocked_for_challenge'] = true;
        $firstLesson['is_milestone'] = false;
        $firstLesson['railcontent_id'] = 0;
        $firstLesson['id'] = 0;

        //1 kickoff lesson
        // 20 lessons
        // 6 bonus
        $lessons = [$firstLesson];
        for ($i = 1; $i < 27; $i++) {
            $nextLesson = $firstLesson;
            $nextLesson['is_bonus_content_for_challenge'] = false;
            $nextLesson['is_always_unlocked_for_challenge'] = in_array($i, [6, 7, 13, 14, 20, 21]);
            $nextLesson['is_milestone'] = in_array($i, [5, 12, 19]);
            $nextLesson['published_on'] = $rollingLessonDay->toISOString();
            $nextLesson['id'] = $i;
            $nextLesson['railcontent_id'] = $i;
            $lessons[] = $nextLesson;
            $rollingLessonDay->addDay();
        }
        $challengeJson['lessons'] = $lessons;
        $challengeJson['is_solo'] = false;
        $challengeJson['published_on'] = $courseStart;
        $metadata = ChallengeUserProgress::defineLessonsMetaData($challengeJson, $courseStart);
        $collection = new ChallengeUserProgressLessonDatumCollection($metadata);
        return $collection;
    }

    /**
     * @return array {
     *     DayData
     * }
     */
    private function buildLeadingDaysBeforeCurriculum(): array
    {
        $rollingDay = $this->collection->first()->unlockDate->copy();
        $leadingDaysBeforeCurriculum = [new ExpectedDayData($rollingDay->copy(), [0], 0, 1, 0, 0)];
        // Feb 6 -> Feb 12; 7 Days
        for ($i = 1; $i < 7; $i++) {
            $leadingDaysBeforeCurriculum[] = new ExpectedDayData($rollingDay->addDay()->copy(), [], 0, 1, 0, 0);
        }
        return $leadingDaysBeforeCurriculum;
    }

    /**
     * @param array{
     *     ExpectedDayData
     * } $dayIndexToLessonsCompletedMap
     * @param ChallengeUserProgressLessonDatumCollection $collection
     * @return ChallengeUserProgressLessonDatumCollection
     */
    private function mapCompletedLessonsToMetaData(
        array $dayIndexToLessonsCompletedMap,
        ChallengeUserProgressLessonDatumCollection $collection
    ) {
        /** @var ChallengeUserProgressLessonDatum $lessonDatum2 */

        foreach ($dayIndexToLessonsCompletedMap as $dayIndex => $dayDatum) {
            foreach ($dayDatum->lessonsCompleted as $completedIndex) {
                $lessonDatum = $collection->first(function ($e) use ($completedIndex) {
                    return $completedIndex == $e->contentId;
                });
                if ($lessonDatum) {
                    $lessonDatum->completedAt = $dayDatum->day->copy();
                    $lessonDatum->completed = true;
                    $lessonDatum->secondsPracticed = 60;
                }
            }
        }
        return $collection;
    }

    /**
     * @param ChallengeUserProgressLessonDatumCollection $collection
     * @param array{
     *     ExpectedDayData
     * } $dayData
     * @param Carbon $startDay
     * @return void
     */
    private function compareMetaDataToExpectedData(
        ChallengeUserProgressLessonDatumCollection $collection,
        array $dayData,
        Carbon $startDay
    ) {
        $rollingDay = $startDay->copy();
        $rollingDay->addSecond();
        /** @var @var DayData $dayDatum */
        foreach ($dayData as $index => $dayDatum) {
            $this->resultsToDump[] = $dayDatum;
            $streak = $this->challengesStreakService->generateStreaks($collection, $rollingDay, 1);
            $this->assertEquals($dayDatum->current, $streak->current, 'Expected Streak');
            $this->assertEquals(
                $dayDatum->totalStreakSavers,
                $streak->totalStreakSavers,
                "Expected Total StreakSavers on {$index} at {$dayDatum->day->toDateString()}"
            );
            $this->assertEquals(
                $dayDatum->milestonesAdded,
                $streak->mileStonesAdded,
                "Expected milestones added on {$index} at {$dayDatum->day->toDateString()}"
            );
            $this->assertEquals(
                $dayDatum->streakSaverUsed,
                $streak->streakSaverUsed,
                "Expected streak savers used on {$index} at {$dayDatum->day->toDateString()}"
            );
            $this->assertEquals(
                $dayDatum->streakSaverUsedYesterday ? 1 : 0,
                $streak->showActiveStreakSaver,
                "Expected streak saver used yesterday on {$index} at {$dayDatum->day->toDateString()}"
            );
            $this->assertEquals(
                $dayDatum->missedLessons,
                $streak->missedLessons,
                "Expected missed lessons on {$index} at {$dayDatum->day->toDateString()}"
            );
            $this->assertEquals(
                $dayDatum->best,
                $streak->best,
                "Expected max streak on {$index} at {$dayDatum->day->toDateString()}"
            );
            $rollingDay->addDay();
        }
    }
}

class ExpectedDayData
{
    public function __construct(
        public Carbon $day,
        public array $lessonsCompleted,
        public int $current,
        public int $totalStreakSavers,
        public int $best,
        public int $missedLessons = 0,
        public int $milestonesAdded = 0,
        public bool $streakSaverUsed = false,
        public bool $streakSaverUsedYesterday = false,
    ) {
    }
}
