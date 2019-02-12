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
                'status' => $this->faker->word,
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
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'id' => rand(1, 100),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson('errors');

        $expectedErrors = [
            "source" => "data.relationships.content.data.id",
            "detail" => "The selected content is invalid.",
            'title' => 'Validation failed.',
        ];

        $this->assertEquals([$expectedErrors], $responseContent);

    }

    public function test_complete_content()
    {
        $userId = $this->createAndLogInNewUser();

        $this->populator->addEntity(
            Content::class,
            1,
            [
                'slug' => $this->faker->word,
                'brand' => ConfigService::$brand,
                'type' => $this->faker->word,
                'status' => $this->faker->word,
            ]
        );
        $fakeData = $this->populator->execute();
        $contentId = $fakeData[Content::class][0]->getId();
        $response = $this->put(
            'railcontent/start',
            [
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'id' => $contentId,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $response = $this->put(
            'railcontent/complete',
            [
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'id' => $contentId,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));
        $this->assertDatabaseHas(
            ConfigService::$tableUserContentProgress,
            [
                'content_id' => $contentId,
                'user_id' => $userId,
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
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'id' => rand(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson('errors');

        $expectedErrors = [
            "source" => "data.relationships.content.data.id",
            "detail" => "The selected content is invalid.",
            'title' => 'Validation failed.',
        ];

        $this->assertEquals([$expectedErrors], $responseContent);
    }

    public function test_save_user_progress_on_content()
    {
        $userId = $this->createAndLogInNewUser();

        $this->populator->addEntity(
            Content::class,
            1,
            [
                'slug' => $this->faker->word,
                'brand' => ConfigService::$brand,
                'type' => $this->faker->word,
                'status' => $this->faker->word,
            ]
        );
        $fakeData = $this->populator->execute();
        $contentId = $fakeData[Content::class][0]->getId();

        $response = $this->put(
            'railcontent/progress',
            [
                'data' => [
                    'attributes' => [
                        'progress_percent' => $this->faker->numberBetween(10, 99),
                    ],
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'id' => $contentId,
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));
    }

    public function test_save_user_progress_on_content_inexistent()
    {
        $contentId = $this->faker->numberBetween();

        $response = $this->put(
            'railcontent/progress',
            [
                'data' => [
                    'attributes' => [
                        'progress_percent' => $this->faker->numberBetween(10, 99),
                    ],
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'id' => rand(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $response->status());

        $responseContent = $response->decodeResponseJson('errors');

        $expectedErrors = [
            "source" => "data.relationships.content.data.id",
            "detail" => "The selected content is invalid.",
            'title' => 'Validation failed.',
        ];

        $this->assertEquals([$expectedErrors], $responseContent);
    }
}
