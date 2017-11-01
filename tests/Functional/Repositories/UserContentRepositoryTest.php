<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\UserContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\UserContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserContentRepositoryTest extends RailcontentTestCase
{
    /**
     * @var UserContentRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(UserContentRepository::class);
    }

    public function test_start_content()
    {
        $contentId = $this->faker->randomNumber();
        $userId = $this->faker->randomNumber();

        $state = UserContentService::STATE_STARTED;

        $userContentId = $this->classBeingTested->saveUserContent($contentId, $userId, $state);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'id' => $userContentId,
                'content_id' => $contentId,
                'user_id' => $userId,
                'state' => $state,
                'progress' => 0
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
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 99)
        ];
        $userContentId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

        $progress = 100;
        $state = UserContentService::STATE_COMPLETED;

        $data = [
            'state' => $state,
            'progress' => $progress
        ];

        $this->classBeingTested->updateUserContent($contentId, $userId, $data);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'id' => $userContentId,
                'content_id' => $contentId,
                'user_id' => $userId,
                'state' => $state,
                'progress' => $progress
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
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 99)
        ];
        $userContentId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

        $progress = $this->faker->numberBetween(1, 99);

        $data = [
            'progress' => $progress
        ];

        $this->classBeingTested->updateUserContent($contentId, $userId, $data);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'id' => $userContentId,
                'content_id' => $contentId,
                'user_id' => $userId,
                'state' => $userContent['state'],
                'progress' => $progress
            ]
        );
    }

    public function test_get_user_content()
    {
        $contentId = $this->faker->randomNumber();
        $userId = $this->faker->randomNumber();

        $userContent = [
            'content_id' => $contentId,
            'user_id' => $userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 99)
        ];
        $userContentId = $this->query()->table(ConfigService::$tableUserContentProgress)->insertGetId($userContent);

        $results = $this->classBeingTested->getUserContent($contentId, $userId);

        $this->assertEquals(array_merge(['id' => $userContentId], $userContent), $results);
    }

}
