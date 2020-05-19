<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\NewStructure;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class ContentHierarchyJsonControllerTest extends RailcontentTestCase
{
    protected function setUp()
    {
        parent::setUp();
        ResponseService::$oldResponseStructure = false;

        $contents = $this->fakeContent(
            6,
            [

                'status' => 'published',
                'type' => 'course',
                'difficulty' => 5,
                'userId' => 1,
                'publishedOn' => Carbon::now(),

            ]
        );
        $hierarchy = $this->fakeHierarchy(
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[1]->getId(),
                'child_position' => 1,
            ]
        );
        $hierarchy = $this->fakeHierarchy(
             [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[2]->getId(),
                'child_position' => 2,
            ]
        );
        $hierarchy = $this->fakeHierarchy(
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[3]->getId(),
                'child_position' => 3,
            ]
        );

        $hierarchy = $this->fakeHierarchy(
            [
                'parent_id' => $contents[0]->getId(),
                'child_id' => $contents[4]->getId(),
                'child_position' => 4,
            ]
        );
    }

    public function test_create_validation_fails()
    {
        $response = $this->call('PUT', 'railcontent/content/hierarchy', [rand(), rand()]);

        $this->assertEquals(422, $response->status());

        $errors = [
            [
                'source' => 'data.type',
                'detail' => 'The json data type field is required.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.relationships.child.data.type',
                'detail' => 'The child type field is required.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.relationships.child.data.id',
                'detail' => 'The child id field is required.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.relationships.parent.data.type',
                'detail' => 'The parent type field is required.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.relationships.parent.data.id',
                'detail' => 'The parent id field is required.',
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
                    'type' => 'contentHierarchy',
                    'relationships' => [
                        'child' => [
                            'data' => [
                                'type' => 'content',
                                'id' => 6,
                            ],
                        ],
                        'parent' => [
                            'data' => [
                                'type' => 'content',
                                'id' => 1,
                            ],
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
                    'type' => 'contentHierarchy',
                    'attributes' => [
                        'child_position' => 3,
                    ],
                    'relationships' => [
                        'child' => [
                            'data' => [
                                'type' => 'content',
                                'id' => 6,
                            ],
                        ],
                        'parent' => [
                            'data' => [
                                'type' => 'content',
                                'id' => 1,
                            ],
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
                    'type' => 'contentHierarchy',
                    'attributes' => [
                        'child_position' => 3,
                    ],
                    'relationships' => [
                        'child' => [
                            'data' => [
                                'type' => 'content',
                                'id' => 2,
                            ],
                        ],
                        'parent' => [
                            'data' => [
                                'type' => 'content',
                                'id' => 1,
                            ],
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
            config('railcontent.table_prefix'). 'content_hierarchy',
            [
                'parent_id' => 1,
                'child_id' => 3,
                'child_position' => 1,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'content_hierarchy',
            [
                'parent_id' => 1,
                'child_id' => 4,
                'child_position' => 2,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'content_hierarchy',
            [
                'parent_id' => 1,
                'child_id' => 2,
                'child_position' => 3,
            ]
        );
        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'content_hierarchy',
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
            config('railcontent.table_prefix'). 'content_hierarchy',
            [
                'child_id' => 3,
                'parent_id' => 1,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'content_hierarchy',
            [
                'parent_id' => 1,
                'child_id' => 2,
                'child_position' => 1,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'content_hierarchy',
            [
                'parent_id' => 1,
                'child_id' => 4,
                'child_position' => 2,
            ]
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'content_hierarchy',
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
                    'type' => 'contentHierarchy',
                    'attributes' => [
                        'child_position' => 14,
                    ],
                    'relationships' => [
                        'child' => [
                            'data' => [
                                'type' => 'content',
                                'id' => 6,
                            ],
                        ],
                        'parent' => [
                            'data' => [
                                'type' => 'content',
                                'id' => 3,
                            ],
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
                        'child_position' => 0,
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