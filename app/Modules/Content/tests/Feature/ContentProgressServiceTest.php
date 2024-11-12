<?php

namespace App\Modules\Content\tests\Feature;

use App\Modules\Content\Enums\ProgressState;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentHierarchy;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ContentProgressService;
use App\Modules\RailTracker\database\Factories\MediaPlaybackSessionFactory;
use App\Modules\RailTracker\Enums\MediaTypeEnum;
use App\Modules\RailTracker\Models\MediaPlaybackSession;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class ContentProgressServiceTest extends TestCase
{
    private ContentProgressService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(ContentProgressService::class);
    }

    private function getNewContent(): Content
    {
        return Content::factory()->create();
    }

    public function test_start_content()
    {
        $userId = User::factory()->create()->id;
        $content = $this->getNewContent();

        $this->service->startContent($content->id, $userId);

        $this->assertProgress($content, $userId, ProgressState::Started, 0);
    }

    public function test_save_complete_content()
    {
        $userId = User::factory()->create()->id;
        $content = $this->getNewContent();
        $progress = $this->faker->numberBetween(1, 100);

        $this->service->saveContentProgress($content->id, $progress, $userId);
        $this->service->completeContent($content->id, $userId);

        $this->assertProgress($content, $userId, ProgressState::Completed, 100);
    }

    public function test_complete_content()
    {
        $userId = User::factory()->create()->id;
        $content = $this->getNewContent();

        $this->service->completeContent($content->id, $userId);

        $this->assertProgress($content, $userId, ProgressState::Completed, 100);
    }

    public function test_complete_children()
    {
        $userId = User::factory()->create()->id;
        $content = $this->getNewContent();
        $content1 = $this->getNewContent();
        ContentHierarchy::createHierarchy($content->id, $content1->id);

        $this->service->completeContent($content->id, $userId);

        $this->assertProgress($content, $userId, ProgressState::Completed, 100);
        $this->assertProgress($content1, $userId, ProgressState::Completed, 100);
    }

    public function test_save_user_progress_content()
    {
        $userId = User::factory()->create()->id;
        $content = $this->getNewContent();
        $progress = $this->faker->numberBetween(1, 100);

        $this->service->saveContentProgress($content->id, $progress, $userId);
        $this->assertProgress($content, $userId, ProgressState::Started, $progress);
    }

    private function assertProgress($content, $userId, $state, $progress): void
    {
        $this->assertDatabaseHas(
            ContentUserProgress::class,
            [
                'content_id' => $content->id,
                'user_id' => $userId,
                'state' => $state,
                'progress_percent' => $progress,
            ]
        );
    }

    public function test_get_child_ids()
    {
        $content = $this->getNewContent();
        $content1 = $this->getNewContent();
        $content2 = $this->getNewContent();
        $content3 = $this->getNewContent();
        $content4 = $this->getNewContent();
        ContentHierarchy::createHierarchy($content->id, $content1->id);
        ContentHierarchy::createHierarchy($content1->id, $content2->id);
        ContentHierarchy::createHierarchy($content2->id, $content3->id);
        ContentHierarchy::createHierarchy($content2->id, $content4->id);

        //top level - full
        $childIds = $this->service->getChildIds($content->id);
        $this->assertEquals([$content1->id, $content2->id, $content3->id, $content4->id], $childIds);

        //top level - 1 depth
        $childIds = $this->service->getChildIds($content->id, 1);
        $this->assertEquals([$content1->id], $childIds);

        //middle
        $childIds = $this->service->getChildIds($content2->id);
        $this->assertEquals([$content3->id, $content4->id], $childIds);

        //bottom
        $childIds = $this->service->getChildIds($content4->id);
        $this->assertEquals([], $childIds);
    }

    public function test_progress_bubble_started()
    {
        $userId = User::factory()->create()->id;
        $content = $this->getNewContent();
        $content1 = $this->getNewContent();
        ContentHierarchy::createHierarchy($content->id, $content1->id);

        $this->service->startContent($content1->id, $userId);
        $this->assertProgress($content, $userId, ProgressState::Started, 0);
        $this->assertProgress($content1, $userId, ProgressState::Started, 0);
    }

    public function test_progress_bubble_completed()
    {
        $userId = User::factory()->create()->id;
        $content = $this->getNewContent();
        $content1 = $this->getNewContent();
        ContentHierarchy::createHierarchy($content->id, $content1->id);

        $this->service->completeContent($content->id, $userId);
        $this->assertProgress($content, $userId, ProgressState::Completed, 100);
        $this->assertProgress($content1, $userId, ProgressState::Completed, 100);
    }

    public function test_progress_bubble_calculates_percentage()
    {
        $userId = User::factory()->create()->id;
        $content = $this->getNewContent();
        $content1 = $this->getNewContent();
        $content2 = $this->getNewContent();
        ContentHierarchy::createHierarchy($content->id, $content1->id);
        ContentHierarchy::createHierarchy($content->id, $content2->id);

        $this->service->saveContentProgress($content1->id, 100, $userId);
        $this->assertProgress($content, $userId, ProgressState::Started, 50);
        $this->assertProgress($content1, $userId, ProgressState::Completed, 100);
    }

    public function test_update_progress_from_session()
    {
        $user = User::factory()->create();
        $content = $this->getNewContent();
        $session = MediaPlaybackSessionFactory::createSession(
            $user,
            $content,
            MediaTypeEnum::VideoYouTube,
            100,
            10,
            10
        );
        $this->service->updateContentProgress($session, $content);
        $this->assertProgress($content, $user->id, ProgressState::Started, 10);

    }

