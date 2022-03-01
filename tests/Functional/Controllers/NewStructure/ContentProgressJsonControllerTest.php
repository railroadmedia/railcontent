<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\NewStructure;

use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Listeners\UserContentProgressEventListener;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentProgressJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
        ResponseService::$oldResponseStructure = false;
    }

    public function test_start_content()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(1, [
            'status' => 'published',
        ]);

        $response = $this->put('railcontent/start', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));
    }

    public function test_start_content_invalid_content_id()
    {
        $response = $this->put('railcontent/start', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => rand(1, 100),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson('errors');

        $expectedErrors = [
            "source" => "data.relationships.content.data.id",
            "detail" => "The selected content id is invalid.",
            'title' => 'Validation failed.',
        ];

        $this->assertEquals([$expectedErrors], $responseContent);
    }

    public function test_complete_content()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(1, [
            'status' => 'published',
        ]);
        $contentId = $content[0]->getId();

        $response = $this->put('railcontent/start', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $contentId,
                        ],
                    ],
                ],
            ],
        ]);

        $response = $this->put('railcontent/complete', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $contentId,
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));
        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'content_id' => $contentId,
            'user_id' => $userId,
            'state' => UserContentProgressService::STATE_COMPLETED,
            'progress_percent' => 100,
            'updated_on' => Carbon::now()
                ->toDateTimeString(),
        ]);
    }

    public function test_complete_content_invalid_content_id()
    {
        $response = $this->put('railcontent/complete', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => rand(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson('errors');

        $expectedErrors = [
            "source" => "data.relationships.content.data.id",
            "detail" => "The selected content id is invalid.",
            'title' => 'Validation failed.',
        ];

        $this->assertEquals([$expectedErrors], $responseContent);
    }

    public function test_save_user_progress_on_content()
    {
        $this->createAndLogInNewUser();

        $content = $this->fakeContent(1, [
            'status' => 'published',
        ]);

        $contentId = $content[0]->getId();
        $percent = $this->faker->numberBetween(10, 99);

        $response = $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => $percent,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $contentId,
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[0]->getId(),
            'progress_percent' => $percent,
        ]);
    }

    public function test_save_user_progress_on_content_inexistent()
    {
        $contentId = $this->faker->numberBetween();

        $response = $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => $this->faker->numberBetween(
                        10,
                        99
                    ),
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => rand(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(422, $response->status());

        $responseContent = $response->decodeResponseJson('errors');

        $expectedErrors = [
            "source" => "data.relationships.content.data.id",
            "detail" => "The selected content id is invalid.",
            'title' => 'Validation failed.',
        ];

        $this->assertEquals([$expectedErrors], $responseContent);
    }

    public function test_start_child_and_parent_content()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(2, [
            'status' => 'published',
            'type' => 'course',
        ]);

        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[1]->getId(),
                             ]);

        $response = $this->put('railcontent/start', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[1]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[0]->getId(),
            'progress_percent' => 0,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[1]->getId(),
            'progress_percent' => 0,
        ]);
    }

    public function test_start_child_and_recalculate_parent_progress()
    {
        $userId = $this->createAndLogInNewUser();

        $progressChild1 = 30;

        $content = $this->fakeContent(3, [
            'status' => 'published',
            'type' => 'course',
        ]);

        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[1]->getId(),
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[2]->getId(),
                             ]);

        $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => $progressChild1,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[2]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $response = $this->put('railcontent/start', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[1]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[0]->getId(),
            'progress_percent' => $progressChild1 / 2,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[1]->getId(),
            'progress_percent' => 0,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[2]->getId(),
            'progress_percent' => $progressChild1,
        ]);
    }

    public function test_complete_child_and_recalculate_parent_progress()
    {
        $userId = $this->createAndLogInNewUser();
        $progressChild1 = 30;

        $content = $this->fakeContent(3, [
            'status' => 'published',
            'type' => 'course',
        ]);

        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[1]->getId(),
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[2]->getId(),
                             ]);

        $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => $progressChild1,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[2]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $response = $this->put('railcontent/complete', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[1]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'completed',
            'content_id' => $content[1]->getId(),
            'progress_percent' => 100,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[2]->getId(),
            'progress_percent' => $progressChild1,
        ]);
    }

    public function test_complete_parent()
    {
        Event::fake();

        $userId = $this->createAndLogInNewUser();
        $progressChild1 = 30;

        $content = $this->fakeContent(3, [
            'status' => 'published',
            'type' => 'course',
        ]);

        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[1]->getId(),
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[2]->getId(),
                             ]);

        $this->put('railcontent/start', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $response = $this->put('railcontent/complete', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'completed',
            'content_id' => $content[0]->getId(),
            'progress_percent' => 100,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'completed',
            'content_id' => $content[1]->getId(),
            'progress_percent' => 100,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'completed',
            'content_id' => $content[2]->getId(),
            'progress_percent' => 100,
        ]);

        //check that the ContentCreated event was dispatched with the correct content id
        Event::assertDispatched(
            UserContentProgressSaved::class,
            function ($event) use ($content) {
                return $event->content->getId() == $content[1]->getId();
            }
        );
    }

    public function test_mark_complete_last_incomplete_children()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(3, [
            'status' => 'published',
            'type' => 'course',
        ]);

        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[1]->getId(),
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[2]->getId(),
                             ]);

        $this->put('railcontent/complete', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[2]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $response = $this->put('railcontent/complete', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[1]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'completed',
            'content_id' => $content[0]->getId(),
            'progress_percent' => 100,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'completed',
            'content_id' => $content[1]->getId(),
            'progress_percent' => 100,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'completed',
            'content_id' => $content[2]->getId(),
            'progress_percent' => 100,
        ]);
    }

    public function test_save_child_user_progress()
    {
        $userId = $this->createAndLogInNewUser();
        $progressPercentChild2 = 30;

        $content = $this->fakeContent(3, [
            'status' => 'published',
            'type' => 'course',
        ]);

        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[1]->getId(),
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[2]->getId(),
                             ]);

        $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => $progressPercentChild2,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[2]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => $progressPercentChild2,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[1]->getId(),
                        ],
                    ],
                ],
            ],
        ]);
        $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => $progressPercentChild2,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $newProgressPercent = 60;
        $response = $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => $newProgressPercent,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[1]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        sleep(1);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[0]->getId(),
            'progress_percent' => ($progressPercentChild2 + $newProgressPercent) / 2,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[1]->getId(),
            'progress_percent' => $newProgressPercent,
        ]);

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $content[2]->getId(),
            'progress_percent' => $progressPercentChild2,
        ]);
    }

    public function test_reset_content_progress()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(1, [
            'status' => 'published',
        ]);
        $contentId = $content[0]->getId();
        $randomPercent = $this->faker->randomNumber(2);

        $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => $randomPercent,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $response = $this->put('railcontent/reset', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $contentId,
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseMissing(config('railcontent.table_prefix').'user_content_progress', [
            'content_id' => $contentId,
            'user_id' => $userId,
        ]);
    }

    public function test_reset_progress_invalid_content_id()
    {
        $response = $this->put('railcontent/reset', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => rand(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson('errors');

        $expectedErrors = [
            "source" => "data.relationships.content.data.id",
            "detail" => "The selected content id is invalid.",
            'title' => 'Validation failed.',
        ];

        $this->assertEquals([$expectedErrors], $responseContent);
    }

    public function test_reset_parent_progress()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(2, [
            'status' => 'published',
        ]);

        $this->fakeHierarchy([
                                 'parent_id' => $content[0]->getId(),
                                 'child_id' => $content[1]->getId(),
                             ]);

        $contentId = $content[0]->getId();

        $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => 10,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[1]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $randomPercent = $this->faker->randomNumber(2);

        $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => ($randomPercent + 10) / 2,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $response = $this->put('railcontent/reset', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $contentId,
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseMissing(config('railcontent.table_prefix').'user_content_progress', [
            'content_id' => $contentId,
            'user_id' => $userId,
        ]);

        $this->assertDatabaseMissing(config('railcontent.table_prefix').'user_content_progress', [
            'content_id' => $content[1]->getId(),
            'user_id' => $userId,
        ]);
    }

    public function test_reset_progress_cache_invalidation()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(3, [
            'status' => 'published',
            'type' => 'course',
            'publishedOn' => Carbon::now(),
            'brand' => config('railcontent.brand'),
        ]);

        $contentId = $content[0]->getId();

        sleep(1);

        $this->put('railcontent/complete', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[1]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $randomPercent = $this->faker->randomNumber(2);
        sleep(1);

        $this->put('railcontent/complete', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        sleep(1);

        $firstRequest = $this->call('GET', 'railcontent/content', [
            'required_user_states' => ['completed'],
        ]);

        $this->assertEquals(2, $firstRequest->decodeResponseJson('meta')['pagination']['total']);

        $this->put('railcontent/reset', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $contentId,
                        ],
                    ],
                ],
            ],
        ]);

        $secondRequest = $this->call('GET', 'railcontent/content', [
            'required_user_states' => ['completed'],
        ]);

        $this->assertEquals(1, $secondRequest->decodeResponseJson('meta')['pagination']['total']);
    }

    public function test_higher_key_when_complete_method()
    {
        $userId = $this->createAndLogInNewUser();

        $method = $this->fakeContent(1, [
            'status' => 'published',
            'type' => 'learning-path',
        ]);

        $levels = $this->fakeContent(2, [
            'status' => 'published',
            'type' => 'learning-path-level',
        ]);

        $courses = $this->fakeContent(3, [
            'status' => 'published',
            'type' => 'learning-path-course',
        ]);
        $this->fakeHierarchy([
                                 'parent_id' => $method[0]->getId(),
                                 'child_id' => $levels[0]->getId(),
            'child_position' => 1
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $method[0]->getId(),
                                 'child_id' => $levels[1]->getId(),
            'child_position' => 2
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $levels[1]->getId(),
                                 'child_id' => $courses[0]->getId(),
                                 'child_position' => 1
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $levels[1]->getId(),
                                 'child_id' => $courses[1]->getId(),
                                 'child_position' => 2
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $levels[1]->getId(),
                                 'child_id' => $courses[2]->getId(),
                                 'child_position' => 3
                             ]);

        $response = $this->put('railcontent/complete', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $method[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'completed',
            'content_id' => $method[0]->getId(),
            'progress_percent' => 100,
            'higher_key_progress' => '2.3'
        ]);
    }

    public function test_higher_key_when_start_method()
    {
        $userId = $this->createAndLogInNewUser();

        $method = $this->fakeContent(1, [
            'status' => 'published',
            'type' => 'learning-path',
        ]);

        $levels = $this->fakeContent(2, [
            'status' => 'published',
            'type' => 'learning-path-level',
        ]);

        $courses = $this->fakeContent(3, [
            'status' => 'published',
            'type' => 'learning-path-course',
        ]);
        $this->fakeHierarchy([
                                 'parent_id' => $method[0]->getId(),
                                 'child_id' => $levels[0]->getId(),
                                 'child_position' => 1
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $method[0]->getId(),
                                 'child_id' => $levels[1]->getId(),
                                 'child_position' => 2
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $levels[1]->getId(),
                                 'child_id' => $courses[0]->getId(),
                                 'child_position' => 1
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $levels[1]->getId(),
                                 'child_id' => $courses[1]->getId(),
                                 'child_position' => 2
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $levels[1]->getId(),
                                 'child_id' => $courses[2]->getId(),
                                 'child_position' => 3
                             ]);

        $response = $this->put('railcontent/start', [
            'data' => [
                'type' => 'userContentProgress',
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $courses[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $method[0]->getId(),
            'progress_percent' => 0,
            'higher_key_progress' => '1.1'
        ]);
    }

    public function test_higher_key_when_save_progress_method()
    {
        $userId = $this->createAndLogInNewUser();

        $method = $this->fakeContent(1, [
            'status' => 'published',
            'type' => 'learning-path',
        ]);

        $levels = $this->fakeContent(2, [
            'status' => 'published',
            'type' => 'learning-path-level',
        ]);

        $courses = $this->fakeContent(3, [
            'status' => 'published',
            'type' => 'learning-path-course',
        ]);
        $this->fakeHierarchy([
                                 'parent_id' => $method[0]->getId(),
                                 'child_id' => $levels[0]->getId(),
                                 'child_position' => 1
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $method[0]->getId(),
                                 'child_id' => $levels[1]->getId(),
                                 'child_position' => 2
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $levels[1]->getId(),
                                 'child_id' => $courses[0]->getId(),
                                 'child_position' => 1
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $levels[1]->getId(),
                                 'child_id' => $courses[1]->getId(),
                                 'child_position' => 2
                             ]);
        $this->fakeHierarchy([
                                 'parent_id' => $levels[1]->getId(),
                                 'child_id' => $courses[2]->getId(),
                                 'child_position' => 3
                             ]);

        $response = $this->put('railcontent/progress', [
            'data' => [
                'type' => 'userContentProgress',
                'attributes' => [
                    'progress_percent' => 20,
                ],
                'relationships' => [
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $courses[0]->getId(),
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(config('railcontent.table_prefix').'user_content_progress', [
            'user_id' => auth()->id(),
            'state' => 'started',
            'content_id' => $method[0]->getId(),
            'higher_key_progress' => '1.1'
        ]);
    }
}
