<?php

namespace App\Modules\Content\tests\Feature;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Services\ChallengesService;
use App\Modules\RailTracker\Services\MediaPlaybackService;
use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Services\UserTimezoneService;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use Modules\Ecommerce\Jobs\Shopify\OrderUpdateChallengesEnrollment;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class ChallengesTest extends TestCase
{
    private User $user;
    private ChallengesService $challengesService;

    private $challengeId = 402199;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_scope_brand() : void
    {
        $userId = user()->id;
        $drumeoContent = Content::factory()->create(['brand' => 'drumeo']);
        $singeoContent = Content::factory()->create(['brand' => 'singeo']);
        ChallengeUserProgress::updateOrCreate([
            'content_id' => $singeoContent->id,
            'user_id' => $userId,
        ],
        );
        ChallengeUserProgress::updateOrCreate([
            'content_id' => $drumeoContent->id,
            'user_id' => $userId,
        ],
        );
        $drumeoTestContent = ChallengeUserProgress::query()->brand('drumeo')->get();
        $this->assertCount(1, $drumeoTestContent);
        $singeoTestContent = ChallengeUserProgress::query()->brand('singeo')->get();
        $this->assertCount(1, $singeoTestContent);
    }

    public function test_scope_community_and_solo() : void
    {
        $userId = user()->id;
        $content1 = Content::factory()->create();
        $content2 = Content::factory()->create();
        ChallengeUserProgress::updateOrCreate([
            'content_id' => $content1->id,
            'user_id' => $userId,
        ], ['is_solo' => false]
        );
        ChallengeUserProgress::updateOrCreate([
            'content_id' => $content2->id,
            'user_id' => $userId,
        ], ['is_solo' => true]
        );
        $solo = ChallengeUserProgress::query()->solo()->get();
        $this->assertCount(1, $solo);
        $community = ChallengeUserProgress::query()->community()->get();
        $this->assertCount(1, $community);
    }

    public function test_scope_completed() : void
    {
        $userId = user()->id;
        $content1 = Content::factory()->create();
        $content2 = Content::factory()->create();
        ChallengeUserProgress::updateOrCreate([
            'content_id' => $content1->id,
            'user_id' => $userId,
        ], ['last_completed_date' => Carbon::now()->toISOString()]
        );
        ChallengeUserProgress::updateOrCreate([
            'content_id' => $content2->id,
            'user_id' => $userId,
        ],
        );
        $completed = ChallengeUserProgress::query()->completed()->get();
        $this->assertCount(1, $completed);
    }

    public function test_scope_hide_badge() : void
    {
        $userId = user()->id;
        $content1 = Content::factory()->create();
        $content2 = Content::factory()->create();
        ChallengeUserProgress::updateOrCreate([
            'content_id' => $content1->id,
            'user_id' => $userId,
        ], ['hide_completed_banner' => true]
        );
        ChallengeUserProgress::updateOrCreate([
            'content_id' => $content2->id,
            'user_id' => $userId,
        ],
        );
        $showBadges = ChallengeUserProgress::query()->showBadgeInBanner()->get();
        $this->assertCount(1, $showBadges);
    }

    public function test_scope_active() : void
    {
        $userId = user()->id;
        $contentActiveAndPast = Content::factory()->create();
        $contentActiveAndNearFuture = Content::factory()->create();
        $contentInactiveAndPast = Content::factory()->create();
        $contentActiveAndFarFuture = Content::factory()->create();

        ChallengeUserProgress::updateOrCreate([
            'content_id' => $contentActiveAndPast->id,
            'user_id' => $userId,
        ], ['is_active' => true,
                'start_date' => Carbon::now()->subHours(10)->toISOString()]
        );
        ChallengeUserProgress::updateOrCreate([
            'content_id' => $contentActiveAndNearFuture->id,
            'user_id' => $userId,
        ], ['is_active' => true,
            'start_date' => Carbon::now()->addHours(10)->toISOString()]
        );

        ChallengeUserProgress::updateOrCreate([
            'content_id' => $contentInactiveAndPast->id,
            'user_id' => $userId,
        ], ['is_active' => false,
            'start_date' => Carbon::now()->subHours(10)->toISOString()]
        );

        ChallengeUserProgress::updateOrCreate([
            'content_id' => $contentActiveAndFarFuture->id,
            'user_id' => $userId,
        ], [
            'is_active' => true,
                'start_date' => Carbon::now()->addDays(2)->toISOString()]
        );
        $active = ChallengeUserProgress::query()->currentlyActive()->get();
        $this->assertCount(3, $active);
    }

    public function test_enroll(): void
    {
        $userId = user()->id;
        $this->mockChallengeData();
        $this->assertDatabaseMissing(
            ChallengeUserProgress::class,
            [
                'content_id' => $this->challengeId,
                'user_id' => $userId
            ]
        );
        $challengesService = app()->make(ChallengesService::class);
        $challengesService->startChallenge($this->challengeId, $userId);
        $this->assertDatabaseHas(
            ChallengeUserProgress::class,
            [
                'content_id' => $this->challengeId,
                'user_id' => $userId
            ]
        );
    }

    public function test_active_challenges_endpoint(): void
    {
        $this->markTestSkipped('this test fails because the prep_challenge_index returns all of the challenges, not just the ones requested.');

//        ChallengeUserProgress::truncate();
//        $userId = user()->id;
//        $this->prep_challenge_index(0);
//        $challengesService = app()->make(ChallengesService::class);
//
//        $response = $this->getJson(route('challenges.user_active_challenges', ['brand' => 'drumeo']));
//        $response->assertOk();
//        $responseData = $response->json();
//
//
//        $this->assertEmpty($responseData);
//
//        $challengesService->startChallenge(402199, $userId);
//        $this->prep_challenge_index(1);
//        $challengesService->startChallenge(402200, $userId);
//        $response = $this->getJson(route('challenges.user_active_challenges', ['brand' => 'drumeo']));
//        $response->assertOk();
//        $responseData = $response->json();
//
//        $this->assertCount(2, $responseData);
//
//        $this->assertTrue($this->getChallengeDataById($responseData, 402199)['is_user_enrolled']);
//        $this->assertTrue($this->getChallengeDataById($responseData, 402200)['is_user_enrolled']);
//
//        $challengesService->completeChallenge(402200, $userId);
//        $response = $this->getJson(route('challenges.user_active_challenges', ['brand' => 'drumeo']));
//        $response->assertOk();
//        $responseData = $response->json();
//
//        $this->assertCount(1, $responseData);
//        $this->assertTrue($this->getChallengeDataById($responseData, 402199)['is_user_enrolled']);
    }

    public function test_leave_clears_current_progress(): void
    {
        $userId = user()->id;
        $this->mockChallengeData();
        $challengesService = app()->make(ChallengesService::class);
        $this->assertDatabaseMissing(
            ChallengeUserProgress::class,
            [
                'content_id' => $this->challengeId,
                'user_id' => $userId
            ]
        );
        $challengesService->startChallenge($this->challengeId, $userId);
        $this->assertDatabaseHas(
            ChallengeUserProgress::class,
            [
                'content_id' => $this->challengeId,
                'user_id' => $userId,
                'is_active' => true,
            ]
        );
        $progress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
        $progress->leaveChallenge();
        $this->assertDatabaseHas(
            ChallengeUserProgress::class,
            [
                'content_id' => $this->challengeId,
                'user_id' => $userId,
                'is_active' => false,
            ]
        );
    }

    public function test_set_start_date(): void
    {
        $tomorrow = Carbon::now()->startOfDay()->addDay();
        $uberMorgen = Carbon::now()->startOfDay()->addDays(2);

        $userId = user()->id;
        $this->mockChallengeData();
        $challengesService = app()->make(ChallengesService::class);
        $this->assertDatabaseMissing(
            ChallengeUserProgress::class,
            [
                'content_id' => $this->challengeId,
                'user_id' => $userId
            ]
        );
        $challengesService->startChallenge($this->challengeId, $userId, $tomorrow->toISOString());
        $this->assertDatabaseHas(
            ChallengeUserProgress::class,
            [
                'content_id' => $this->challengeId,
                'user_id' => $userId,
                'is_active' => true,
            ]
        );
        $progress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
        $this->assertEquals($progress->start_date->toISOString(), $tomorrow->toISOString());
        $lessondata = $progress->lessons_meta_data;
        $this->assertEquals($lessondata[0]['unlock_date'], $tomorrow->toISOString());
        $this->assertEquals($lessondata[1]['unlock_date'], $uberMorgen->toISOString());
    }

    public function test_get_enrolled_users(): void
    {
        $validUser1 = User::factory()->create([
            'profile_picture_url' => 'non null',
            'display_name' => 'valid',
            'email' => 'real@gmail.com',
        ]);
        $validUser2 = User::factory()->create([
            'profile_picture_url' => 'non null',
            'display_name' => 'valid',
            'email' => 'real2@gmail.com',
        ]);
        $invalidProfilePictureUser = User::factory()->create([
            'profile_picture_url' => null,
            'display_name' => 'badurl',
            'email' => 'real3@gmail.com',
        ]);
        $invalidEmailUser = User::factory()->create([
            'display_name' => 'bademail',
            'email' => ' invalid@musora.com',
        ]);
        $invalidDisplayNameUser = User::factory()->create([
            'display_name' => 'very long string longer than we want to display',
            'email' => 'real5@gmail.com',
        ]);
        $this->mockChallengeData();
        $challengesService = app()->make(ChallengesService::class);
        $challengesService->startChallenge($this->challengeId, $validUser1->id);
        $challengesService->startChallenge($this->challengeId, $validUser2->id);
        $challengesService->startChallenge($this->challengeId, $invalidProfilePictureUser->id);
        $challengesService->startChallenge($this->challengeId, $invalidEmailUser->id);
        $challengesService->startChallenge($this->challengeId, $invalidDisplayNameUser->id);
        $this->assertDatabaseHas(ChallengeUserProgress::class, [
            'user_id' => $validUser1->id,
            'content_id' => $this->challengeId,
            'is_active' => true,
        ]);
        $this->assertDatabaseHas(ChallengeUserProgress::class, [
            'user_id' => $invalidDisplayNameUser->id,
            'content_id' => $this->challengeId,
            'is_active' => true,
        ]);
        $userData = $challengesService->getEnrolledUsers($this->challengeId, 10);
        $this->assertEquals(5, $userData['total']);
        $this->assertCount(2, $userData['users']);
        $this->assertEquals('valid', $userData['users'][0]['display_name']);
        $this->assertEquals('valid', $userData['users'][1]['display_name']);
    }

    public function test_enrolled_lesson_data(): void
    {
        $userId = user()->id;
        $this->mockChallengeData();
        $challengesService = app()->make(ChallengesService::class);
        $challengesService->startChallenge($this->challengeId, $userId);
        $result = $challengesService->getCurrentLessonData($this->challengeId, $userId, false);
        $this->assertTrue(boolval($result['user_data']['is_active']));
    }

    public function test_not_enrolled_lesson_data(): void
    {
        $userId = user()->id + 1;
        $this->mockChallengeData();
        $challengesService = app()->make(ChallengesService::class);
        $this->assertDatabaseMissing(
            ChallengeUserProgress::class,
            [
                'content_id' => $this->challengeId,
                'user_id' => $userId
            ]
        );
        $result = $challengesService->getCurrentLessonData($this->challengeId, $userId, false);
        $this->assertFalse(boolval($result['user_data']['is_active']));
    }

    public function test_milestones_for_length_10(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-10-lessons.json', 'challenge-child-10-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: Carbon::now()->startOfDay()->toISOString()
        );

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lesson_meta_datum['content_id'],
                $userId
            );
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 10) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonNumber == 5) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals(
                    "You're on a {$lessonNumber} Day Streak!",
                    $lessonCompletedProgress['motivational_title']
                );
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "Return tomorrow to maintain your streak!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNull($lessonCompletedProgress['lottie_url']);
            }
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();
            $this->assertEquals($lessonNumber, $currentStreakData['current']);
            $this->assertEquals($lessonNumber, $currentStreakData['best']);
            $this->assertEquals(0, $currentStreakData['missed']);
            $this->travel(1)->days();
        }
    }

    public function test_milestones_for_length_10_with_unlocks_and_bonus(): void
    {
        $userId = user()->id;

        // this data file has 14 total lessons, 10 curriculum
        // always unlocked = [0,1];
        // bonus content = [8,9];
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons-with-unlock-and-bonus.json',
            'challenge-child-10-lessons-with-unlock-and-bonus.json'
        );
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: Carbon::now()->startOfDay()->toISOString()
        );
        $completedLessons = 0;
        foreach ($userProgress->lessons_meta_data as $lesson_meta_datum) {
            $lessonIndex = $lesson_meta_datum['content_id'];
            $isCurriculumLesson = ChallengeUserProgress::isCurriculumMetadataLesson($lesson_meta_datum);
            if ($isCurriculumLesson) {
                // skip the unlocked contents
                $completedLessons += $lessonIndex == 1 ? 0 : 1;
            }

            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lessonIndex,
                $userId
            );

            if ($lessonIndex == 14) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonIndex == 7) {
                $this->assertEquals($completedLessons, $lessonCompletedProgress['milestone']);
                $this->assertEquals(
                    "You're on a {$completedLessons} Day Streak!",
                    $lessonCompletedProgress['motivational_title']
                );
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($isCurriculumLesson) {
                $this->assertNull($lessonCompletedProgress['milestone'] ?? null);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "Return tomorrow to maintain your streak!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertFalse($lessonCompletedProgress['show_modal']);
            }
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();

            $this->assertEquals($completedLessons, $currentStreakData['current']);
            $this->assertEquals($completedLessons, $currentStreakData['best']);

            $this->assertEquals(0, $currentStreakData['missed']);
            if (!$lesson_meta_datum['is_always_unlocked']) {
                $this->travel(1)->days();
            }
        }
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
        $this->assertFalse(boolval($userProgress->is_active));
        $this->assertEquals(10, $userProgress->completed_best_streak);
    }

    public function test_solo_challenge_all_rest_days_used_unlock_dates_not_shift_and_rest_day_count_is_accurate(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons.json',
            'challenge-child-10-lessons.json'
        );
        /**
         * @var $challengesService ChallengesService
         */
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $startDateCarbon = Carbon::parse("2023-12-28 12:00:00");

        // Start the challenge
        // Users get 1 free rest day when started if the challenge is 10 days or more
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId
        );

        $currentDay = $startDateCarbon->copy()->addHours(3);

        // Simulate completing lessons
        for ($currentLessonNumberToBeCompleted = 1; $currentLessonNumberToBeCompleted <= count($userProgress->lessons_meta_data); $currentLessonNumberToBeCompleted++) {
            Carbon::setTestNow($currentDay);

            $currentLessonMetaData = $userProgress->lessons_meta_data[$currentLessonNumberToBeCompleted - 1];

            // Complete the first day on start date (+1 to streak)
            if ($currentLessonNumberToBeCompleted == 1 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // They miss the second day, should use up a rest_dat and push the unlock days of all future lessons 1 day
            if ($currentLessonNumberToBeCompleted == 2 && $currentDay->isSameDay(Carbon::parse("2023-12-29"))) {
                $this->assertTrue(Carbon::parse($currentLessonMetaData['unlock_date'])->isSameDay($currentDay));

                // subtract the current lesson number since the following day they still need to complete this lesson
                $currentLessonNumberToBeCompleted--;

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // now the following day, on Dec 3rd, rest day is consumed and schedule does NOT shift
            // also, they complete the missing lesson and current lesson for today and get an additional streak of +2
            if ($currentLessonNumberToBeCompleted == 2 &&
                $currentDay->isSameDay(Carbon::parse("2023-12-30"))) {

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assert that the future lessons are not rescheduled unlike solo challenges
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[2 - 1]['unlock_date'])->toDateString(),
                    "2023-12-29"
                );
                // same for following days
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[3 - 1]['unlock_date'])->toDateString(),
                    "2023-12-30"
                );
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[10 - 1]['unlock_date'])->toDateString(),
                    "2024-01-06"
                );

                // Assert streak was not broken, but it shouldn't increase
                $this->assertEquals([
                    'best' => 1,
                    'current' => 1,
                    'missed' => 1,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);

                // complete the missing lesson (+1 streak since a rest day was used)
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[2 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 2,
                    'current' => 2,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);

                // complete the missing lesson (+1 streak since a rest day was used)
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[3 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 3,
                    'current' => 3,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);

                $currentLessonNumberToBeCompleted++;
            }

            if ($currentLessonNumberToBeCompleted == 4 &&
                $currentDay->isSameDay(Carbon::parse("2023-12-31"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    "2023-12-31"
                );

                $this->assertEquals([
                    'best' => 4,
                    'current' => 4,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);
            }

            // they complete the rest of the challenge on schedule
            if ($currentLessonNumberToBeCompleted >= 5 && $currentLessonNumberToBeCompleted <= 9) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => $currentLessonNumberToBeCompleted,
                    'current' => $currentLessonNumberToBeCompleted,
                    'missed' => 0,
                    'remaining_rest_days' => $currentLessonNumberToBeCompleted >= 5 ? 1 : 0, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            // They miss lesson 9, which should use up their last rest day
            if ($currentLessonNumberToBeCompleted == 10 &&
                $currentDay->isSameDay(Carbon::parse("2024-01-06"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    $currentDay->toDateString()
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals([
                    'best' => 10,
                    'current' => 10,
                    'missed' => 0,
                    'remaining_rest_days' => 2, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            $currentDay->addDay();
        }
    }

    public function test_solo_challenge_rest_days_used_days_after_unlock_and_rest_day_count_is_accurate(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons.json',
            'challenge-child-10-lessons.json'
        );
        /**
         * @var $challengesService ChallengesService
         */
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $startDateCarbon = Carbon::parse("2023-12-28 12:00:00");

        // Start the challenge
        // Users get 1 free rest day when started if the challenge is 10 days or more
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId
        );

        $currentDay = $startDateCarbon->copy()->addHours(3);

        // Simulate completing lessons
        for ($currentLessonNumberToBeCompleted = 1; $currentLessonNumberToBeCompleted <= count($userProgress->lessons_meta_data); $currentLessonNumberToBeCompleted++) {
            Carbon::setTestNow($currentDay);

            $currentLessonMetaData = $userProgress->lessons_meta_data[$currentLessonNumberToBeCompleted - 1];

            // Complete the first day on start date (+1 to streak)
            if ($currentLessonNumberToBeCompleted == 1 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // They miss the second day
            if ($currentLessonNumberToBeCompleted == 2 && $currentDay->isSameDay(Carbon::parse("2023-12-29"))) {
                $this->assertTrue(Carbon::parse($currentLessonMetaData['unlock_date'])->isSameDay($currentDay));

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // now the following day, on Dec 3rd they complete that days lesson but NOT the missed day
            if ($currentLessonNumberToBeCompleted == 3 && $currentDay->isSameDay(Carbon::parse("2023-12-30"))) {

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assert that the future lessons are not rescheduled unlike solo challenges
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[2 - 1]['unlock_date'])->toDateString(),
                    "2023-12-29"
                );
                // same for following days
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[3 - 1]['unlock_date'])->toDateString(),
                    "2023-12-30"
                );
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[10 - 1]['unlock_date'])->toDateString(),
                    "2024-01-06"
                );

                // Assert streak was not broken, but it shouldn't increase
                $this->assertEquals([
                    'best' => 1,
                    'current' => 1,
                    'missed' => 1,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);

                // complete todays lesson (+1 streak since they have rest day coverage)
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[3 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 2,
                    'current' => 2,
                    'missed' => 1,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 4 && $currentDay->isSameDay(Carbon::parse("2023-12-31"))) {

                // now they complete the missing lesson (+1 streak since a rest day was used)
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[2 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 3,
                    'current' => 3,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);

                // also complete todays lesson
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    "2023-12-31"
                );

                $this->assertEquals([
                    'best' => 4,
                    'current' => 4,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);
            }

            // they complete the rest of the challenge on schedule
            if ($currentLessonNumberToBeCompleted >= 5 && $currentLessonNumberToBeCompleted <= 9) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => $currentLessonNumberToBeCompleted,
                    'current' => $currentLessonNumberToBeCompleted,
                    'missed' => 0,
                    'remaining_rest_days' => $currentLessonNumberToBeCompleted >= 5 ? 1 : 0, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            // They miss lesson 9, which should use up their last rest day
            if ($currentLessonNumberToBeCompleted == 10 &&
                $currentDay->isSameDay(Carbon::parse("2024-01-06"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    $currentDay->toDateString()
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals([
                    'best' => 10,
                    'current' => 10,
                    'missed' => 0,
                    'remaining_rest_days' => 2, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            $currentDay->addDay();
        }
    }

    public function test_solo_challenge_streak_data_with_bonus_days_no_rest_days_used(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons-with-unlock-and-bonus.json',
            'challenge-child-10-lessons-with-unlock-and-bonus.json'
        );
        /**
         * @var $challengesService ChallengesService
         */
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $startDateCarbon = Carbon::parse("2023-12-28 12:00:00");

        // Start the challenge
        // Users get 1 free rest day when started if the challenge is 10 days or more
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId
        );

        $currentDay = $startDateCarbon->copy()->addHours(3);

        // Simulate completing lessons
        for ($currentLessonNumberToBeCompleted = 1; $currentLessonNumberToBeCompleted <= count($userProgress->lessons_meta_data); $currentLessonNumberToBeCompleted++) {
            Carbon::setTestNow($currentDay);

            $currentLessonMetaData = $userProgress->lessons_meta_data[$currentLessonNumberToBeCompleted - 1];

            // First day is a bonus lesson
            if ($currentLessonNumberToBeCompleted == 1 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(0, $currentStreakData['best']);
                $this->assertEquals(0, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);

                $currentDay->subDay();
            }

            // Second day is bonus that unlocks on the same day as 1
            if ($currentLessonNumberToBeCompleted == 2 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(0, $currentStreakData['best']);
                $this->assertEquals(0, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);

                $currentDay->subDay();
            }

            // first curriculum lesson is completed
            if ($currentLessonNumberToBeCompleted == 3 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[3 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 1,
                    'current' => 1,
                    'missed' => 0,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 4 && $currentDay->isSameDay(Carbon::parse("2023-12-29"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 2,
                    'current' => 2,
                    'missed' => 0,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 5 && $currentDay->isSameDay(Carbon::parse("2023-12-30"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 3,
                    'current' => 3,
                    'missed' => 0,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 6 && $currentDay->isSameDay(Carbon::parse("2023-12-31"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 4,
                    'current' => 4,
                    'missed' => 0,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 7 && $currentDay->isSameDay(Carbon::parse("2024-01-01"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 5,
                    'current' => 5,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            // bonus day, no streak
            if ($currentLessonNumberToBeCompleted == 8 && $currentDay->isSameDay(Carbon::parse("2024-01-02"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 5,
                    'current' => 5,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            // bonus day, no streak
            if ($currentLessonNumberToBeCompleted == 9 && $currentDay->isSameDay(Carbon::parse("2024-01-03"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 5,
                    'current' => 5,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 10 && $currentDay->isSameDay(Carbon::parse("2024-01-04"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 6,
                    'current' => 6,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 11 && $currentDay->isSameDay(Carbon::parse("2024-01-05"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 7,
                    'current' => 7,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 12 && $currentDay->isSameDay(Carbon::parse("2024-01-06"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 8,
                    'current' => 8,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 13 && $currentDay->isSameDay(Carbon::parse("2024-01-07"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 9,
                    'current' => 9,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 14 && $currentDay->isSameDay(Carbon::parse("2024-01-08"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 10,
                    'current' => 10,
                    'missed' => 0,
                    'remaining_rest_days' => 3,
                ], $currentStreakData);
            }

            $currentDay->addDay();
        }
    }

    public function test_community_challenge_streak_data_with_bonus_days_no_rest_days_used(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons-with-unlock-and-bonus.json',
            'challenge-child-10-lessons-with-unlock-and-bonus.json',
            ['is_solo' => false]
        );
        /**
         * @var $challengesService ChallengesService
         */
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $startDateCarbon = Carbon::parse("2023-12-28 12:00:00");

        // Start the challenge
        // Users get 1 free rest day when started if the challenge is 10 days or more
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            null
        );

        $currentDay = $startDateCarbon->copy()->addHours(3);

        // Simulate completing lessons
        for ($currentLessonNumberToBeCompleted = 1; $currentLessonNumberToBeCompleted <= count($userProgress->lessons_meta_data); $currentLessonNumberToBeCompleted++) {
            Carbon::setTestNow($currentDay);

            $currentLessonMetaData = $userProgress->lessons_meta_data[$currentLessonNumberToBeCompleted - 1];

            // First day is a bonus lesson
            if ($currentLessonNumberToBeCompleted == 1 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(0, $currentStreakData['best']);
                $this->assertEquals(0, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);

                $currentDay->subDay();
            }

            // Second day is bonus that unlocks on the same day as 1
            if ($currentLessonNumberToBeCompleted == 2 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(0, $currentStreakData['best']);
                $this->assertEquals(0, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);

                $currentDay->subDay();
            }

            // first curriculum lesson is completed
            if ($currentLessonNumberToBeCompleted == 3 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[3 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 1,
                    'current' => 1,
                    'missed' => 0,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 4 && $currentDay->isSameDay(Carbon::parse("2023-12-29"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 2,
                    'current' => 2,
                    'missed' => 0,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 5 && $currentDay->isSameDay(Carbon::parse("2023-12-30"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 3,
                    'current' => 3,
                    'missed' => 0,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 6 && $currentDay->isSameDay(Carbon::parse("2023-12-31"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 4,
                    'current' => 4,
                    'missed' => 0,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 7 && $currentDay->isSameDay(Carbon::parse("2024-01-01"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 5,
                    'current' => 5,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            // bonus day, no streak
            if ($currentLessonNumberToBeCompleted == 8 && $currentDay->isSameDay(Carbon::parse("2024-01-02"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 5,
                    'current' => 5,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            // bonus day, no streak
            if ($currentLessonNumberToBeCompleted == 9 && $currentDay->isSameDay(Carbon::parse("2024-01-03"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 5,
                    'current' => 5,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 10 && $currentDay->isSameDay(Carbon::parse("2024-01-04"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 6,
                    'current' => 6,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 11 && $currentDay->isSameDay(Carbon::parse("2024-01-05"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 7,
                    'current' => 7,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 12 && $currentDay->isSameDay(Carbon::parse("2024-01-06"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 8,
                    'current' => 8,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 13 && $currentDay->isSameDay(Carbon::parse("2024-01-07"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 9,
                    'current' => 9,
                    'missed' => 0,
                    'remaining_rest_days' => 2,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 14 && $currentDay->isSameDay(Carbon::parse("2024-01-08"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 10,
                    'current' => 10,
                    'missed' => 0,
                    'remaining_rest_days' => 3,
                ], $currentStreakData);
            }

            $currentDay->addDay();
        }
    }

    public function test_community_challenge_all_rest_days_used_unlock_dates_not_shift_and_rest_day_count_is_accurate(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons.json',
            'challenge-child-10-lessons.json',
            ['is_solo' => false]
        );
        /**
         * @var $challengesService ChallengesService
         */
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $startDateCarbon = Carbon::parse("2023-12-28 12:00:00");

        // Start the challenge
        // Users get 1 free rest day when started if the challenge is 10 days or more
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            null  // start date must be null for community challenges to be treated as a community challenge
        );

        $currentDay = $startDateCarbon->copy()->addHours(3);

        // Simulate completing lessons
        for ($currentLessonNumberToBeCompleted = 1; $currentLessonNumberToBeCompleted <= count($userProgress->lessons_meta_data); $currentLessonNumberToBeCompleted++) {
            Carbon::setTestNow($currentDay);

            $currentLessonMetaData = $userProgress->lessons_meta_data[$currentLessonNumberToBeCompleted - 1];

            // Complete the first day on start date (+1 to streak)
            if ($currentLessonNumberToBeCompleted == 1 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // They miss the second day, should use up a rest_dat and push the unlock days of all future lessons 1 day
            if ($currentLessonNumberToBeCompleted == 2 && $currentDay->isSameDay(Carbon::parse("2023-12-29"))) {
                $this->assertTrue(Carbon::parse($currentLessonMetaData['unlock_date'])->isSameDay($currentDay));

                // subtract the current lesson number since the following day they still need to complete this lesson
                $currentLessonNumberToBeCompleted--;

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // now the following day, on Dec 3rd, rest day is consumed and schedule does NOT shift
            // also, they complete the missing lesson and current lesson for today and get an additional streak of +2
            if ($currentLessonNumberToBeCompleted == 2 &&
                $currentDay->isSameDay(Carbon::parse("2023-12-30"))) {

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assert that the future lessons are not rescheduled unlike solo challenges
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[2 - 1]['unlock_date'])->toDateString(),
                    "2023-12-29"
                );
                // same for following days
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[3 - 1]['unlock_date'])->toDateString(),
                    "2023-12-30"
                );
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[10 - 1]['unlock_date'])->toDateString(),
                    "2024-01-06"
                );

                // Assert streak was not broken, but it shouldn't increase
                $this->assertEquals([
                    'best' => 1,
                    'current' => 1,
                    'missed' => 1,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);

                // complete the missing lesson (+1 streak since a rest day was used)
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[2 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 2,
                    'current' => 2,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);

                // complete the missing lesson (+1 streak since a rest day was used)
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[3 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 3,
                    'current' => 3,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);

                $currentLessonNumberToBeCompleted++;
            }

            if ($currentLessonNumberToBeCompleted == 4 &&
                $currentDay->isSameDay(Carbon::parse("2023-12-31"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    "2023-12-31"
                );

                $this->assertEquals([
                    'best' => 4,
                    'current' => 4,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);
            }

            // they complete the rest of the challenge on schedule
            if ($currentLessonNumberToBeCompleted >= 5 && $currentLessonNumberToBeCompleted <= 9) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => $currentLessonNumberToBeCompleted,
                    'current' => $currentLessonNumberToBeCompleted,
                    'missed' => 0,
                    'remaining_rest_days' => $currentLessonNumberToBeCompleted >= 5 ? 1 : 0, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            // They miss lesson 9, which should use up their last rest day
            if ($currentLessonNumberToBeCompleted == 10 &&
                $currentDay->isSameDay(Carbon::parse("2024-01-06"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    $currentDay->toDateString()
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals([
                    'best' => 10,
                    'current' => 10,
                    'missed' => 0,
                    'remaining_rest_days' => 2, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            $currentDay->addDay();
        }
    }

    public function test_community_challenge_rest_days_used_days_after_unlock_and_rest_day_count_is_accurate(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons.json',
            'challenge-child-10-lessons.json',
            ['is_solo' => false]
        );
        /**
         * @var $challengesService ChallengesService
         */
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $startDateCarbon = Carbon::parse("2023-12-28 12:00:00");

        // Start the challenge
        // Users get 1 free rest day when started if the challenge is 10 days or more
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            null  // start date must be null for community challenges to be treated as a community challenge
        );

        $currentDay = $startDateCarbon->copy()->addHours(3);

        // Simulate completing lessons
        for ($currentLessonNumberToBeCompleted = 1; $currentLessonNumberToBeCompleted <= count($userProgress->lessons_meta_data); $currentLessonNumberToBeCompleted++) {
            Carbon::setTestNow($currentDay);

            $currentLessonMetaData = $userProgress->lessons_meta_data[$currentLessonNumberToBeCompleted - 1];

            // Complete the first day on start date (+1 to streak)
            if ($currentLessonNumberToBeCompleted == 1 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // They miss the second day
            if ($currentLessonNumberToBeCompleted == 2 && $currentDay->isSameDay(Carbon::parse("2023-12-29"))) {
                $this->assertTrue(Carbon::parse($currentLessonMetaData['unlock_date'])->isSameDay($currentDay));

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // now the following day, on Dec 3rd they complete that days lesson but NOT the missed day
            if ($currentLessonNumberToBeCompleted == 3 && $currentDay->isSameDay(Carbon::parse("2023-12-30"))) {

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assert that the future lessons are not rescheduled unlike solo challenges
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[2 - 1]['unlock_date'])->toDateString(),
                    "2023-12-29"
                );
                // same for following days
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[3 - 1]['unlock_date'])->toDateString(),
                    "2023-12-30"
                );
                $this->assertEquals(
                    Carbon::parse($userProgress->lessons_meta_data[10 - 1]['unlock_date'])->toDateString(),
                    "2024-01-06"
                );

                // Assert streak was not broken, but it shouldn't increase
                $this->assertEquals([
                    'best' => 1,
                    'current' => 1,
                    'missed' => 1,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);

                // complete todays lesson (+1 streak since they have rest day coverage)
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[3 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 2,
                    'current' => 2,
                    'missed' => 1,
                    'remaining_rest_days' => 1,
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 4 && $currentDay->isSameDay(Carbon::parse("2023-12-31"))) {

                // now they complete the missing lesson (+1 streak since a rest day was used)
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[2 - 1]['content_id'],
                    $userId
                );

                // Get the streak data, their missed days should now be 0 since a rest day was used
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => 3,
                    'current' => 3,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);

                // also complete todays lesson
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    "2023-12-31"
                );

                $this->assertEquals([
                    'best' => 4,
                    'current' => 4,
                    'missed' => 0,
                    'remaining_rest_days' => 0,
                ], $currentStreakData);
            }

            // they complete the rest of the challenge on schedule
            if ($currentLessonNumberToBeCompleted >= 5 && $currentLessonNumberToBeCompleted <= 9) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => $currentLessonNumberToBeCompleted,
                    'current' => $currentLessonNumberToBeCompleted,
                    'missed' => 0,
                    'remaining_rest_days' => $currentLessonNumberToBeCompleted >= 5 ? 1 : 0, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            // They miss lesson 9, which should use up their last rest day
            if ($currentLessonNumberToBeCompleted == 10 &&
                $currentDay->isSameDay(Carbon::parse("2024-01-06"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    $currentDay->toDateString()
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals([
                    'best' => 10,
                    'current' => 10,
                    'missed' => 0,
                    'remaining_rest_days' => 2, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            $currentDay->addDay();
        }
    }

    public function test_community_challenge_lots_of_missed_days(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons.json',
            'challenge-child-10-lessons.json',
            ['is_solo' => false]
        );
        /**
         * @var $challengesService ChallengesService
         */
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $startDateCarbon = Carbon::parse("2023-12-28 12:00:00");

        // Start the challenge
        // Users get 1 free rest day when started if the challenge is 10 days or more
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            null  // start date must be null for community challenges to be treated as a community challenge
        );

        $currentDay = $startDateCarbon->copy()->addHours(3);

        // Simulate completing lessons
        for ($currentLessonNumberToBeCompleted = 1; $currentLessonNumberToBeCompleted <= count($userProgress->lessons_meta_data); $currentLessonNumberToBeCompleted++) {
            Carbon::setTestNow($currentDay);

            $currentLessonMetaData = $userProgress->lessons_meta_data[$currentLessonNumberToBeCompleted - 1];

            // Complete the first day on start date (+1 to streak)
            if ($currentLessonNumberToBeCompleted == 1 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // They miss the second day
            if ($currentLessonNumberToBeCompleted == 2 && $currentDay->isSameDay(Carbon::parse("2023-12-29"))) {
                $this->assertTrue(Carbon::parse($currentLessonMetaData['unlock_date'])->isSameDay($currentDay));

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // They miss the third day
            if ($currentLessonNumberToBeCompleted == 3 && $currentDay->isSameDay(Carbon::parse("2023-12-30"))) {
                $this->assertTrue(Carbon::parse($currentLessonMetaData['unlock_date'])->isSameDay($currentDay));

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(1, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            if ($currentLessonNumberToBeCompleted == 4 && $currentDay->isSameDay(Carbon::parse("2023-12-31"))) {

                // they complete todays lesson
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    "2023-12-31"
                );

                $this->assertEquals(expected: [
                    'best' => 1,
                    'current' => 1,
                    'missed' => 2,
                    'remaining_rest_days' => 1,
                ], actual: $currentStreakData);

                // now they also complete one of the missed lessons therefore consuming a rest day
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[3 - 1]['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    "2023-12-31"
                );

                $this->assertEquals(expected: [
                    'best' => 2,
                    'current' => 2,
                    'missed' => 1,
                    'remaining_rest_days' => 0,
                ], actual: $currentStreakData);
            }

            // they complete the rest of the challenge on schedule
            if ($currentLessonNumberToBeCompleted >= 5 && $currentLessonNumberToBeCompleted <= 6) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => $currentLessonNumberToBeCompleted - 2,
                    'current' => $currentLessonNumberToBeCompleted - 2,
                    'missed' => 1,
                    'remaining_rest_days' => 0, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }


            // they complete the rest of the challenge on schedule
            if ($currentLessonNumberToBeCompleted >= 7 && $currentLessonNumberToBeCompleted <= 9) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => $currentLessonNumberToBeCompleted - 1,
                    'current' => $currentLessonNumberToBeCompleted - 1,
                    'missed' => 1,
                    'remaining_rest_days' => 1, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 10 &&
                $currentDay->isSameDay(Carbon::parse("2024-01-06"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    $currentDay->toDateString()
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals([
                    'best' => 9,
                    'current' => 9,
                    'missed' => 1,
                    'remaining_rest_days' => 1, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            $currentDay->addDay();
        }
    }

    public function test_solo_challenge_lots_of_missed_days(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons.json',
            'challenge-child-10-lessons.json'
        );
        /**
         * @var $challengesService ChallengesService
         */
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $startDateCarbon = Carbon::parse("2023-12-28 12:00:00");

        // Start the challenge
        // Users get 1 free rest day when started if the challenge is 10 days or more
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId
        );

        $currentDay = $startDateCarbon->copy()->addHours(3);

        // Simulate completing lessons
        for ($currentLessonNumberToBeCompleted = 1; $currentLessonNumberToBeCompleted <= count($userProgress->lessons_meta_data); $currentLessonNumberToBeCompleted++) {
            Carbon::setTestNow($currentDay);

            $currentLessonMetaData = $userProgress->lessons_meta_data[$currentLessonNumberToBeCompleted - 1];

            // Complete the first day on start date (+1 to streak)
            if ($currentLessonNumberToBeCompleted == 1 && $currentDay->isSameDay(Carbon::parse("2023-12-28"))) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // They miss the second day
            if ($currentLessonNumberToBeCompleted == 2 && $currentDay->isSameDay(Carbon::parse("2023-12-29"))) {
                $this->assertTrue(Carbon::parse($currentLessonMetaData['unlock_date'])->isSameDay($currentDay));

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            // They miss the third day
            if ($currentLessonNumberToBeCompleted == 3 && $currentDay->isSameDay(Carbon::parse("2023-12-30"))) {
                $this->assertTrue(Carbon::parse($currentLessonMetaData['unlock_date'])->isSameDay($currentDay));

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals(1, $currentStreakData['best']);
                $this->assertEquals(1, $currentStreakData['current']);
                $this->assertEquals(1, $currentStreakData['missed']);
                $this->assertEquals(1, $currentStreakData['remaining_rest_days']);
            }

            if ($currentLessonNumberToBeCompleted == 4 && $currentDay->isSameDay(Carbon::parse("2023-12-31"))) {

                // they complete todays lesson
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    "2023-12-31"
                );

                $this->assertEquals(expected: [
                    'best' => 1,
                    'current' => 1,
                    'missed' => 2,
                    'remaining_rest_days' => 1,
                ], actual: $currentStreakData);

                // now they also complete one of the missed lessons therefore consuming a rest day
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $userProgress->lessons_meta_data[3 - 1]['content_id'],
                    $userId
                );

                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    "2023-12-31"
                );

                $this->assertEquals(expected: [
                    'best' => 2,
                    'current' => 2,
                    'missed' => 1,
                    'remaining_rest_days' => 0,
                ], actual: $currentStreakData);
            }

            // they complete the rest of the challenge on schedule
            if ($currentLessonNumberToBeCompleted >= 5 && $currentLessonNumberToBeCompleted <= 6) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => $currentLessonNumberToBeCompleted - 2,
                    'current' => $currentLessonNumberToBeCompleted - 2,
                    'missed' => 1,
                    'remaining_rest_days' => 0, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }


            // they complete the rest of the challenge on schedule
            if ($currentLessonNumberToBeCompleted >= 7 && $currentLessonNumberToBeCompleted <= 9) {
                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                $this->assertEquals([
                    'best' => $currentLessonNumberToBeCompleted - 1,
                    'current' => $currentLessonNumberToBeCompleted - 1,
                    'missed' => 1,
                    'remaining_rest_days' => 1, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            if ($currentLessonNumberToBeCompleted == 10 &&
                $currentDay->isSameDay(Carbon::parse("2024-01-06"))) {

                $challengeData = $challengesService->completeLessonAndGetCurrentProgressResults(
                    $currentLessonMetaData['content_id'],
                    $userId
                );

                $this->assertEquals(
                    Carbon::parse($currentLessonMetaData['unlock_date'])->toDateString(),
                    $currentDay->toDateString()
                );

                // Get the streak data
                $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
                $currentStreakData = $userProgress->getStreakCurrentData();

                // Assertions for streak behavior
                $this->assertEquals([
                    'best' => 9,
                    'current' => 9,
                    'missed' => 1,
                    'remaining_rest_days' => 1, // they earned another rest day after a 5-day streak
                ], $currentStreakData);
            }

            $currentDay->addDay();
        }
    }


    public function test_timezone_logic_for_streaks(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-10-lessons.json', 'challenge-child-10-lessons.json');

        $challengesService = app()->make(ChallengesService::class);

        $userTimezone = 'America/Los_Angeles';

        UserTimezoneService::mockUsersTimezone($userTimezone);

        // Start date is always passed already in the users timezone
        $startTimeCarbon = Carbon::create(2024, 12, 1, 6, 3);

        // set test now to the exact same start time as the users local start time but in UTC
        Carbon::setTestNow(Carbon::parse($startTimeCarbon->toDateTimeString(), $userTimezone)->timezone('UTC'));

        // Start the challenge
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: $startTimeCarbon->toISOString()
        );

        foreach ($userProgress->lessons_meta_data as $index => $lessonMetaDatum) {

            // Complete the lesson
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lessonMetaDatum['content_id'],
                $userId
            );

            $lessonNumber = $index + 1;

            // Check streak logic for milestones and modal
            if ($lessonNumber == 5) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals(
                    "You're on a {$lessonNumber} Day Streak!",
                    $lessonCompletedProgress['motivational_title']
                );
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonNumber == 10) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "Return tomorrow to maintain your streak!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNull($lessonCompletedProgress['lottie_url']);
            }

            // Validate streak data
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();

            $this->assertEquals($lessonNumber, $currentStreakData['current']);
            $this->assertEquals($lessonNumber, $currentStreakData['best']);
            $this->assertEquals(0, $currentStreakData['missed']);

            // Travel to the next day in the user's timezone
            // move ahead days ahead
            $this->travelTo(Carbon::now()->addDay());
        }
    }

    public function test_timezone_logic_for_unlocks_and_streaks_africa(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-10-lessons.json', 'challenge-child-10-lessons.json');

        // Simulate passing the user's timezone in the request
        UserTimezoneService::mockUsersTimezone('Africa/Khartoum'); // UTC +2

        $challengesService = app()->make(ChallengesService::class);

        // Set the test to start on a specific day and time in UTC
        // 2024-12-01 09:03:00 UTC,
        // 2024-12-01 11:03:00 Africa/Khartoum,
        $startTimeCarbon = Carbon::create(2024, 12, 1, 9, 3, 0, 'UTC');
        $this->travelTo($startTimeCarbon);

        // Start the challenge
        $startDate = Carbon::now()->toISOString();
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId, startDate: $startDate);

        // Travel to 11pm UTC, which is 1am the next day (2nd) for the user in their timezone.
        // Lesson 2 should be unlocked.
        $this->travelTo(Carbon::create(2024, 12, 1, 23, 0, 0, 'UTC'));

        $userLessonData = $challengesService->getCurrentLessonData($this->challengeId, $userId);

        $this->assertFalse($userLessonData['lessons'][1]['is_locked']);
    }

    public function test_timezone_logic_for_unlocks_and_streaks_pst(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-10-lessons.json', 'challenge-child-10-lessons.json');

        // Simulate passing the user's timezone in the request
        UserTimezoneService::mockUsersTimezone('Mexico/General'); // UTC -6

        $challengesService = app()->make(ChallengesService::class);

        // Set the test to start on a specific day and time in UTC
        // 2024-12-04 23:45:00 CST
        // 2024-12-05 07:45:00 UTC
        // Start date must always be passed in the string that represents the users current timezone
        $startTimeCarbon = Carbon::parse(
            Carbon::create('2024-12-05 23:45:00')->startOfDay()->toDateTimeString()
        );

        $this->travelTo($startTimeCarbon);

        // Start the challenge
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: $startTimeCarbon->toISOString()
        );

        $userLessonData = $challengesService->getCurrentLessonData($this->challengeId, $userId);

        // Ensure day 1 unlocks 15 minutes later
        $this->assertEquals(
            '2024-12-06 00:00:00',
            Carbon::parse($userLessonData['lessons'][1]['unlock_date'])->toDateTimeString()
        );
    }

    public function test_index_metadata_for_challenge(): void
    {
        $this->markTestSkipped('ErrorException: Undefined array key 402199');
        $userId = user()->id;
        // --- PREP DATA -----
        // 402199 - 10 lessons - community challenge - enrolled
        $challengeId = 402199;
        $this->prep_challenge_index(0);
        $challengesService = app()->make(ChallengesService::class);

        $challengesService->startChallenge(402199, $userId);

        // --- RETRIEVE DATA ---
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['brand' => 'drumeo']),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $this->getChallengeDataById($responseData, $challengeId);

        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(0, $challengeMetadata['progress_percent']);
        $this->assertEquals('November 12 - 21', $challengeMetadata['duration_text']);
        $this->assertFalse(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('active', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_with_unlocked_lessons(): void
    {
        $this->markTestSkipped('ErrorException: Undefined array key 402199');
        $userId = user()->id;
        $challengeId = 402200;
        // --- PREP DATA -----
        // 402200 - 8 of 10 lessons - community challenge - enrolled
        $this->prep_challenge_index(1);
        $challengesService = app()->make(ChallengesService::class);
        $challengesService->startChallenge($challengeId, $userId);

        // --- RETRIEVE DATA ---
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['brand' => 'drumeo']),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $this->getChallengeDataById($responseData, $challengeId);
        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(0, $challengeMetadata['progress_percent']);
        $this->assertEquals('Nov 27 - Dec 4', $challengeMetadata['duration_text']);
        $this->assertFalse(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('active', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_partially_completed_lesson(): void
    {
        $this->markTestSkipped('ErrorException: Undefined array key 402199');
        $userId = user()->id;
        // 402201 - 5 lessons - solo challenge - enrolled - 2 lessons completed
        $challengeId = 402201;
        $this->prep_challenge_index(2);
        $challengesService = app()->make(ChallengesService::class);

        // --- PREP DATA -----
        $userProgressData = $challengesService->startChallenge($challengeId, $userId, '20241101');
        $lessonMetadata = $userProgressData->lessons_meta_data;
//        // hack to complete the lessons without extra mocking. I'm lazy, and building the json files is a lot of work
        $lessonMetadata[0]['completed'] = true;
        $lessonMetadata[1]['completed'] = true;
        $userProgressData->lessons_meta_data = $lessonMetadata;
        $userProgressData->save();

        // --- RETRIEVE DATA ---
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['brand' => 'drumeo']),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $this->getChallengeDataById($responseData, $challengeId);
        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(40, $challengeMetadata['progress_percent']);
        $this->assertEquals('November 1 - 5', $challengeMetadata['duration_text']);
        $this->assertTrue(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('active', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_not_enrolled(): void
    {
        $this->markTestSkipped('ErrorException: Undefined array key 402199');
        $userId = user()->id;
        // 402202 - 8 of 10 lessons - not enrolled
        $challengeId = 402202;
        $this->prep_challenge_index(3);
        $challengesService = app()->make(ChallengesService::class);

        // --- PREP DATA -----

        // --- RETRIEVE DATA ---
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['brand' => 'drumeo']),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $this->getChallengeDataById($responseData, $challengeId);
        $this->assertFalse($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(0, $challengeMetadata['progress_percent']);
        $this->assertEquals('November 1 - 8', $challengeMetadata['duration_text']);
        $this->assertNull($challengeMetadata['is_solo']);
        $this->assertEquals('not_started', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_unlocked(): void
    {
        $this->markTestSkipped('ErrorException: Undefined array key 402199');
        $userId = user()->id;
        // 402203 - 10 lessons - enrolled - unlocked
        $challengeId = 402203;
        $this->prep_challenge_index(4);
        $challengesService = app()->make(ChallengesService::class);

        // --- PREP DATA -----
        $userProgress = $challengesService->startChallenge($challengeId, $userId, isLocked: false);
        $lessonMetadata = $userProgress->lessons_meta_data;
        // hack to complete the lessons without extra mocking. I'm lazy, and building the json files is a lot of work
        $lessonMetadata[0]['completed'] = true;
        $lessonMetadata[1]['completed'] = true;
        $userProgress->lessons_meta_data = $lessonMetadata;
        $userProgress->save();

        // --- RETRIEVE DATA ---
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['brand' => 'drumeo']),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $this->getChallengeDataById($responseData, $challengeId);
        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(20, $challengeMetadata['progress_percent']);
        $this->assertEquals('Unlocked', $challengeMetadata['duration_text']);
        $this->assertTrue(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('active', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_completed(): void
    {
        $this->markTestSkipped('ErrorException: Undefined array key 402199');
        $userId = user()->id;
        // 402204 - 10 lessons - enrolled - completed
        $challengeId = 402204;
        $this->prep_challenge_index(5);
        $challengesService = app()->make(ChallengesService::class);

        // --- PREP DATA -----
        $userProgress = $challengesService->startChallenge($challengeId, $userId);
        $lessonMetadata = $userProgress->lessons_meta_data;
        // hack to complete the lessons without extra mocking. I'm lazy, and building the json files is a lot of work
        foreach ($lessonMetadata as $index => $_) {
            $lessonMetadata[$index]['completed'] = true;
        }
        $userProgress->lessons_meta_data = $lessonMetadata;
        $userProgress->save();
        $challengesService->completeChallenge($challengeId, $userId);

        // --- RETRIEVE DATA ---
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['brand' => 'drumeo']),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $this->getChallengeDataById($responseData, $challengeId);
        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(100, $challengeMetadata['progress_percent']);
        $this->assertEquals('November 1 - 10', $challengeMetadata['duration_text']);
        $this->assertFalse(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('completed', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_that_doesnt_exist(): void
    {
        $userId = user()->id;
        $contentIds = [402199, 402200, 402201, 402202, 402203];
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['brand' => 'drumeo']),
        );
        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $this->getChallengeDataById($responseData, 11111);
        $this->assertNull($challengeMetadata);
    }

    private function prep_challenge_index($index)
    {
        $startDate = Carbon::parse('November 12 2024');
        $this->travelTo($startDate);
        $challengeFileName = 'challenge-index-metadata.json';
        $_ = $this->mock(SanityGateway::class, function (MockInterface $mock) use ($challengeFileName, $index) {
            $path = Storage::disk("content_test_resources")->path($challengeFileName);
            $json = json_decode(file_get_contents($path), true);
            $now = Carbon::now()->startOfDay();
            $json[0]['published_on'] = $now->toISOString();
            $json[1]['published_on'] = $now->copy()->addDays(15)->toISOString();
            $json[2]['published_on'] = $now->copy()->subDays(11)->toISOString();
            $json[3]['published_on'] = $now->copy()->subDays(11)->toISOString();
            $json[4]['published_on'] = $now->copy()->subDays(11)->toISOString();
            $json[5]['published_on'] = $now->copy()->subDays(11)->toISOString();
            $mock
                ->shouldReceive('getByRailContentIds')
                ->andReturn($json);
            $mock
                ->shouldReceive('getByRailContentId')
                ->andReturn($json[$index]);
            $mock
                ->shouldReceive('getAllChallengesByBrand')
                ->andReturn($json);
        });
    }

    private function getChallengeDataById($challenges, $challengeId)
    {
        foreach ($challenges as $challenge) {
            if ($challenge['content_id'] == $challengeId) {
                return $challenge;
            }
        }
        return null;
    }

    public function test_milestones_for_length_11(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-11-lessons.json', 'challenge-child-11-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: Carbon::now()->startOfDay()->toISOString()
        );

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lesson_meta_datum['content_id'],
                $userId
            );
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 11) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonNumber == 6) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals(
                    "You're on a {$lessonNumber} Day Streak!",
                    $lessonCompletedProgress['motivational_title']
                );
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "Return tomorrow to maintain your streak!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNull($lessonCompletedProgress['lottie_url']);
            }
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();
            $this->assertEquals($lessonNumber, $currentStreakData['current']);
            $this->assertEquals($lessonNumber, $currentStreakData['best']);
            $this->assertEquals(0, $currentStreakData['missed']);
            $this->travel(1)->days();
        }
    }

    public function test_milestones_with_unlocked_lessons(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-11-lessons.json', 'challenge-child-11-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: Carbon::now()->startOfDay()->toISOString()
        );

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lesson_meta_datum['content_id'],
                $userId
            );
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 11) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonNumber == 6) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals(
                    "You're on a {$lessonNumber} Day Streak!",
                    $lessonCompletedProgress['motivational_title']
                );
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "Return tomorrow to maintain your streak!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNull($lessonCompletedProgress['lottie_url']);
            }
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();
            $this->assertEquals($lessonNumber, $currentStreakData['current']);
            $this->assertEquals($lessonNumber, $currentStreakData['best']);
            $this->assertEquals(0, $currentStreakData['missed']);
            $this->travel(1)->days();
        }
    }

    public function test_milestones_for_length_6(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-6-lessons.json', 'challenge-child-6-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: Carbon::now()->startOfDay()->toISOString()
        );

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lesson_meta_datum['content_id'],
                $userId
            );
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 6) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "Return tomorrow to maintain your streak!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNull($lessonCompletedProgress['lottie_url']);
            }
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();
            $this->assertEquals($lessonNumber, $currentStreakData['current']);
            $this->assertEquals($lessonNumber, $currentStreakData['best']);
            $this->assertEquals(0, $currentStreakData['missed']);
            $this->travel(1)->days();
        }
    }

    public function test_milestones_for_length_30(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-30-lessons.json', 'challenge-child-30-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: Carbon::now()->startOfDay()->toISOString()
        );

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lesson_meta_datum['content_id'],
                $userId
            );
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 30) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonNumber % 5 == 0) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals(
                    "You're on a {$lessonNumber} Day Streak!",
                    $lessonCompletedProgress['motivational_title']
                );
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "Return tomorrow to maintain your streak!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNull($lessonCompletedProgress['lottie_url']);
            }
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();
            $this->assertEquals($lessonNumber, $currentStreakData['current']);
            $this->assertEquals($lessonNumber, $currentStreakData['best']);
            $this->assertEquals(0, $currentStreakData['missed']);
            $this->travel(1)->days();
        }
    }

    public function test_milestones_for_length_22(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-22-lessons.json', 'challenge-child-22-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: Carbon::now()->startOfDay()->toISOString()
        );

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lesson_meta_datum['content_id'],
                $userId
            );
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 22) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif (in_array($lessonNumber, [6,11,17])) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals(
                    "You're on a {$lessonNumber} Day Streak!",
                    $lessonCompletedProgress['motivational_title']
                );
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "Return tomorrow to maintain your streak!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNull($lessonCompletedProgress['lottie_url']);
            }
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();
            if ($lessonNumber == 22) {
                $this->assertEquals(22, $userProgress->completed_best_streak);
            } else {
                $this->assertEquals($lessonNumber, $currentStreakData['current']);
                $this->assertEquals($lessonNumber, $currentStreakData['best']);
                $this->assertEquals(0, $currentStreakData['missed']);
                $this->travel(1)->days();
            }
        }
    }

    public function test_complete_lesson_for_unlocked_user(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-10-lessons.json', 'challenge-child-10-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: Carbon::now()->startOfDay()->toISOString(),
            isLocked: false
        );
        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lesson_meta_datum['content_id'],
                $userId
            );
            $lessonNumber = $index + 1;
            $this->assertFalse($lessonCompletedProgress['show_modal']);
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();
            $this->assertEquals($lessonNumber, $currentStreakData['current']);
            $this->assertEquals($lessonNumber, $currentStreakData['best']);
            $this->assertEquals(0, $currentStreakData['missed']);
        }
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
        $this->assertTrue($userProgress->areAllLessonsCompleted());
    }

    public function test_complete_challenge_minutes_practiced()
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-10-lessons.json', 'challenge-child-10-lessons.json');
        /** @var ChallengesService $challengesService */
        $challengesService = app()->make(ChallengesService::class);
        /** @var MediaPlaybackService $mediaPlaybackService */
        $mediaPlaybackService = app()->make(MediaPlaybackService::class);
        $userProgress = $challengesService->startChallenge(
            $this->challengeId,
            $userId,
            startDate: Carbon::now()->startOfDay()->toISOString(),
            isLocked: false
        );

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $mediaPlaybackService->trackMediaPlaybackStart($lesson_meta_datum['content_id'], 60, $userId, 0, 60, 60);
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults(
                $lesson_meta_datum['content_id'],
                $userId
            );
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            foreach ($userProgress->lessons_meta_data as $lessonData) {
                if($lessonData['content_id'] == $lesson_meta_datum['content_id']) {
                    $this->assertEquals(60, $lessonData['seconds_practiced']);
                }
            }
        }

        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);

        $this->assertEquals(10, $userProgress->completed_time_practiced);
    }

    public function test_lesson_data_check_inactive(): void
    {
        $this->mockChallengeAndLessonDataData();
        $userId = user()->id;
        $challengesService = app()->make(ChallengesService::class);

        $resultData = $challengesService->getCurrentLessonData(402542, $userId, isLesson: true);
        $this->assertCount(2, $resultData['user_data']);
        $this->assertFalse($resultData['user_data']['is_active']);
    }

    public function test_lesson_data_check_next_prev_lesson_changes(): void
    {
        $challengeId = 402199;
        $firstLessonId = 402542;
        $secondLessonId = 402314;
        $thirdLessonId = 402316;
        $fourthLessonId = 402318;
        $fifthLessonId = 402320;
        $maxLessonId = 402358;
        $today = now()->startOfDay();
        $this->mockChallengeAndLessonDataData(challengeDataToUpdate: ['published_on' => $today->toISOString()]);
        $userId = user()->id;
        $challengesService = app()->make(ChallengesService::class);
        $challengesService->startChallenge($challengeId, $userId);
        $resultData = $challengesService->getCurrentLessonData($firstLessonId, $userId, isLesson: true);
        $this->assertTrue(boolval($resultData['user_data']['is_active']));
        $this->assertEmpty($resultData['previous_lesson']);
        $this->assertEquals($secondLessonId, $resultData['next_lesson']['id']);
        $this->assertCount(24, $resultData['lessons']);
        $this->travel(1)->days();

        $resultData = $challengesService->getCurrentLessonData($firstLessonId, $userId, isLesson: true);
        $this->assertEmpty($resultData['previous_lesson']);
        $this->assertEquals($secondLessonId, $resultData['next_lesson']['id']);
        $this->assertEquals($firstLessonId, $resultData['first_incomplete_lesson']['id']);
        $this->assertCount(24, $resultData['lessons']);

        $challengesService->completeLessonAndGetCurrentProgressResults($firstLessonId, $userId);
        $resultData = $challengesService->getCurrentLessonData($firstLessonId, $userId, isLesson: true);
        $this->assertEmpty($resultData['previous_lesson']);
        $this->assertEquals($secondLessonId, $resultData['next_lesson']['id']);
        $this->assertEquals($secondLessonId, $resultData['first_incomplete_lesson']['id']);
        $this->assertCount(23, $resultData['lessons']);

        $this->travel(1)->days();
        $challengesService->completeLessonAndGetCurrentProgressResults($secondLessonId, $userId);
        $resultData = $challengesService->getCurrentLessonData($secondLessonId, $userId, isLesson: true);
        $this->assertEquals($firstLessonId, $resultData['previous_lesson']['id']);
        $this->assertEquals($thirdLessonId, $resultData['next_lesson']['id']);
        $this->assertEquals($thirdLessonId, $resultData['first_incomplete_lesson']['id']);
        $this->assertCount(22, $resultData['lessons']);

        // now we travel two days in advance and verify the incomplete lesson stays
        $this->travel(2)->days();
        $challengesService->completeLessonAndGetCurrentProgressResults($fourthLessonId, $userId);
        $resultData = $challengesService->getCurrentLessonData($fourthLessonId, $userId, isLesson: true);
        $this->assertEquals($thirdLessonId, $resultData['previous_lesson']['id']);
        $this->assertEquals($fifthLessonId, $resultData['next_lesson']['id']);
        $this->assertEquals($thirdLessonId, $resultData['first_incomplete_lesson']['id']);
        $this->assertCount(21, $resultData['lessons']);
        // also check if we go to previous content pages
        $resultData = $challengesService->getCurrentLessonData($firstLessonId, $userId, isLesson: true);
        $this->assertEmpty($resultData['previous_lesson']);
        $this->assertEquals($secondLessonId, $resultData['next_lesson']['id']);
        $this->assertEquals($thirdLessonId, $resultData['first_incomplete_lesson']['id']);
        $this->assertCount(21, $resultData['lessons']);

        $challengesService->completeLessonAndGetCurrentProgressResults($thirdLessonId, $userId);

        for ($i = $fifthLessonId; $i <= $maxLessonId; $i += 2) {
            $challengesService->completeLessonAndGetCurrentProgressResults($i, $userId);
            $this->travel(1)->days();
        }

        $resultData = $challengesService->getCurrentLessonData($maxLessonId, $userId, isLesson: true);
        $this->assertNull($resultData['previous_lesson']);
        $this->assertNull($resultData['next_lesson']);
        $this->assertNull($resultData['first_incomplete_lesson']);
        $this->assertCount(24, $resultData['lessons']);
    }


    public function test_challenge_community_purchase(): void
    {
        $tomorrow = Carbon::now()->addDay()->startOfDay()->toISOString();
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons.json',
            'challenge-child-10-lessons.json',
        ['published_on' => $tomorrow]);
        $user = user();
        $product = ProductFactory::createPackProduct();
        $orderContents = [
            'line_items' => [['sku' => $product->sku]],
            'customer' => ['id' => $user->shopify_id]
        ];
        dispatch(new OrderUpdateChallengesEnrollment($orderContents));
        $this->assertDatabaseHas(User::class, ['id' => $user->id, 'is_challenge_owner' => true]);
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $user->id);
        $this->assertNotNull($userProgress);
        $this->assertFalse(boolval($userProgress->is_solo));
        $this->assertEquals($tomorrow, $userProgress->start_date->toISOString());
    }

    public function test_challenge_first_lesson_unlocks_at_time_of_start_exactly(): void
    {
        // reset carbon to be actual now, down to the second
        Carbon::setTestNow(new Carbon(new DateTime()));

        $userId = user()->id;
        // 402204 - 10 lessons - enrolled - completed
        $challengeId = 402204;
        $this->prep_challenge_index(5);
        $challengesService = app()->make(ChallengesService::class);

        // --- PREP DATA -----
        $userProgress = $challengesService->startChallenge($challengeId, $userId, Carbon::now()->toISOString());
        $lessonMetadata = $userProgress->lessons_meta_data;

        $this->assertEquals(Carbon::now()->toISOString(), $lessonMetadata[0]['unlock_date']);
        $this->assertEquals(Carbon::now()->startOfDay()->addDay()->toISOString(), $lessonMetadata[1]['unlock_date']);
    }

    public function test_challenge_purchase_solo_challenge(): void
    {
        $yesterday = Carbon::now()->subDay()->startOfDay()->toISOString();
        $today = Carbon::now()->startOfDay()->toISOString();
        $this->mockChallengeAndLessonDataData(
            'challenge-10-lessons.json',
            'challenge-child-10-lessons.json',
            ['is_solo' => true, 'published_on' => $yesterday]);
        $user = user();
        $product = ProductFactory::createPackProduct();
        $orderContents = [
            'line_items' => [['sku' => $product->sku]],
            'customer' => ['id' => $user->shopify_id]
        ];
        dispatch(new OrderUpdateChallengesEnrollment($orderContents));
        $this->assertDatabaseHas(User::class, ['id' => $user->id, 'is_challenge_owner' => true]);
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $user->id);
        $this->assertNotNull($userProgress);
        $this->assertTrue(boolval($userProgress->is_solo));
        $this->assertEquals($today, $userProgress->start_date->toISOString());
    }

    private function mockLessonData($fileName = 'challenge-child.json')
    {
        $_ = $this->mock(SanityGateway::class, function (MockInterface $mock) use ($fileName) {
            $path = Storage::disk("content_test_resources")->path($fileName);
            $json = json_decode(file_get_contents($path), true);
            $mock
                ->shouldReceive('getChallengeDataFromChild')
                ->andReturn($json);
        });
    }

    private function mockChallengeData($fileName = 'challenge.json')
    {
        $_ = $this->mock(SanityGateway::class, function (MockInterface $mock) use ($fileName) {
            $path = Storage::disk("content_test_resources")->path($fileName);
            $json = json_decode(file_get_contents($path), true);
            $mock
                ->shouldReceive('getByRailContentId')
                ->andReturn($json);
        });
    }

    private function mockChallengeAndLessonDataData(
        $challengeFileName = 'challenge.json',
        $lessonFileName = 'challenge-child.json',
        $challengeDataToUpdate = []
    ) {
        $path = Storage::disk("content_test_resources")->path($challengeFileName);
        $challengeJson = json_decode(file_get_contents($path), true);
        $lpath = Storage::disk("content_test_resources")->path($lessonFileName);
        $lessonJson = json_decode(file_get_contents($lpath), true);
        foreach ($challengeDataToUpdate as $key => $value) {
            $challengeJson[$key] = $value;
            $lessonJson['parent'][$key] = $value;
        }
        $challengesJson = [$challengeJson];
        $_ = $this->mock(
            SanityGateway::class,
            function (MockInterface $mock) use ($challengesJson, $challengeFileName, $lessonFileName, $challengeJson, $lessonJson) {
                $mock
                    ->shouldReceive('getByRailContentId')
                    ->andReturn($challengeJson);
                $mock
                    ->shouldReceive('getChallengeChildAndParentData')
                    ->andReturn($lessonJson);
                $mock
                    ->shouldReceive('getProductInformationForAllChallenges')
                    ->andReturn($challengesJson);
            }
        );
    }
}
