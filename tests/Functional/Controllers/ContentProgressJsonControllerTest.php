<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentProgressJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentRepository
     */
    protected $classBeingTested;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    protected $serviceBeingTested;

    protected $userId;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->serviceBeingTested = $this->app->make(ContentService::class);
        $this->classBeingTested = $this->app->make(ContentRepository::class);
        $this->userId = $this->createAndLogInNewUser();
    }

    public function test_start_content()
    {
        $content = $this->contentFactory->create();
        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => $content['id']
            ]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(1, $response->content());
    }

    public function test_start_content_invalid_content_id()
    {
        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => 1
            ]);

        $this->assertEquals(422, $response->status());
        $responseContent = json_decode($response->content(), true);
        $responseErrors = $responseContent['errors'];

        $expectedErrors = [
            "source" => "content_id",
            "detail" => "The selected content id is invalid."
        ];

        $this->assertEquals([$expectedErrors], $responseErrors);

    }

    public function test_complete_content()
    {
        $content = $this->contentFactory->create();

        $userContent = [
            'content_id' => $content['id'],
            'user_id' => $this->userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 99)
        ];

        $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

        $response = $this->put(
            'railcontent/complete',
            [
                'content_id' => $content['id']
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertEquals('true', $response->content());
    }

    public function test_complete_content_invalid_content_id()
    {
        $response = $this->put('railcontent/complete',
            [
                'content_id' => 1
            ]
        );

        $this->assertEquals(422, $response->status());

        $responseContent = json_decode($response->content(), true);
        $responseErrors = $responseContent['errors'];

        $expectedErrors = [
            "source" => "content_id",
            "detail" => "The selected content id is invalid."
        ];

        $this->assertEquals([$expectedErrors], $responseErrors);
    }

    public function test_save_user_progress_on_content()
    {
        $content = $this->contentFactory->create();

        $userContent = [
            'content_id' => $content['id'],
            'user_id' => $this->userId,
            'state' => UserContentService::STATE_STARTED,
            'progress' => $this->faker->numberBetween(0, 10)
        ];

        $this->query()->table(ConfigService::$tableUserContent)->insertGetId($userContent);

        $response = $this->put('railcontent/progress',
            [
                'content_id' => $content['id'],
                'progress' => $this->faker->numberBetween(10, 99)
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertEquals('true', $response->content());
    }

    public function test_save_user_progress_on_content_inexistent()
    {
        $contentId = 1;

        $response = $this->put('railcontent/progress',
            [
                'content_id' => $contentId,
                'progress' => $this->faker->numberBetween(10, 99)
            ]);

        $this->assertEquals(422, $response->status());

        $responseContent = json_decode($response->content(), true);
        $responseErrors = $responseContent['errors'];

        $expectedErrors = [
            "source" => "content_id",
            "detail" => "The selected content id is invalid."
        ];

        $this->assertEquals([$expectedErrors], $responseErrors);
    }
}
