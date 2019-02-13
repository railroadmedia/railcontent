<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentProgressJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function test_start_content()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent();

        $response = $this->put(
            'railcontent/start',
            [
                'data' => [
                    'relationships' => [
                        'content' => [
                            'data' => [
                                'id' => $content[0]->getId(),
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

        $content = $this->fakeContent();
        $contentId = $content[0]->getId();

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
        $this->createAndLogInNewUser();

        $content = $this->fakeContent();
        $contentId = $content[0]->getId();

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
