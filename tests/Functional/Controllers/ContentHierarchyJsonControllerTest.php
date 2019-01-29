<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentHierarchy;
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

        $populator = new Populator($this->faker, $this->entityManager);

        $populator->addEntity(
            Content::class,
            6,
            [
                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'publishedOn' => Carbon::now(),
            ]
        );
        $populator->execute();

        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(2),
                'childPosition' => 1,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(3),
                'childPosition' => 2,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(4),
                'childPosition' => 3,
            ]
        );
        $populator->execute();
        $populator->addEntity(
            ContentHierarchy::class,
            1,
            [
                'parent' => $this->entityManager->getRepository(Content::class)
                    ->find(1),
                'child' => $this->entityManager->getRepository(Content::class)
                    ->find(5),
                'childPosition' => 4,
            ]
        );
        $populator->execute();

        $this->contentFactory = $this->app->make(ContentFactory::class);
        $this->contentHierarchyFactory = $this->app->make(ContentHierarchyFactory::class);
    }

    public function test_create_validation_fails()
    {
        $response = $this->call('PUT', 'railcontent/content/hierarchy', [rand(), rand()]);

        $this->assertEquals(422, $response->status());

        $errors = [
            [
                'source' => 'data.relationships.child.id',
                'detail' => 'The child field is required.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.relationships.parent.id',
                'detail' => 'The parent field is required.',
                'title' => 'Validation failed.',
            ],
        ];

        $this->assertEquals($errors, $response->decodeResponseJson('errors'));
    }

    public function test_create_without_position()
    {

        $response = $this->call(
            'PUT',
            'railcontent/content/hierarchy',
            [
                'data' => [
                    'relationships' => [
                        'child' => [
                            'type' => 'content',
                            'id' => 6,
                        ],
                        'parent' => [
                            'type' => 'content',
                            'id' => 1,
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->status());

        $this->assertArraySubset(
            [
                'data' => [
                    'type' => 'contentHierarchy',
                    'attributes' => [
                        'child_position' => 5,
                    ],
                    'relationships' =>
                        [
                            'parent' =>
                                [
                                    'data' =>
                                        [
                                            'type' => 'content',
                                            'id' => '1',
                                        ],
                                ],
                            'child' =>
                                [
                                    'data' =>
                                        [
                                            'type' => 'content',
                                            'id' => '6',
                                        ],
                                ],
                        ],
                ],
            ],
            $response->decodeResponseJson()
        );
    }

    public function test_create_with_position()
    {
        $response = $this->call(
            'PUT',
            'railcontent/content/hierarchy',
            [
                'data' => [
                    'attributes' => [
                        'child_position' => 3,
                    ],
                    'relationships' => [
                        'child' => [
                            'type' => 'content',
                            'id' => 6,
                        ],
                        'parent' => [
                            'type' => 'content',
                            'id' => 1,
                        ],
                    ],
                ],
            ]
        );


        $this->assertEquals(200, $response->status());
        $this->assertArraySubset(
            [
                'data' => [
                    'type' => 'contentHierarchy',
                    'attributes' => [
                        'child_position' => 3,
                    ],
                    'relationships' =>
                        [
                            'parent' =>
                                [
                                    'data' =>
                                        [
                                            'type' => 'content',
                                            'id' => '1',
                                        ],
                                ],
                            'child' =>
                                [
                                    'data' =>
                                        [
                                            'type' => 'content',
                                            'id' => '6',
                                        ],
                                ],
                        ],
                ],
            ],
            $response->decodeResponseJson()
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

        $this->assertEquals(200, $response->status());
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

        $this->assertEquals(204, $response->status());
    }
}