//    public function test_progress_bubble_not_allowed_type()
//    {
//        // One ---------------------------------------------------------------------------------------------------------
//        // Set up some basic variables ---------------------------------------------------------------------------------
//
//        $userId = rand();
//        $type = $this->faker->word;
//        $numberOfChildren = 5;
//        $content = [];
//
//
//        // Two ---------------------------------------------------------------------------------------------------------
//        // Create the content ------------------------------------------------------------------------------------------
//
//        //$parent = $this->contentFactory->create(null, $type);
//        $parent = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);
//
//        if (in_array($type, $this->allowedTypes)) { // todo: update per new config structure
//            $this->markTestIncomplete('This test must be updated as per new config structure.');
//            $this->fail(
//                'Oops, Faker just so happened to have picked a random word that was also the random "' .
//                'allowed type" set for this test. Just run this test again and things will likely be just fine.'
//            );
//        }
//
//        for ($i = 0; $i < $numberOfChildren; $i++) {
//            //$content[$i] = $this->contentFactory->create(null, $type);
//            $content[$i] = $this->contentFactory->create($this->faker->words(rand(2, 6), true), $type);
//            $this->contentHierarchyService->create($parent['id'], $content[$i]['id'], $i + 1);
//        }
//
//
//        // Three -------------------------------------------------------------------------------------------------------
//        // Make sure that the parent is as expected at this point, so that it's change marks success -------------------
//
//        $parentWithProgressAttached = $this->service->attachProgressToContents(
//            $userId,
//            $this->contentService->getById($parent['id'])
//        );
//
//        if ($parentWithProgressAttached[UserContentProgressService::STATE_STARTED]) {
//            $this->fail('$parentWithProgressAttached[\'started\'] should be false at this point in the test');
//        }
//
//
//        // Four --------------------------------------------------------------------------------------------------------
//        // Pick a child at random, setting their "started" state to true. This should then trigger
//        // UserContentProgressService's "bubbleProgress" method—which is what we're aiming to test here.
//
//        $randomChild = $content[rand(0, $numberOfChildren - 1)];
//        $this->service->startContent($randomChild['id'], $userId);
//
//
//        // Five --------------------------------------------------------------------------------------------------------
//        // Check that parent was updated as expected -------------------------------------------------------------------
//
//        $parentWithProgressAttached = $this->service->attachProgressToContents(
//            $userId,
//            $this->contentService->getById($parent['id'])
//        );
//
//        $this->assertFalse($parentWithProgressAttached[UserContentProgressService::STATE_STARTED]);
//    }
//
//    public function test_progress_bubble_does_not_start_parents_that_are_not_allowed_type()
//    {
//        $this->parentBubblingRestrictionTestSubRoutine($this->typeAllowedForCompletedButNotStarted);
//
//        // ensure child type is irrelevant
//        $this->parentBubblingRestrictionTestSubRoutine($this->typeAllowedForStartedButNotCompleted);
//    }
//
//    private function parentBubblingRestrictionTestSubRoutine($childType)
//    {
//        $userId = rand();
//        $numberOfChildren = 5;
//        $content = [];
//
//        // create content
//
//        $parent = $this->contentFactory->create(
//            $this->faker->words(rand(2, 6), true),
//            $this->typeAllowedForCompletedButNotStarted
//        );
//
//        for ($i = 0; $i < $numberOfChildren; $i++) {
//            $content[$i] = $this->contentFactory->create(
//                $this->faker->words(rand(2, 6), true),
//                $childType
//            );
//            $this->contentHierarchyService->create($parent['id'], $content[$i]['id'], $i + 1);
//        }
//
//        // Make sure that the parent is as expected at this point, so that it's change marks success
//
//        $parentWithProgressAttached = $this->service->attachProgressToContents(
//            $userId,
//            $this->contentService->getById($parent['id'])
//        );
//
//        if ($parentWithProgressAttached[UserContentProgressService::STATE_STARTED]) {
//            $this->fail('$parentWithProgressAttached[\'started\'] should be false at this point in the test');
//        }
//
//        // Pick a child at random, setting their "started" state to true. This will then trigger...
//        // ...UserContentProgressService's "bubbleProgress" method.
//
//        $randomChild = $content[rand(0, $numberOfChildren - 1)];
//        $this->service->startContent($randomChild['id'], $userId);
//
//        // assert parent NOT started
//
//        $parentWithProgressAttached = $this->service->attachProgressToContents(
//            $userId,
//            $this->contentService->getById($parent['id'])
//        );
//
//        $this->assertFalse($parentWithProgressAttached[UserContentProgressService::STATE_STARTED]);
//    }
//
//    public function test_started_restricted_parent_progress_calculated_from_children_when_started()
//    {
//        $userId = rand();
//        $numberOfChildren = 5;
//        $content = [];
//
//        // Create the content
//
//        $parent = $this->contentFactory->create(
//            $this->faker->words(rand(2, 6), true),
//            $this->typeAllowedForCompletedButNotStarted
//        );
//
//        for ($i = 0; $i < $numberOfChildren; $i++) {
//            $content[$i] = $this->contentFactory->create(
//                $this->faker->words(rand(2, 6), true),
//                $this->typeAllowedForStartedButNotCompleted
//            );
//            $this->contentHierarchyService->create($parent['id'], $content[$i]['id'], $i + 1);
//        }
//
//        // Make sure that the parent is as expected at this point, so that it's change marks success
//
//        $parentWithProgressAttached = $this->service->attachProgressToContents(
//            $userId,
//            $this->contentService->getById($parent['id'])
//        );
//
//        if ($parentWithProgressAttached[UserContentProgressService::STATE_STARTED]) {
//            $this->fail('$parentWithProgressAttached[\'started\'] should be false at this point in the test');
//        }
//
//        // set two child (of 5) each to 80 percent.
//
//        $twoRandomChildren = $this->faker->randomElements($content, 2);
//
//        foreach ($twoRandomChildren as $child) {
//            $this->service->saveContentProgress($child['id'], 80, $userId);
//        }
//
//        // assert the parent still has no record.
//
//        $parentWithProgressAttached = $this->service->attachProgressToContents(
//            $userId,
//            $this->contentService->getById($parent['id'])
//        );
//
//        if (!empty($parentWithProgressAttached['user_progress'][$userId])) {
//            $this->fail('$parentWithProgressAttached[\'started\'] should be false at this point in the test');
//        }
//
//        // start the parent
//
//        $this->service->startContent($parent['id'], $userId);
//
//        // assert that the parent has the progress_percent value of (80*2/5) 32
//
//        $parentWithProgressAttached = $this->service->attachProgressToContents(
//            $userId,
//            $this->contentService->getById($parent['id'])
//        );
//
//        $parentProgress = $parentWithProgressAttached['user_progress'][$userId];
//
//        $this->assertEquals(32, $parentProgress['progress_percent']);
//    }
}
