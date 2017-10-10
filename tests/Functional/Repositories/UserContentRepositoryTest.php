<?php

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\UserContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\UserContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserContentRepositoryTest extends RailcontentTestCase
{
    protected $classBeingTested, $userId;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(UserContentRepository::class);
        $this->userId = $this->createAndLogInNewUser();
        $this->setUserLanguage($this->userId);
    }

    public function test_start_content()
    {
        $content = [
           // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
        //$userId = 1;
        $state = UserContentService::STATE_STARTED;


        $userContentId = $this->classBeingTested->saveUserContent($contentId, $this->userId, $state);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContent,
            [
                'id' => $userContentId,
                'content_id' => $contentId,
                'user_id' => $this->userId,
                'state' => $state,
                'progress' => 0
            ]
        );
    }

    public function test_complete_content()
    {
        $content = [
           // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);
        //$userId = 1;

        $userContent = [
            'content_id' => $contentId,
            'user_id' => $this->userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 99)
        ];

        $userContentId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

        $progress = 100;
        $state = UserContentService::STATE_COMPLETED;

        $data = [
            'state' => $state,
            'progress' => $progress
        ];

        $this->classBeingTested->updateUserContent($contentId, $this->userId, $data);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContent,
            [
                'id' => $userContentId,
                'content_id' => $contentId,
                'user_id' => $this->userId,
                'state' => $state,
                'progress' => $progress
            ]
        );
    }

    public function test_save_user_progress_content()
    {
        $content = [
          //  'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

       // $userId = 1;

        $userContent = [
            'content_id' => $contentId,
            'user_id' => $this->userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 99)
        ];

        $userContentId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

        $progress = $this->faker->numberBetween(1, 99);

        $data = [
            'progress' => $progress
        ];

        $this->classBeingTested->updateUserContent($contentId, $this->userId, $data);

        $this->assertDatabaseHas(
            ConfigService::$tableUserContent,
            [
                'id' => $userContentId,
                'content_id' => $contentId,
                'user_id' => $this->userId,
                'state' => $userContent['state'],
                'progress' => $progress
            ]
        );
    }

    public function test_get_user_content()
    {
        $content = [
         //   'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

       //$userId = 1;

        $userContent = [
            'content_id' => $contentId,
            'user_id' => $this->userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 99)
        ];

        $userContentId = $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

        $results = $this->classBeingTested->getUserContent($contentId, $this->userId);

        $this->assertEquals(array_merge(['id' => $userContentId], $userContent), $results);
    }

}
