<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Faker\ORM\Doctrine\Populator;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\ContentHierarchy;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentHierarchyJsonControllerTest extends RailcontentTestCase
{
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
                    'relationships' => [
                        'parent' => [
                            'data' => [
                                'type' => 'content',
                                'id' => '1',
                            ],
                        ],
                        'child' => [
                            'data' => [
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
                    'relationships' => [
                        'parent' => [
                            'data' => [
                                'type' => 'content',
                                'id' => '1',
                            ],
                        ],
                        'child' => [
                            'data' => [
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
                            'id' => 2,
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
                    'relationships' => [
                        'parent' => [
                            'data' => [
                                'type' => 'content',
                                'id' => '1',
                            ],
                        ],
                        'child' => [
                            'data' => [
                                'type' => 'content',
                                'id' => '2',
                            ],
                        ],
                    ],
                ],
            ],
            $response->decodeResponseJson()
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => 1,
                'child_id' => 3,
                'child_position' => 1,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => 1,
                'child_id' => 4,
                'child_position' => 2,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => 1,
                'child_id' => 2,
                'child_position' => 3,
            ]
        );
        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => 1,
                'child_id' => 5,
                'child_position' => 4,
            ]
        );

        $this->assertEquals(200, $response->status());
    }

    public function test_delete()
    {
        $response = $this->call(
            'DELETE',
            'railcontent/content/hierarchy/' . 1 . '/' . 3
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableContentHierarchy,
            [
                'child_id' => 3,
                'parent_id' => 1,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => 1,
                'child_id' => 2,
                'child_position' => 1,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => 1,
                'child_id' => 4,
                'child_position' => 2,
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableContentHierarchy,
            [
                'parent_id' => 1,
                'child_id' => 5,
                'child_position' => 3,
            ]
        );

        $this->assertEquals(204, $response->status());
    }

    public function test_create_hierarchy_one_child()
    {
        $response = $this->call(
            'PUT',
            'railcontent/content/hierarchy',
            [
                'data' => [
                    'attributes' => [
                        'child_position' => 14,
                    ],
                    'relationships' => [
                        'child' => [
                            'type' => 'content',
                            'id' => 6,
                        ],
                        'parent' => [
                            'type' => 'content',
                            'id' => 3,
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
                        'child_position' => 1,
                    ],
                    'relationships' => [
                        'parent' => [
                            'data' => [
                                'type' => 'content',
                                'id' => '3',
                            ],
                        ],
                        'child' => [
                            'data' => [
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

}