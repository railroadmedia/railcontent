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
        $this->assertEquals(2, count($userData['users']));
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
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId);

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

    public function test_milestones_for_length_30(): void
    {
        $userId = user()->id;
        $this->mockChallengeAndLessonDataData('challenge-30-lessons.json', 'challenge-child-30-lessons.json');
        $challengesService = app()->make(ChallengesService::class);
        $this->travelTo(now()->startOfDay());
        $this->travel(100)->minutes();
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId);

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
        $userProgress = $challengesService->startChallenge($this->challengeId, $userId, isLocked: false);
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
