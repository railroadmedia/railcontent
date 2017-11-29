<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Factories\UserContentProgressFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserContentProgressServiceTest extends RailcontentTestCase
{
    /**
     * @var UserContentProgressService
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentHierarchyFactory
     */
    protected $contentHierarchyFactory;

    /**
     * @var UserContentProgressFactory
     */
    protected $userContentProgressFactory;

    protected function setUp()
    {
        // $this->setConnectionType('mysql');
        parent::setUp();

        $this->classBeingTested = $this->app->make(UserContentProgressService::class);

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
        $this->userContentProgressFactory = $this->app->make(UserContentProgressFactory::class);

    }

    public function test_start_content()
    {
        $contentId = $this->faker->randomNumber();
        $userId = $this->faker->randomNumber();

        $state = UserContentProgressService::STATE_STARTED;

        $userContentId = $this->classBeingTested->startContent($contentId, $userId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'id' => $userContentId,
                'content_id' => $contentId,
                'user_id' => $userId,
                'state' => $state,
                'progress_percent' => 0
            ]
        );
    }

    public function test_complete_content()
    {
        $contentId = $this->faker->randomNumber();
        $userId = $this->faker->randomNumber();

        $userContent = [
            'content_id' => $contentId,
            'user_id' => $userId,
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 99),
            'updated_on' => Carbon::now()->toDateString()
        ];
        $userContentId =
            $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

        $progress = 100;
        $state = UserContentProgressService::STATE_COMPLETED;

        $data = [
            'state' => $state,
            'progress_percent' => $progress
        ];

        $this->classBeingTested->completeContent($contentId, $userId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'id' => $userContentId,
                'content_id' => $contentId,
                'user_id' => $userId,
                'state' => $state,
                'progress_percent' => $progress
            ]
        );
    }

    public function test_save_user_progress_content()
    {
        $contentId = $this->faker->randomNumber();
        $userId = $this->faker->randomNumber();

        $userContent = [
            'content_id' => $contentId,
            'user_id' => $userId,
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 99),
            'updated_on' => Carbon::now()->toDateString()
        ];

        $userContentId =
            $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

        $progress = $this->faker->numberBetween(1, 100);

        $this->classBeingTested->saveContentProgress($contentId, $progress, $userId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'id' => $userContentId,
                'content_id' => $contentId,
                'user_id' => $userId,
                'state' => $userContent['state'],
                'progress_percent' => $progress
            ]
        );
    }

    public function test_attach_user_progress_to_content_empty()
    {
        $results = $this->classBeingTested->attachProgressToContents(rand(), []);

        $this->assertEquals([], $results);
    }

    public function test_attach_user_progress_to_content_no_progress()
    {
        $userId = rand();
        $content = $this->contentFactory->create();

        $results = $this->classBeingTested->attachProgressToContents($userId, [$content]);

        $content['user_progress'][$userId] = [];
        $content['completed'] = false;
        $content['started'] = false;

        $this->assertEquals([$content], $results);
    }

    public function test_attach_user_progress_to_contents_with_progress()
    {
        $userId = rand();

        $expectedContents = [];

        for ($i = 0; $i < 3; $i++) {
            $content = $this->contentFactory->create();

            $this->classBeingTested->startContent($content['id'], $userId);

            $content['user_progress'][$userId] = [
                'id' => $i + 1,
                'content_id' => $i + 1,
                'user_id' => $userId,
                'state' => 'started',
                'progress_percent' => '0',
                'updated_on' => Carbon::now()->toDateTimeString()
            ];
            $content['started'] = true;
            $content['completed'] = false;

            $expectedContents[] = $content;
        }

        $results = $this->classBeingTested->attachProgressToContents($userId, $expectedContents);

        $this->assertEquals($expectedContents, $results);
    }

    public function test_complete_child_and_parent()
    {
        $userId = $this->faker->randomNumber();
        $parent = $this->contentFactory->create();

        $child = $this->contentFactory->create();
        $child2 = $this->contentFactory->create();
        $child3 = $this->contentFactory->create();

        $hierarchy = $this->contentHierarchyFactory->create($parent['id'], $child['id'], 1);
        $hierarchy2 = $this->contentHierarchyFactory->create($parent['id'], $child2['id'], 2);
        $hierarchy3 = $this->contentHierarchyFactory->create($parent['id'], $child3['id'], 3);

        $this->userContentProgressFactory->startContent($parent['id'], $userId);
        $this->userContentProgressFactory->completeContent($child2['id'], $userId);
        $this->userContentProgressFactory->completeContent($child3['id'], $userId);

        $results = $this->classBeingTested->completeContent($child['id'], $userId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'content_id' => $child['id'],
                'user_id' => $userId,
                'state' => UserContentProgressService::STATE_COMPLETED,
                'progress_percent' => 100
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'content_id' => $parent['id'],
                'user_id' => $userId,
                'state' => UserContentProgressService::STATE_COMPLETED,
                'progress_percent' => 100
            ]
        );
    }

    public function test_parent_not_completed_if_the_children_are_not_completed()
    {
        $userId = $this->faker->randomNumber();
        $parent = $this->contentFactory->create();

        $child = $this->contentFactory->create();
        $child2 = $this->contentFactory->create();
        $child3 = $this->contentFactory->create();

        $hierarchy = $this->contentHierarchyFactory->create($parent['id'], $child['id'], 1);
        $hierarchy2 = $this->contentHierarchyFactory->create($parent['id'], $child2['id'], 2);
        $hierarchy3 = $this->contentHierarchyFactory->create($parent['id'], $child3['id'], 3);

        $this->userContentProgressFactory->startContent($parent['id'], $userId);
        $this->userContentProgressFactory->startContent($child2['id'], $userId);

        $results = $this->classBeingTested->completeContent($child['id'], $userId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'content_id' => $child['id'],
                'user_id' => $userId,
                'state' => UserContentProgressService::STATE_COMPLETED,
                'progress_percent' => 100
            ]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableUserContentProgress,
            [
                'content_id' => $parent['id'],
                'user_id' => $userId,
                'state' => UserContentProgressService::STATE_COMPLETED,
                'progress_percent' => 100
            ]
        );
    }

    public function test_complete_parent_content()
    {
        $userId = $this->faker->randomNumber();
        $parent = $this->contentFactory->create();

        $results = $this->classBeingTested->completeContent($parent['id'], $userId);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'content_id' => $parent['id'],
                'user_id' => $userId,
                'state' => UserContentProgressService::STATE_COMPLETED,
                'progress_percent' => 100
            ]
        );
    }

}
