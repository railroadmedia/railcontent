<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Factories\ContentHierarchyFactory;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentHierarchyJsonControllerTest extends RailcontentTestCase
{
    use ArraySubsetAsserts;

    /**
     * @var ContentFactory
     */
    protected $contentFactory;

    /**
     * @var ContentHierarchyFactory
     */
    protected $contentHierarchyFactory;

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
            ],
        ];

        $this->assertEquals($errors, $response->decodeResponseJson()->json('meta')['errors']);
    }

    public function test_create_without_position()
    {
        $childContent = $this->contentFactory->create();
        $parentContent = $this->contentFactory->create();

        $response = $this->call(
            'PUT',
            'railcontent/content/hierarchy',
            ['child_id' => $childContent['id'], 'parent_id' => $parentContent['id']]
        );

        $this->assertEquals(201, $response->status());

        $this->assertArraySubset(
            [
                'id' => $parentContent['id'],
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ],
            $response->decodeResponseJson()->json('post')
        );
    }

    public function test_create_with_position()
    {
        $childContent = $this->contentFactory->create();
        $parentContent = $this->contentFactory->create();

        $response = $this->call(
            'PUT',
            'railcontent/content/hierarchy',
            [
                'child_id' => $childContent['id'],
                'parent_id' => $parentContent['id'],
                'child_position' => 3,
            ]
        );

        $this->assertEquals(201, $response->status());

        $this->assertArraySubset(
            [
                'id' => $parentContent['id'],
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ],
            $response->decodeResponseJson()->json()['post']
        );
    }

    public function test_update()
    {
        $parentContent = $this->contentFactory->create();

        $randomContent = $this->contentFactory->create();
        $this->contentHierarchyFactory->create($parentContent['id'], $randomContent['id']);

        $childContent = $this->contentFactory->create();
        $newChildPosition = 1;

        $oldHierarchy = $this->contentHierarchyFactory->create($parentContent['id'], $childContent['id']);

        $response = $this->call(
            'PUT',
            'railcontent/content/hierarchy',
            [
                'parent_id' => $parentContent['id'],
                'child_id' => $childContent['id'],
                'child_position' => $newChildPosition,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
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

        $response = $this->call(
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

        $this->assertEquals(202, $response->status());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
    }
}