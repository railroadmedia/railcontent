<?php

namespace App\Modules\Content\tests\Feature;

use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use Modules\Content\Services\ChallengesService;
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
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId, startDate: Carbon::now()->startOfDay()->toISOString());

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults($lesson_meta_datum['content_id'], $userId);
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 10) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonNumber == 5) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals("You're on a {$lessonNumber} Day Streak!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals("Return tomorrow to maintain your streak!", $lessonCompletedProgress['motivational_subtext']);
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

        // this data file has 10 lessons, with two intro videos
        // always unlocked = [1,3];
        // bonus content = [8,9];
        $this->mockChallengeAndLessonDataData('challenge-10-lessons-with-unlock-and-bonus.json', 'challenge-child-10-lessons-with-unlock-and-bonus.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();

        $userProgress = $challengesService->startChallenge($this->challengeId, $userId, startDate: Carbon::now()->startOfDay()->toISOString());
        $completedLessons = 0;
        foreach ($userProgress->lessons_meta_data as $lesson_meta_datum) {
            $lessonIndex = $lesson_meta_datum['content_id'];
            if ($lessonIndex == 3) {
                // skip one of the unlocked contents
                continue;
            } else {
                $completedLessons += $lessonIndex == 1 ? 0 : 1;
            }
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults($lessonIndex, $userId);

            if ($lessonIndex == 12) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonIndex == 7) {
                $this->assertEquals($completedLessons, $lessonCompletedProgress['milestone']);
                $this->assertEquals("You're on a {$completedLessons} Day Streak!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonIndex == 1) {
                $this->assertFalse($lessonCompletedProgress['show_modal']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals("Return tomorrow to maintain your streak!", $lessonCompletedProgress['motivational_subtext']);
                $this->assertNull($lessonCompletedProgress['lottie_url']);
            }
            $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
            $currentStreakData = $userProgress->getStreakCurrentData();

            $this->assertEquals($completedLessons, $currentStreakData['current']);
            $this->assertEquals($completedLessons, $currentStreakData['best']);
            $this->assertEquals(0, $currentStreakData['missed']);
            $this->travel(1)->days();
        }
        $userProgress = ChallengeUserProgress::whereChallengeIdAndUser($this->challengeId, $userId);
        $this->assertFalse(boolval($userProgress->is_active));
        $this->assertEquals(10, $userProgress->completed_best_streak);
    }

    public function test_index_metadata_for_challenge() : void
    {
        $userId = user()->id;
        // --- PREP DATA -----
        // 402199 - 10 lessons - community challenge - enrolled
        $challengeId = 402199;
        $this->prep_challenge_index(0);
        $challengesService = app()->make(ChallengesService::class);

        $challengesService->startChallenge(402199, $userId);

        // --- RETRIEVE DATA ---

        $contentIds = [402199, 402200, 402201, 402202, 402203];
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['content_ids' => implode(',', $contentIds)]),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $responseData[$challengeId];

        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(0, $challengeMetadata['progress_percent']);
        $this->assertEquals('November 12 - 21', $challengeMetadata['duration_text']);
        $this->assertFalse(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('active', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_with_unlocked_lessons() : void
    {
        $userId = user()->id;
        $challengeId = 402200;
        // --- PREP DATA -----
        // 402200 - 8 of 10 lessons - community challenge - enrolled
        $this->prep_challenge_index(1);
        $challengesService = app()->make(ChallengesService::class);
        $challengesService->startChallenge($challengeId, $userId);

        // --- RETRIEVE DATA ---
        $contentIds = [402199, 402200, 402201, 402202, 402203];
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['content_ids' => implode(',', $contentIds)]),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $responseData[$challengeId];
        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(0, $challengeMetadata['progress_percent']);
        $this->assertEquals('Nov 27 - Dec 4', $challengeMetadata['duration_text']);
        $this->assertFalse(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('active', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_partially_completed_lesson() : void
    {
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
        $contentIds = [402199, 402200, 402201, 402202, 402203];
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['content_ids' => implode(',', $contentIds)]),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $responseData[$challengeId];
        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(40, $challengeMetadata['progress_percent']);
        $this->assertEquals('November 1 - 5', $challengeMetadata['duration_text']);
        $this->assertTrue(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('active', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_not_enrolled() : void
    {
        $userId = user()->id;
        // 402202 - 8 of 10 lessons - not enrolled
        $challengeId = 402202;
        $this->prep_challenge_index(3);
        $challengesService = app()->make(ChallengesService::class);

        // --- PREP DATA -----

        // --- RETRIEVE DATA ---
        $contentIds = [402199, 402200, 402201, 402202, 402203];
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['content_ids' => implode(',', $contentIds)]),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $responseData[$challengeId];
        $this->assertFalse($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(0, $challengeMetadata['progress_percent']);
        $this->assertEquals('November 1 - 8', $challengeMetadata['duration_text']);
        $this->assertNull($challengeMetadata['is_solo']);
        $this->assertEquals('not_started', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_unlocked() : void
    {
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
        $contentIds = [402199, 402200, 402201, 402202, 402203];
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['content_ids' => implode(',', $contentIds)]),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $responseData[$challengeId];
        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(20, $challengeMetadata['progress_percent']);
        $this->assertEquals('Unlocked', $challengeMetadata['duration_text']);
        $this->assertTrue(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('active', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_completed() : void
    {
        $userId = user()->id;
        // 402204 - 10 lessons - enrolled - completed
        $challengeId = 402204;
        $this->prep_challenge_index(5);
        $challengesService = app()->make(ChallengesService::class);

        // --- PREP DATA -----
        $userProgress = $challengesService->startChallenge($challengeId, $userId);
        $lessonMetadata = $userProgress->lessons_meta_data;
        // hack to complete the lessons without extra mocking. I'm lazy, and building the json files is a lot of work
        foreach($lessonMetadata as $index => $_) {
            $lessonMetadata[$index]['completed'] = true;
        }
        $userProgress->lessons_meta_data = $lessonMetadata;
        $userProgress->save();
        $challengesService->completeChallenge($challengeId, $userId);

        // --- RETRIEVE DATA ---
        $contentIds = [402204];
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['content_ids' => implode(',', $contentIds)]),
        );

        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $challengeMetadata = $responseData[$challengeId];
        $this->assertTrue($challengeMetadata['is_user_enrolled']);
        $this->assertEquals(100, $challengeMetadata['progress_percent']);
        $this->assertEquals('November 1 - 10', $challengeMetadata['duration_text']);
        $this->assertFalse(boolval($challengeMetadata['is_solo']));
        $this->assertEquals('completed', $challengeMetadata['status']);
    }

    public function test_index_metadata_for_challenge_that_doesnt_exist() : void
    {
        $userId = user()->id;
        $contentIds = [402199, 402200, 402201, 402202, 402203];
        $response = $this->getJson(
            route('challenges.user_progress_for_index_page', ['content_ids' => implode(',', $contentIds)]),
        );
        // --- TEST EXPECTED VALUES
        $response->assertOk();
        $responseData = $response->json();
        $this->assertEmpty($responseData);
    }

    private function prep_challenge_index($index) {
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
        });
    }

    public function test_milestones_for_length_11(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-11-lessons.json', 'challenge-child-11-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId, startDate: Carbon::now()->startOfDay()->toISOString());

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults($lesson_meta_datum['content_id'], $userId);
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 11) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonNumber == 6) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals("You're on a {$lessonNumber} Day Streak!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals("Return tomorrow to maintain your streak!", $lessonCompletedProgress['motivational_subtext']);
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
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId, startDate: Carbon::now()->startOfDay()->toISOString());

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults($lesson_meta_datum['content_id'], $userId);
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 11) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonNumber == 6) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals("You're on a {$lessonNumber} Day Streak!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals("Return tomorrow to maintain your streak!", $lessonCompletedProgress['motivational_subtext']);
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
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId, startDate: Carbon::now()->startOfDay()->toISOString());

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults($lesson_meta_datum['content_id'], $userId);
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
                $this->assertEquals("Return tomorrow to maintain your streak!", $lessonCompletedProgress['motivational_subtext']);
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
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId, startDate: Carbon::now()->startOfDay()->toISOString());

        foreach ($userProgress->lessons_meta_data as $index => $lesson_meta_datum) {
            $lessonCompletedProgress = $challengesService->completeLessonAndGetCurrentProgressResults($lesson_meta_datum['content_id'], $userId);
            $lessonNumber = $index + 1;
            $this->assertTrue($lessonCompletedProgress['show_modal']);
            if ($lessonNumber == 30) {
                $this->assertEquals('complete', $lessonCompletedProgress['milestone']);
                $this->assertStringContainsString("You've completed ", $lessonCompletedProgress['motivational_title']);
                $this->assertEmpty($lessonCompletedProgress['motivational_subtext']);
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } elseif ($lessonNumber % 5 == 0) {
                $this->assertEquals($lessonNumber, $lessonCompletedProgress['milestone']);
                $this->assertEquals("You're on a {$lessonNumber} Day Streak!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals(
                    "You've earned an additional freeze token!",
                    $lessonCompletedProgress['motivational_subtext']
                );
                $this->assertNotNull($lessonCompletedProgress['lottie_url']);
            } else {
                $this->assertNull($lessonCompletedProgress['milestone']);
                $this->assertEquals("You're done for the day!", $lessonCompletedProgress['motivational_title']);
                $this->assertEquals("Return tomorrow to maintain your streak!", $lessonCompletedProgress['motivational_subtext']);
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

    public function test_complete_lesson_for_unlocked_user(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-10-lessons.json', 'challenge-child-10-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId, startDate: Carbon::now()->startOfDay()->toISOString(), isLocked: false);
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

    private function mockChallengeAndLessonDataData($challengeFileName = 'challenge.json', $lessonFileName = 'challenge-child.json')
    {
        $path = Storage::disk("content_test_resources")->path($challengeFileName);
        $challengeJson = json_decode(file_get_contents($path), true);
        $lpath = Storage::disk("content_test_resources")->path($lessonFileName);
        $lessonJson = json_decode(file_get_contents($lpath), true);
        $_ = $this->mock(SanityGateway::class, function (MockInterface $mock) use ($challengeFileName, $lessonFileName, $challengeJson, $lessonJson) {
            $mock
                ->shouldReceive('getByRailContentId')
                ->andReturn($challengeJson);
            $mock
                ->shouldReceive('getChallengeChildAndParentData')
                ->andReturn($lessonJson);
        });
    }
}
