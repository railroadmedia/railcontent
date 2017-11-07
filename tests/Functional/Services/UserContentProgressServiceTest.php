<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Factories\ContentFactory;
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

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(UserContentProgressService::class);

        $this->contentFactory = $this->app->make(ContentFactory::class);
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
            'progress_percent' => $this->faker->numberBetween(0, 99)
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
            'progress_percent' => $this->faker->numberBetween(0, 99)
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
        $results = $this->classBeingTested->attachUserProgressToContents(rand(), []);

        $this->assertEquals([], $results);
    }

    public function test_attach_user_progress_to_content_no_progress()
    {
        $userId = rand();
        $content = $this->contentFactory->create();

        $results = $this->classBeingTested->attachUserProgressToContents($userId, [$content]);

        $content['user_progress'][$userId] = [];

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
            ];

            $expectedContents[] = $content;
        }

        $results = $this->classBeingTested->attachUserProgressToContents($userId, $expectedContents);

        $this->assertEquals($expectedContents, $results);
    }

}
