<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
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

        $this->populator = new Populator($this->faker, $this->entityManager);

        //        $this->contentFactory = $this->app->make(ContentFactory::class);
        //        $this->serviceBeingTested = $this->app->make(ContentService::class);
        //        $this->classBeingTested = $this->app->make(ContentRepository::class);
        //        $this->userId = $this->createAndLogInNewUser();
    }

    public function test_start_content()
    {
        $userId = $this->createAndLogInNewUser();

        $this->populator->addEntity(
            Content::class,
            1,
            [
                'slug' => $this->faker->word,
                'brand' => ConfigService::$brand,
                'type' => $this->faker->word,
                'status' => $this->faker->word
            ]
        );
        $fakeData = $this->populator->execute();

        $response = $this->put(
            'railcontent/start',
            [
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'id' => $fakeData[Content::class][0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));
    }

    public function test_start_content_invalid_content_id()
    {
        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => 1,
            ]
        );

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson('meta');
        $responseErrors = $responseContent['errors'];

        $expectedErrors = [
            "source" => "content_id",
            "detail" => "The selected content id is invalid.",
        ];

        $this->assertEquals([$expectedErrors], $responseErrors);

    }

    public function test_complete_content()
    {
        $content = $this->contentFactory->create();
        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => $content['id'],
            ]
        );

        $response = $this->put(
            'railcontent/complete',
            [
                'content_id' => $content['id'],
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data')[0][0]);
        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'content_id' => $content['id'],
                'user_id' => $this->userId,
                'state' => UserContentProgressService::STATE_COMPLETED,
                'progress_percent' => 100,
                'updated_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
    }

    public function test_complete_content_invalid_content_id()
    {
        $response = $this->put(
            'railcontent/complete',
            [
                'content_id' => 1,
            ]
        );

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson('meta');
        $responseErrors = $responseContent['errors'];

        $expectedErrors = [
            "source" => "content_id",
            "detail" => "The selected content id is invalid.",
        ];

        $this->assertEquals([$expectedErrors], $responseErrors);
    }

    public function test_save_user_progress_on_content()
    {
        $content = $this->contentFactory->create();

        $userContent = [
            'content_id' => $content['id'],
            'user_id' => $this->userId,
            'state' => UserContentProgressService::STATE_STARTED,
            'progress_percent' => $this->faker->numberBetween(0, 10),
            'updated_on' => Carbon::now()
                ->toDateTimeString(),
        ];

        $this->query()
            ->table(ConfigService::$tableUserContentProgress)
            ->insertGetId($userContent);

        $response = $this->put(
            'railcontent/progress',
            [
                'content_id' => $content['id'],
                'progress_percent' => $this->faker->numberBetween(10, 99),
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data')[0][0]);
    }

    public function test_save_user_progress_on_content_inexistent()
    {
        $contentId = $this->faker->numberBetween();

        $response = $this->put(
            'railcontent/progress',
            [
                'content_id' => $contentId,
                'progress_percent' => $this->faker->numberBetween(10, 99),
            ]
        );

        $this->assertEquals(422, $response->status());

        $responseContent = $response->decodeResponseJson('meta');
        $responseErrors = $responseContent['errors'];

        $expectedErrors = [
            "source" => "content_id",
            "detail" => "The selected content id is invalid.",
        ];

        $this->assertEquals([$expectedErrors], $responseErrors);
    }
}
