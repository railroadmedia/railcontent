<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\OldStructure;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentProgressJsonControllerOldStructureTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
        ResponseService::$oldResponseStructure = true;
    }

    public function test_start_content()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
            ]
        );

        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => $content[0]->getId(),
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
            "source" => "id",
            "detail" => "The selected content id is invalid.",
        ];
        $this->assertEquals([$expectedErrors], $responseErrors);
    }

    public function test_complete_content()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
            ]
        );
        $contentId = $content[0]->getId();

        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => $contentId,
            ]
        );

        $response = $this->put(
            'railcontent/complete',
            [
                'content_id' => $contentId,
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));
        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
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
                'content_id' => 1,
            ]
        );

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson('meta');
        $responseErrors = $responseContent['errors'];
        $expectedErrors = [
            "source" => "id",
            "detail" => "The selected content id is invalid.",
        ];
        $this->assertEquals([$expectedErrors], $responseErrors);
    }

    public function test_save_user_progress_on_content()
    {
        $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
            ]
        );

        $contentId = $content[0]->getId();
        $percent = $this->faker->numberBetween(10, 99);

        $response = $this->put(
            'railcontent/progress',
            [
                'content_id' => $contentId,
                'progress_percent' => $percent,
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[0]->getId(),
                'progress_percent' => $percent,
            ]
        );
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
            "source" => "id",
            "detail" => "The selected content id is invalid.",
        ];
        $this->assertEquals([$expectedErrors], $responseErrors);
    }

    public function test_start_child_and_parent_content()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->fakeContent(
            2,
            [
                'status' => 'published',
                'type' => 'course',
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[1],
            ]
        );

        $response = $this->put(
            'railcontent/start',
            [
               'content_id' => $content[1]->getId()
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[0]->getId(),
                'progress_percent' => 0,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[1]->getId(),
                'progress_percent' => 0,
            ]
        );
    }

    public function test_start_child_and_recalculate_parent_progress()
    {
        $userId = $this->createAndLogInNewUser();

        $progressChild1 = 30;

        $content = $this->fakeContent(
            3,
            [
                'status' => 'published',
                'type' => 'course',
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[1],
            ]
        );
        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[2],
            ]
        );

        $this->put(
            'railcontent/progress',
            [
                'progress_percent' => $progressChild1,
                'content_id' => $content[2]->getId()
            ]
        );

        $response = $this->put(
            'railcontent/start',
            [
                'content_id' => $content[1]->getId()
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[0]->getId(),
                'progress_percent' => $progressChild1 / 2,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[1]->getId(),
                'progress_percent' => 0,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[2]->getId(),
                'progress_percent' => $progressChild1,
            ]
        );
    }

    public function test_complete_child_and_recalculate_parent_progress()
    {
        $userId = $this->createAndLogInNewUser();
        $progressChild1 = 30;

        $content = $this->fakeContent(
            3,
            [
                'status' => 'published',
                'type' => 'course',
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[1],
            ]
        );
        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[2],
            ]
        );

        $this->put(
            'railcontent/progress',
            [
                'progress_percent' => $progressChild1,
                'content_id' => $content[2]->getId(),
            ]
        );

        $response = $this->put(
            'railcontent/complete',
            [
                'content_id' => $content[1]->getId(),
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[0]->getId(),
                'progress_percent' => ($progressChild1 + 100) / 2,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'completed',
                'content_id' => $content[1]->getId(),
                'progress_percent' => 100,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[2]->getId(),
                'progress_percent' => $progressChild1,
            ]
        );
    }

    public function test_complete_parent()
    {
        $userId = $this->createAndLogInNewUser();
        $progressChild1 = 30;

        $content = $this->fakeContent(
            3,
            [
                'status' => 'published',
                'type' => 'course',
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[1],
            ]
        );
        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[2],
            ]
        );

        $this->put(
            'railcontent/start',
            [
                'content_id' => $content[0]->getId(),
            ]
        );

        $response = $this->put(
            'railcontent/complete',
            [
                'content_id' => $content[0]->getId(),
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'completed',
                'content_id' => $content[0]->getId(),
                'progress_percent' => 100,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'completed',
                'content_id' => $content[1]->getId(),
                'progress_percent' => 100,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'completed',
                'content_id' => $content[2]->getId(),
                'progress_percent' => 100,
            ]
        );
    }

    public function test_mark_complete_last_incomplete_children()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            3,
            [
                'status' => 'published',
                'type' => 'course',
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[1],
            ]
        );
        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[2],
            ]
        );

        $this->put(
            'railcontent/complete',
            [
                'content_id' => $content[2]->getId()
            ]
        );

        $response = $this->put(
            'railcontent/complete',
            [
                'content_id' => $content[1]->getId(),
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'completed',
                'content_id' => $content[0]->getId(),
                'progress_percent' => 100,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'completed',
                'content_id' => $content[1]->getId(),
                'progress_percent' => 100,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'completed',
                'content_id' => $content[2]->getId(),
                'progress_percent' => 100,
            ]
        );
    }

    public function test_save_child_user_progress()
    {
        $userId = $this->createAndLogInNewUser();
        $progressPercentChild2 = 30;

        $content = $this->fakeContent(
            3,
            [
                'status' => 'published',
                'type' => 'course',
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[1],
            ]
        );
        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[2],
            ]
        );

        $this->put(
            'railcontent/progress',
            [
                'progress_percent' => $progressPercentChild2,
                'content_id' => $content[2]->getId(),
            ]
        );

        $this->put(
            'railcontent/progress',
            [
                'progress_percent' => $progressPercentChild2,
                'content_id' => $content[1]->getId()
            ]
        );
        $this->put(
            'railcontent/progress',
            [
                'progress_percent' => $progressPercentChild2,
                'content_id' => $content[0]->getId()
            ]
        );

        $newProgressPercent = 60;
        $response = $this->put(
            'railcontent/progress',
            [
                'progress_percent' => $newProgressPercent,
                'content_id' => $content[1]->getId(),
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[0]->getId(),
                'progress_percent' => ($progressPercentChild2 + $newProgressPercent) / 2,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[1]->getId(),
                'progress_percent' => $newProgressPercent,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'user_id' => auth()->id(),
                'state' => 'started',
                'content_id' => $content[2]->getId(),
                'progress_percent' => $progressPercentChild2,
            ]
        );
    }

    public function test_reset_content_progress()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'status' => 'published',
            ]
        );
        $contentId = $content[0]->getId();
        $randomPercent = $this->faker->randomNumber(2);

        $this->put(
            'railcontent/progress',
            [
                'progress_percent' => $randomPercent,
                'content_id' => $content[0]->getId(),
            ]
        );

        $response = $this->put(
            'railcontent/reset',
            [
                'content_id' => $contentId
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'content_id' => $contentId,
                'user_id' => $userId,
            ]
        );
    }

    public function test_reset_progress_invalid_content_id()
    {
        $response = $this->put(
            'railcontent/reset',
            [
                'content_id' => rand(),
            ]
        );

        $this->assertEquals(422, $response->status());
        $responseContent = $response->decodeResponseJson('meta')['errors'];

        $expectedErrors = [
            "source" => "id",
            "detail" => "The selected content id is invalid.",
        ];

        $this->assertEquals([$expectedErrors], $responseContent);
    }

    public function test_reset_parent_progress()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            2,
            [
                'status' => 'published',
            ]
        );

        $this->fakeHierarchy(
            1,
            [
                'parent' => $content[0],
                'child' => $content[1],
            ]
        );

        $contentId = $content[0]->getId();

        $this->put(
            'railcontent/progress',
            [
                'progress_percent' => 10,
                'content_id' => $content[1]->getId(),
            ]
        );

        $randomPercent = $this->faker->randomNumber(2);

        $this->put(
            'railcontent/progress',
            [
                'progress_percent' => ($randomPercent + 10) / 2,
                'content_id' => $content[0]->getId(),
            ]
        );

        $response = $this->put(
            'railcontent/reset',
            [
                'content_id' => $contentId
            ]
        );

        $this->assertEquals(201, $response->status());
        $this->assertTrue($response->decodeResponseJson('data'));

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'content_id' => $contentId,
                'user_id' => $userId,
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix'). 'user_content_progress',
            [
                'content_id' => $content[1]->getId(),
                'user_id' => $userId,
            ]
        );
    }

    public function test_reset_progress_cache_invalidation()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            3,
            [
                'status' => 'published',
                'publishedOn' => Carbon::now(),
                'brand' => config('railcontent.brand'),
            ]
        );

        $contentId = $content[0]->getId();
        $this->put(
            'railcontent/complete',
            [
                'content_id' => $content[1]->getId()
            ]
        );

        $randomPercent = $this->faker->randomNumber(2);
        $this->put(
            'railcontent/complete',
            [
                'content_id' => $content[0]->getId(),
            ]
        );

        $firstRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'required_user_states' => ['completed'],
            ]
        );

        $this->assertEquals(2, $firstRequest->decodeResponseJson('meta')['totalResults']);

        $this->put(
            'railcontent/reset',
            [
                'content_id' => $contentId,
            ]
        );

        $secondRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'required_user_states' => ['completed'],
            ]
        );

        $this->assertEquals(1, $secondRequest->decodeResponseJson('meta')['totalResults']);
    }

}
