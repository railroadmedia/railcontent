<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\NewStructure;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PermissionControllerTest extends RailcontentTestCase
{
    /**
     * @var ContentPermissionService
     */
    protected $contentPermissionService;

    protected function setUp()
    {
        parent::setUp();

        $this->contentPermissionService = $this->app->make(ContentPermissionService::class);

        ResponseService::$oldResponseStructure = false;
    }

    public function test_index()
    {
        $permission = $this->fakePermission([
                                                'name' => 'permission 1',
                                                'brand' => config('railcontent.brand'),
                                            ]);

        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);
        $response = $this->call(
            'GET',
            'railcontent/permission'
        );

        $this->assertEquals(
            [
                [
                    'id' => 1,
                    'type' => 'permission',
                    'attributes' => [
                        'name' => 'permission 1',
                        'brand' => config('railcontent.brand'),
                    ],
                ],
            ],
            $response->decodeResponseJson('data')
        );
    }

    public function test_store_response()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $name = $this->faker->word;
        $permission = [
            'name' => $name,
        ];

        $response = $this->call('PUT', 'railcontent/permission', [
                                         'data' => [
                                             'type' => 'permission',
                                             'attributes' => [
                                                 'name' => $name,
                                             ],
                                         ],
                                     ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            [
                'data' => [
                    'id' => 1,
                    'type' => 'permission',
                    'attributes' => array_add($permission, 'brand', config('railcontent.brand')),
                ],
            ],
            $response->decodeResponseJson()
        );
    }

    public function test_store_validation()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $response = $this->call('PUT', 'railcontent/permission');

        $this->assertEquals(422, $response->status());
        $this->assertEquals(
            [
                [
                    'title' => 'Validation failed.',
                    'source' => 'data.type',
                    'detail' => 'The type field is required.',
                ],
                [
                    'title' => 'Validation failed.',
                    'source' => 'data.attributes.name',
                    'detail' => 'The name field is required.',
                ],
            ],
            $response->decodeResponseJson('errors')
        );
    }

    public function test_update_response()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $name = $this->faker->word;
        $fakeData = $this->fakePermission();
        $permission['name'] = $name;

        $response = $this->call('PATCH', 'railcontent/permission/'.$fakeData['id'], [
                                           'data' => [
                                               'id' => 1,
                                               'type' => 'permission',
                                               'attributes' => $permission,
                                           ],
                                       ]);

        $this->assertEquals(201, $response->status());

        $this->assertEquals(
            [
                'data' => [
                    'id' => 1,
                    'type' => 'permission',
                    'attributes' => array_add($permission, 'brand', config('railcontent.brand')),
                ],
            ],
            $response->decodeResponseJson()
        );
    }

    public function test_update_not_exist_permission()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $name = $this->faker->word;
        $id = rand(2, 10);

        $response = $this->call('PATCH', 'railcontent/permission/'.$id, [
                                           'id' => $id,
                                           'data' => [
                                               'type' => 'permission',
                                               'attributes' => [
                                                   'name' => $name,
                                               ],
                                           ],
                                       ]);

        $this->assertEquals(404, $response->getStatusCode());

        $this->assertEquals(
            'Update failed, permission not found with id: '.$id,
            $response->decodeResponseJson('errors')['detail']
        );
    }

    public function test_update_validation()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $response = $this->call('PATCH', 'railcontent/permission/1', [
            'data' => [
                'type' => 'permission',
            ],
        ]);

        $this->assertEquals(422, $response->status());

        $expectedErrors = [
            'source' => 'data.attributes.name',
            'detail' => 'The name field is required.',
            'title' => 'Validation failed.',
        ];

        $this->assertEquals([$expectedErrors], $response->decodeResponseJson('errors'));
    }

    public function test_delete_permission_response()
    {
        $permission = $this->fakePermission();
        $id = $permission['id'];
        $this->fakeContentPermission([
                                         'content_type' => $this->faker->word,
                                         'permission_id' => $id,
                                     ]);

        $response = $this->call('DELETE', 'railcontent/permission/'.$id);

        $this->assertEquals(204, $response->status());
        $this->assertEquals('', $response->content());
        $this->assertDatabaseMissing(config('railcontent.table_prefix'.'permission'), [
                                                                                        'id' => $id,
                                                                                    ]);

        $this->assertDatabaseMissing(config('railcontent.table_prefix'.'content_permissions'), [
                                                                                                 'permission_id' => $id,
                                                                                             ]);
    }

    public function test_delete_missing_permission_response()
    {
        $id = rand(2, 10);
        $response = $this->call('DELETE', 'railcontent/permission/'.$id);

        $this->assertEquals(404, $response->status());
        $this->assertEquals(
            'Delete failed, permission not found with id: '.$id,
            $response->decodeResponseJson('errors')['detail']
        );
    }

    public function test_assign_permission_to_specific_content()
    {
        $content = $this->fakeContent();
        $permission = $this->fakePermission();

        $response = $this->call('PUT', 'railcontent/permission/assign', [
                                         'data' => [
                                             'type' => 'contentPermission',
                                             'attributes' => [
                                                 'brand' => config('railcontent.brand'),
                                             ],
                                             'relationships' => [
                                                 'permission' => [
                                                     'data' => [
                                                         'type' => 'permission',
                                                         'id' => $permission['id'],
                                                     ],
                                                 ],
                                                 'content' => [
                                                     'data' => [
                                                         'type' => 'content',
                                                         'id' => $content[0]->getId(),
                                                     ],
                                                 ],
                                             ],
                                         ],
                                     ]);

        $expectedResults = [
            "content_type" => null,
            "brand" => config('railcontent.brand'),
        ];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data')['attributes']);

        $this->assertEquals(
            [
                'data' => [
                    'type' => 'permission',
                    'id' => 1,
                ],
            ],
            $response->decodeResponseJson('data')['relationships']['permission']
        );

        $this->assertEquals(
            [
                'data' => [
                    'type' => 'content',
                    'id' => $content[0]->getId(),
                ],
            ],
            $response->decodeResponseJson('data')['relationships']['content']
        );
    }

    public function test_assign_permission_to_specific_content_type()
    {
        $content = $this->fakeContent(1, [
                                           'type' => 'course',
                                       ]);
        $permission = $this->fakePermission();

        sleep(1);

        $response = $this->call('PUT', 'railcontent/permission/assign', [
                                         'data' => [
                                             'type' => 'contentPermission',
                                             'attributes' => [
                                                 'content_type' => 'course',
                                             ],
                                             'relationships' => [
                                                 'permission' => [
                                                     'data' => [
                                                         'type' => 'permission',
                                                         'id' => $permission['id'],
                                                     ],
                                                 ],
                                             ],
                                         ],
                                     ]);

        $expectedResults = [
            "content_type" => 'course',
            "brand" => config('railcontent.brand'),
        ];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data')['attributes']);

        $this->assertEquals(
            [
                'data' => [
                    'type' => 'permission',
                    'id' => $permission['id'],
                ],
            ],
            $response->decodeResponseJson('data')['relationships']['permission']
        );
    }

    public function test_assign_permission_validation()
    {
        $randomPermissionId = $this->faker->numberBetween();
        $response = $this->call('PUT', 'railcontent/permission/assign', [
                                         'data' => [
                                             'type' => 'contentPermission',
                                             'relationships' => [
                                                 'permission' => [
                                                     'data' => [
                                                         'type' => 'permission',
                                                         'id' => $randomPermissionId,
                                                     ],
                                                 ],
                                             ],
                                         ],

                                     ]);

        $decodedResponse = $response->decodeResponseJson('errors');

        $this->assertEquals(422, $response->getStatusCode());

        $expectedErrors = [
            [
                'source' => 'data.relationships.permission.data.id',
                'detail' => 'The selected permission id is invalid.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.relationships.content.data.type',
                'detail' => 'The content type field is required when none of content type are present.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.relationships.content.data.id',
                'detail' => 'The content id field is required when none of content type are present.',
                'title' => 'Validation failed.',
            ],
            [
                'source' => 'data.attributes.content_type',
                'detail' => 'The content type field is required when none of content id are present.',
                'title' => 'Validation failed.',
            ],
        ];
        $this->assertEquals($expectedErrors, $decodedResponse);
    }

    public function test_assign_permission_incorrect_content_id()
    {
        $permission = $this->fakePermission();

        $response = $this->call('PUT', 'railcontent/permission/assign', [
                                         'data' => [
                                             'type' => 'contentPermission',
                                             'relationships' => [
                                                 'permission' => [
                                                     'data' => [
                                                         'type' => 'permission',
                                                         'id' => $permission['id'],
                                                     ],
                                                 ],
                                                 'content' => [
                                                     'data' => [
                                                         'type' => 'content',
                                                         'id' => rand(),
                                                     ],
                                                 ],
                                             ],
                                         ],
                                     ]);

        $this->assertEquals(422, $response->getStatusCode());

        $expectedErrors = [
            [
                "title" => "Validation failed.",
                "source" => "data.relationships.content.data.id",
                "detail" => "The selected content id is invalid.",
            ],
        ];
        $this->assertEquals($expectedErrors, $response->decodeResponseJson('errors'));
    }

    public function test_assign_permission_incorrect_content_type()
    {
        $permission = $this->fakePermission();

        $response = $this->call('PUT', 'railcontent/permission/assign', [
                                         'data' => [
                                             'type' => 'contentPermission',
                                             'attributes' => [
                                                 'content_type' => $this->faker->word,
                                             ],
                                             'relationships' => [
                                                 'permission' => [
                                                     'data' => [
                                                         'type' => 'permission',
                                                         'id' => $permission['id'],
                                                     ],
                                                 ],
                                             ],
                                         ],
                                     ]);

        $this->assertEquals(422, $response->getStatusCode());

        $expectedErrors = [
            [
                'source' => 'data.attributes.content_type',
                'detail' => 'The selected content type is invalid.',
                'title' => 'Validation failed.',
            ],
        ];
        $this->assertEquals($expectedErrors, $response->decodeResponseJson('errors'));
    }

    public function test_assign_permission_to_content_type_service_result()
    {
        $permission = $this->fakePermission();

        $assigned = $this->contentPermissionService->create(null, 'course', $permission['id']);

        $this->assertEquals('course', $assigned->getContentType());
        $this->assertEquals(
            1,
            $assigned->getPermission()
                ->getId()
        );
    }

    public function test_assign_permission_to_specific_content_service_result()
    {
        $content = $this->fakeContent();
        $permission = $this->fakePermission();

        $assigned = $this->contentPermissionService->create($content[0]->getId(), null, $permission['id']);

        $this->assertNull($assigned->getContentType());
        $this->assertEquals(
            1,
            $assigned->getPermission()
                ->getId()
        );
        $this->assertEquals(
            1,
            $assigned->getContent()
                ->getId()
        );
    }

    public function test_dissociation_by_content_id()
    {
        $content = $this->fakeContent();
        $permission = $this->fakePermission();

        $this->contentPermissionService->create($content[0]->getId(), null, $permission['id']);
        $data = [
            'data' => [
                'type' => 'contentPermission',
                'relationships' => [
                    'permission' => [
                        'data' => [
                            'type' => 'permission',
                            'id' => $permission['id'],
                        ],
                    ],
                    'content' => [
                        'data' => [
                            'type' => 'content',
                            'id' => $content[0]->getId(),
                        ],
                    ],
                ],
            ],
        ];
        $this->assertDatabaseHas(config('railcontent.table_prefix').'content_permissions', [
                                                                                             'permission_id' => $permission['id'],
                                                                                             'content_id' => $content[0]->getId(
                                                                                             ),
                                                                                         ]);

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);

        $this->assertEquals(200, $response->status());

        $this->assertDatabaseMissing(config('railcontent.table_prefix').'content_permissions', [
                                                                                                 'permission_id' => $permission['id'],
                                                                                                 'content_id' => $content[0]->getId(
                                                                                                 ),
                                                                                             ]);
    }

    public function test_dissociation_by_content_type()
    {
        $content = $this->fakeContent(1, [
                                           'type' => 'course',
                                       ]);
        $permission = $this->fakePermission();

        $this->contentPermissionService->create(null, 'course', $permission['id']);

        $data = [
            'data' => [
                'type' => 'contentPermission',
                'attributes' => [
                    'content_type' => 'course',
                ],
                'relationships' => [
                    'permission' => [
                        'data' => [
                            'type' => 'permission',
                            'id' => $permission['id'],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertDatabaseHas(config('railcontent.table_prefix').'content_permissions',
                                 ['content_type' => 'course', 'permission_id' => $permission['id']]);

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing(config('railcontent.table_prefix').'content_permissions',
                                     ['content_type' => 'course', 'permission_id' => $permission['id']]);
    }

    public function test_content_filter_after_permission_assignation()
    {
        $type = $this->faker->word;

        $contents = $this->fakeContent(1, [
                                             'status' => 'published',
                                             'type' => $type,
                                             'brand' => config('railcontent.brand'),
                                             'publishedOn' => Carbon::now(),
                                         ]);
        sleep(1);

        $types = [$type, $this->faker->word];
        $page = 1;
        $limit = 10;

//        $firstRequest = $this->call('GET', 'railcontent/content', [
//                                             'page' => $page,
//                                             'limit' => $limit,
//                                             'sort' => 'id',
//                                             'included_types' => $types,
//                                         ]);
//
//        sleep(1);
//
//        $this->assertTrue(
//            in_array($contents[0]->getId(), array_pluck($firstRequest->decodeResponseJson('data'), 'id'))
//        );

        $permission = $this->fakePermission();

        $this->call('PUT', 'railcontent/permission/assign', [
                             'data' => [
                                 'type' => 'contentPermission',
                                 'attributes' => [
                                     'brand' => config('railcontent.brand'),
                                 ],
                                 'relationships' => [
                                     'permission' => [
                                         'data' => [
                                             'type' => 'permission',
                                             'id' => $permission['id'],
                                         ],
                                     ],
                                     'content' => [
                                         'data' => [
                                             'type' => 'content',
                                             'id' => $contents[0]->getId(),
                                         ],
                                     ],
                                 ],
                             ],
                         ]);

        sleep(1);

        $secondRequest = $this->call('GET', 'railcontent/content', [
                                              'page' => $page,
                                              'limit' => $limit,
                                              'sort' => 'id',
                                              'included_types' => $types,
                                          ]);

        foreach($secondRequest->decodeResponseJson('data') as $responseData){
            $this->assertTrue(
                $contents[0]->getId() != $responseData['id']
            );
        }

    }

    public function test_content_filter_after_type_permission_assignation()
    {
        $userId = $this->createAndLogInNewUser();

        $type = $this->faker->word;

        $contents = $this->fakeContent(10, [
                                             'status' => 'published',
                                             'type' => $type,
                                             'brand' => config('railcontent.brand'),
                                             'publishedOn' => Carbon::now(),
                                         ]);
        sleep(1);
        $types = [$type, $this->faker->word];
        $page = 1;
        $limit = 10;

        $firstRequest = $this->call('GET', 'railcontent/content', [
                                             'page' => $page,
                                             'limit' => $limit,
                                             'sort' => 'id',
                                             'included_types' => $types,
                                         ]);

        $this->assertTrue(
            in_array(
                $contents[0]->getType(),
                array_pluck(array_pluck($firstRequest->decodeResponseJson('data'), 'attributes'), 'type')
            )
        );

        $permission = $this->fakePermission();

        $a = $this->call('PUT', 'railcontent/permission/assign', [
                                  'data' => [
                                      'type' => 'contentPermission',
                                      'attributes' => [
                                          'brand' => config('railcontent.brand'),
                                          'content_type' => $contents[0]->getType(),
                                      ],
                                      'relationships' => [
                                          'permission' => [
                                              'data' => [
                                                  'type' => 'permission',
                                                  'id' => $permission['id'],
                                              ],
                                          ],
                                      ],
                                  ],
                              ]);

        $userPermission = $this->fakeUserPermission([
                                                        'user_id' => $userId,
                                                        'permission_id' => $permission['id'],
                                                        'start_date' => Carbon::now(),
                                                        'expiration_date' => null,
                                                    ]);

        $secondRequest = $this->call('GET', 'railcontent/content', [
                                              'page' => $page,
                                              'limit' => $limit,
                                              'sort' => 'id',
                                              'included_types' => $types,
                                          ]);

        $this->assertTrue(
            in_array(
                $contents[0]->getType(),
                array_pluck(array_pluck($secondRequest->decodeResponseJson('data'), 'attributes'), 'type')
            )
        );
    }

    public function test_contents_filter_without_rights()
    {
        $user = $this->createAndLogInNewUser();

        $type = $this->faker->word;

        $contents = $this->fakeContent(10, [
                                             'status' => 'published',
                                             'type' => $type,
                                             'brand' => config('railcontent.brand'),
                                             'publishedOn' => Carbon::now(),
                                         ]);

        sleep(1);

        $permission = $this->fakePermission();

        $this->fakeContentPermission([
                                         'content_id' => $contents[0]->getId(),
                                         'permission_id' => $permission['id'],
                                         'brand' => config('railcontent.brand'),
                                     ]);

        $types = [$type, $this->faker->word];
        $page = 1;
        $limit = 10;

        $firstRequest = $this->call('GET', 'railcontent/content', [
                                             'page' => $page,
                                             'limit' => $limit,
                                             'sort' => 'id',
                                             'included_types' => $types,
                                         ]);

        $this->assertEquals(10, $firstRequest->decodeResponseJson('meta')['pagination']['total']);

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', [
                                           'data' => [
                                               'type' => 'contentPermission',
                                               'relationships' => [
                                                   'permission' => [
                                                       'data' => [
                                                           'type' => 'permission',
                                                           'id' => $permission['id'],
                                                       ],
                                                   ],
                                                   'content' => [
                                                       'data' => [
                                                           'type' => 'content',
                                                           'id' => $contents[0]->getId(),
                                                       ],
                                                   ],
                                               ],
                                           ],
                                       ]);
        $secondRequest = $this->call('GET', 'railcontent/content', [
                                              'page' => $page,
                                              'limit' => $limit,
                                              'sort' => 'id',
                                              'included_types' => $types,
                                          ]);
        $this->assertEquals(10, $secondRequest->decodeResponseJson('meta')['pagination']['total']);
    }

    public function test_getByContentTypeOrIdAndByPermissionId()
    {
        $contents = $this->fakeContent(1, [
                                            'status' => 'published',
                                            'type' => 'course',
                                            'brand' => config('railcontent.brand'),
                                            'publishedOn' => Carbon::now(),
                                        ]);

        $permission = $this->fakePermission([
                                                'brand' => config('railcontent.brand'),
                                            ]);

        $type = $this->faker->word;
        $otherTypeContent = $this->fakeContent(1, [
                                                    'status' => 'published',
                                                    'type' => $type,
                                                    'brand' => config('railcontent.brand'),
                                                    'publishedOn' => Carbon::now(),
                                                ]);

        $this->fakeContentPermission([
                                         'content_id' => $contents[0]->getId(),
                                         'permission_id' => $permission['id'],
                                         'brand' => config('railcontent.brand'),
                                     ]);
        $this->fakeContentPermission([
                                         'content_type' => $type,
                                         'permission_id' => $permission['id'],
                                         'brand' => config('railcontent.brand'),
                                     ]);

        $this->fakeContentPermission([
                                         'content_type' => $type,
                                         'permission_id' => $permission['id'],
                                         'brand' => $this->faker->word,
                                     ]);

        $results = $this->contentPermissionService->getByContentTypeOrIdAndByPermissionId(
            $contents[0]->getId(),
            $type,
            $permission['id']
        );

        $this->assertEquals(2, count($results));

        foreach ($results as $result) {
            $this->assertTrue(
                (($result->getContentType() == $type) ||
                    ($result->getContent()
                            ->getId() == $contents[0]->getId())) &&
                $result->getPermission()
                    ->getId() == $permission['id']
            );
        }
    }
}
