<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Railroad\Railcontent\Repositories\UserContentProgressRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserContentProgressRepositoryTest extends RailcontentTestCase
{
    /**
     * @var UserContentProgressRepository
     */
    protected $classBeingTested;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(UserContentProgressRepository::class);
    }

    public function test_start_content()
    {
        $contentId = $this->faker->randomNumber();
        $userId = $this->faker->randomNumber();

        $state = UserContentProgressService::STATE_STARTED;

        $userContentId = $this->classBeingTested->create(
            [
                'content_id' => $contentId,
                'user_id' => $userId,
                'state' => $state,
            ]
        );

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

        $this->classBeingTested->updateOrCreate(
            [
                'content_id' => $contentId,
                'user_id' => $userId,
            ],
            $data
        );

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

        $progress = $this->faker->numberBetween(1, 99);

        $data = [
            'progress_percent' => $progress
        ];

        $this->classBeingTested->updateOrCreate(
            [
                'content_id' => $contentId,
                'user_id' => $userId,
            ],
            $data
        );

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

}
