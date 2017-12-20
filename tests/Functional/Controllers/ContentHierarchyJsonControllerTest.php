<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentHierarchyJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentHierarchyFactory
     */
    protected $contentHierarchyFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
    }

    public function test_create_validation_fails()
    {
        $response = $this->call('PUT', 'railcontent/content/hierarchy', [rand(), rand()]);

        $this->assertEquals(422, $response->status());

        $errors = [
            [
                'source' => 'child_id',
                'detail' => 'The child id field is required.',
            ],
            [
                'source' => 'parent_id',
                'detail' => 'The parent id field is required.',
            ]
        ];

        $this->assertEquals($errors, json_decode($response->content(), true)['errors']);
    }

    public function test_create_without_position()
    {
        $childContent = $this->contentFactory->create();
        $parentContent = $this->contentFactory->create();

        $response =
            $this->call(
                'PUT',
                'railcontent/content/hierarchy',
                ['child_id' => $childContent['id'], 'parent_id' => $parentContent['id']]
            );

        $this->assertEquals(200, $response->status());

        $this->assertEquals(
            [
                'status' => 'ok',
                'code' => 200,
                'results' => [
                    'id' => 1,
                    'parent_id' => $parentContent['id'],
                    'child_id' => $childContent['id'],
                    'child_position' => 1,
                    'created_on' =>Carbon::now()->toDateTimeString()
                ],
            ],
            $response->json()
        );
    }

    public function test_create_with_position()
    {
        $childContent = $this->contentFactory->create();
        $parentContent = $this->contentFactory->create();

        $response =
            $this->call(
                'PUT',
                'railcontent/content/hierarchy',
                [
                    'child_id' => $childContent['id'],
                    'parent_id' => $parentContent['id'],
                    'child_position' => 3
                ]
            );

        $this->assertEquals(200, $response->status());

        $this->assertEquals(
            [
                'status' => 'ok',
                'code' => 200,
                'results' => [
                    'id' => 1,
                    'parent_id' => $parentContent['id'],
                    'child_id' => $childContent['id'],
                    'child_position' => 1,
                    'created_on' => Carbon::now()->toDateTimeString()
                ],
            ],
            $response->json()
        );
    }

    public function test_update_validation_fails()
    {
        $response = $this->call('PATCH', 'railcontent/content/hierarchy/' . rand() . '/' . rand());

        $this->assertEquals(422, $response->status());

        $errors = [
            [
                'source' => 'child_position',
                'detail' => 'The child position field is required.',
            ]
        ];

        $this->assertEquals($errors, json_decode($response->content(), true)['errors']);
    }

    public function test_update_not_found()
    {
        $response =
            $this->call(
                'PATCH',
                'railcontent/content/hierarchy/' . rand() . '/' . rand(),
                ['child_position' => rand()]
            );

        $this->assertEquals(404, $response->status());
    }

    public function test_update()
    {
        $parentContent = $this->contentFactory->create();

        $randomContent = $this->contentFactory->create();
        $this->contentHierarchyFactory->create($parentContent['id'], $randomContent['id']);

        $childContent = $this->contentFactory->create();
        $newChildPosition = 1;

        $oldHierarchy = $this->contentHierarchyFactory->create($parentContent['id'], $childContent['id']);

        $response =
            $this->call(
                'PATCH',
                'railcontent/content/hierarchy/' . $parentContent['id'] . '/' . $childContent['id'],
                ['child_position' => $newChildPosition]
            );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'id' => 2,
                'child_id' => $childContent['id'],
                'parent_id' => $parentContent['id'],
                'child_position' => $newChildPosition,
            ]
        );

        $this->assertEquals(201, $response->status());
    }

    public function test_delete()
    {
        $parentContent = $this->contentFactory->create();
        $childContent = $this->contentFactory->create();

        $oldHierarchy = $this->contentHierarchyFactory->create($parentContent['id'], $childContent['id']);

        $response =
            $this->call(
                'DELETE',
                'railcontent/content/hierarchy/' . $parentContent['id'] . '/' . $childContent['id']
            );

        $this->assertDatabaseMissing(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => $childContent['id'],
                'parent_id' => $parentContent['id'],
            ]
        );

        $this->assertEquals(204, $response->status());
    }
}