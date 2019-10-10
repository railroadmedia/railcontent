<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PermissionControllerOldStructureTest extends RailcontentTestCase
{
    /**
     * @var ContentPermissionService
     */
    protected $contentPermissionService;

    protected function setUp()
    {
        parent::setUp();

        $this->contentPermissionService = $this->app->make(ContentPermissionService::class);

        ResponseService::$oldResponseStructure = true;
    }

    public function test_index()
    {
        $permission = $this->fakePermission(
            1,
            [
                'name' => 'permission 1',
                'brand' => config('railcontent.brand'),
            ]
        );

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
                    'name' => 'permission 1',
                    'brand' => config('railcontent.brand'),
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
            'id' => 1,
            'brand' => config('railcontent.brand'),
        ];

        $response = $this->call(
            'PUT',
            'railcontent/permission',
            [
                'name' => $name,
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            $permission,
            $response->decodeResponseJson('data')
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
                    "source" => "name",
                    "detail" => "The name field is required.",
                ],
            ],
            $response->decodeResponseJson('meta')['errors']
        );
    }

    public function test_update_response()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $name = $this->faker->word;
        $fakeData = $this->fakePermission(1);
        $permission['name'] = $name;

        $response = $this->call(
            'PATCH',
            'railcontent/permission/' . $fakeData[0]->getId(),
            [
                'name' => $name,
            ]
        );

        $this->assertEquals(201, $response->status());

        $response->assertJson(
            [
                'data' => [
                    'id' => $fakeData[0]->getId(),
                    'name' => $name,
                    'brand' => $fakeData[0]->getBrand(),
                ],
            ]
        );
    }

    public function test_update_not_exist_permission()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $name = $this->faker->word;
        $id = rand(2, 10);

        $response = $this->call(
            'PATCH',
            'railcontent/permission/' . $id,
            [

                        'name' => $name,
            ]
        );

        $this->assertEquals(404, $response->getStatusCode());

        $this->assertEquals(
            'Update failed, permission not found with id: ' . $id,
            $response->decodeResponseJson('errors')['detail']
        );
    }

    public function test_update_validation()
    {
        $this->permissionServiceMock->method('canOrThrow')
            ->willReturn(true);

        $response = $this->call(
            'PATCH',
            'railcontent/permission/1'
        );

        $this->assertEquals(422, $response->status());
        $expectedErrors = [
            "source" => "name",
            "detail" => "The name field is required.",
        ];
        $this->assertEquals([$expectedErrors], $response->decodeResponseJson('meta')['errors']);
    }

    public function test_delete_permission_response()
    {
        $permission = $this->fakePermission();
        $id = $permission[0]->getId();
        $this->fakeContentPermission(
            1,
            [
                'contentType' => $this->faker->word,
                'permission' => $permission[0],
            ]
        );

        $response = $this->call('DELETE', 'railcontent/permission/' . $id);

        $this->assertEquals(204, $response->status());
        $this->assertEquals('', $response->content());
        $this->assertDatabaseMissing(
            config('railcontent.table_prefix' . 'permission'),
            [
                'id' => $id,
            ]
        );

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix' . 'content_permissions'),
            [
                'permission_id' => $id,
            ]
        );
    }

    public function test_delete_missing_permission_response()
    {
        $id = rand(2, 10);
        $response = $this->call('DELETE', 'railcontent/permission/' . $id);

        $this->assertEquals(404, $response->status());
        $this->assertEquals(
            'Delete failed, permission not found with id: ' . $id,
            $response->decodeResponseJson('errors')['detail']
        );
    }

    public function test_assign_permission_to_specific_content()
    {
        $content = $this->fakeContent();
        $permission = $this->fakePermission();

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $permission[0]->getId(),
                'content_id' => $content[0]->getId(),
            ]
        );

        $expectedResults = [
            "id" => "1",
            "content_id" => $content[0]->getId(),
            "content_type" => null,
            "permission_id" => $permission[0]->getId(),
            "name" => $permission[0]->getName(),
            "brand" => config('railcontent.brand'),
        ];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data'));
    }

    public function test_assign_permission_to_specific_content_type()
    {
        $content = $this->fakeContent(
            1,
            [
                'type' => 'course',
            ]
        );
        $permission = $this->fakePermission();

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $permission[0]->getId(),
                'content_type' => $content[0]->getType(),
            ]
        );

        $expectedResults = [
            'id' => 1,
            "content_type" => $content[0]->getType(),
            "brand" => config('railcontent.brand'),
            'content_id' => null,
            "permission_id" => $permission[0]->getId(),
            "name" => $permission[0]->getName(),
            "brand" => config('railcontent.brand'),
        ];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($expectedResults, $response->decodeResponseJson('data'));
    }

    public function test_assign_permission_validation()
    {
        $randomPermissionId = $this->faker->numberBetween();
        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $randomPermissionId,
            ]
        );

        $decodedResponse = $response->decodeResponseJson('meta')['errors'];

        $this->assertEquals(422, $response->getStatusCode());

        $expectedErrors = [
            [
                'source' => 'id',
                'detail' => 'The selected permission id is invalid.',
            ],
            [
                'source' => 'type',
                'detail' => 'The content type field is required when none of content type are present.',
            ],
            [
                'source' => 'id',
                'detail' => 'The content id field is required when none of content type are present.',
            ],
            [
                'source' => 'content_type',
                'detail' => 'The content type field is required when none of content id are present.',
            ],

        ];
        $this->assertEquals($expectedErrors, $decodedResponse);
    }

    public function test_assign_permission_incorrect_content_id()
    {
        $permission = $this->fakePermission();

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $permission[0]->getId(),
                'content_id' => rand(),
            ]
        );
        $decodedResponse = $response->decodeResponseJson('meta');
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('errors', $decodedResponse);
        $expectedErrors = [
            [
                'source' => 'id',
                'detail' => 'The selected content id is invalid.',
            ],
        ];
        $this->assertEquals($expectedErrors, $decodedResponse['errors']);
    }

    public function test_assign_permission_incorrect_content_type()
    {
        $permission = $this->fakePermission();

        $response = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'permission_id' => $permission[0]->getId(),
                'content_type' => $this->faker->word,
            ]
        );

        $this->assertEquals(422, $response->getStatusCode());


        $decodedResponse = $response->decodeResponseJson('meta');
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('errors', $decodedResponse);
        $expectedErrors = [
            [
                'source' => 'content_type',
                'detail' => 'The selected content type is invalid.',
            ],
        ];
        $this->assertEquals($expectedErrors, $decodedResponse['errors']);
    }

    public function test_dissociation_by_content_id()
    {
        $content = $this->fakeContent();
        $permission = $this->fakePermission();

        $this->contentPermissionService->create($content[0]->getId(), null, $permission[0]->getId());
        $data = ['content_id' => $content[0]->getId(), 'permission_id' => $permission[0]->getId()];

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'content_permissions',
            [
                'permission_id' => $permission[0]->getId(),
                'content_id' => $content[0]->getId(),
            ]
        );

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);

        $this->assertEquals(200, $response->status());

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_permissions',
            [
                'permission_id' => $permission[0]->getId(),
                'content_id' => $content[0]->getId(),
            ]
        );
    }

    public function test_dissociation_by_content_type()
    {
        $content = $this->fakeContent(
            1,
            [
                'type' => 'course',
            ]
        );
        $permission = $this->fakePermission();

        $this->contentPermissionService->create(null, 'course', $permission[0]->getId());

        $data = ['content_type' => $content[0]->getType(), 'permission_id' => $permission[0]->getId()];
        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'content_permissions',
            ['content_type' => 'course', 'permission_id' => $permission[0]->getId()]
        );

        $response = $this->call('PATCH', 'railcontent/permission/dissociate/', $data);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing(
            config('railcontent.table_prefix') . 'content_permissions',
            ['content_type' => 'course', 'permission_id' => $permission[0]->getId()]
        );
    }

    public function test_content_filter_after_permission_assignation()
    {
        $type = $this->faker->word;

        $contents = $this->fakeContent(
            10,
            [
                'status' => 'published',
                'type' => $type,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $types = [$type, $this->faker->word];
        $page = 1;
        $limit = 10;

        $firstRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );
        $this->assertTrue(
            in_array($contents[0]->getId(), array_pluck($firstRequest->decodeResponseJson('data'), 'id'))
        );

        $permission = $this->fakePermission();

        $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'brand' => config('railcontent.brand'),
                'permission_id' => $permission[0]->getId(),
                'content_id' => $contents[0]->getId()
            ]
        );

        $secondRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );

        $this->assertEquals(
            $secondRequest->decodeResponseJson('meta')['pagination']['total'],
            $firstRequest->decodeResponseJson('meta')['pagination']['total'] - 1
        );

        $this->assertFalse(
            in_array($contents[0]->getId(), array_pluck($secondRequest->decodeResponseJson('data'), 'id'))
        );
    }

    public function test_content_filter_after_type_permission_assignation()
    {
        $userId = $this->createAndLogInNewUser();

        $type = 'dddd';

        $contents = $this->fakeContent(
            10,
            [
                'status' => 'published',
                'type' => $type,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $types = [$type, $this->faker->word];
        $page = 1;
        $limit = 10;

        $firstRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );

        $this->assertTrue(
            in_array(
                $type,
                array_pluck($firstRequest->decodeResponseJson('data'), 'type')
            )
        );

        $permission = $this->fakePermission();

        $a = $this->call(
            'PUT',
            'railcontent/permission/assign',
            [
                'brand' => config('railcontent.brand'),
                'content_type' => $contents[0]->getType(),
                'permission_id' => $permission[0]->getId()
            ]
        );

        $userPermission = $this->fakeUserPermission(
            1,
            [
                'userId' => $userId,
                'permission' => $permission[0],
                'startDate' => Carbon::now(),
                'expirationDate' => null,
            ]
        );

        $secondRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );

        $this->assertTrue(
            in_array(
                $type,
                array_pluck($secondRequest->decodeResponseJson('data'), 'type')
            )
        );
    }

    public function test_contents_filter_without_rights()
    {
        $user = $this->createAndLogInNewUser();

        $type = $this->faker->word;

        $contents = $this->fakeContent(
            10,
            [
                'status' => 'published',
                'type' => $type,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $permission = $this->fakePermission();

        $this->fakeContentPermission(
            1,
            [
                'content' => $contents[0],
                'permission' => $permission[0],
                'brand' => config('railcontent.brand'),
            ]
        );

        $types = [$type, $this->faker->word];
        $page = 1;
        $limit = 10;

        $firstRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );

        $this->assertEquals(9, $firstRequest->decodeResponseJson('meta')['pagination']['total']);

        $response = $this->call(
            'PATCH',
            'railcontent/permission/dissociate/',
            [
                'permission_id' => $permission[0]->getId(),
                'content_id' => $contents[0]->getId()
            ]
        );
        $secondRequest = $this->call(
            'GET',
            'railcontent/content',
            [
                'page' => $page,
                'limit' => $limit,
                'sort' => 'id',
                'included_types' => $types,
            ]
        );
        $this->assertEquals(10, $secondRequest->decodeResponseJson('meta')['pagination']['total']);
    }

    public function test_getByContentTypeOrIdAndByPermissionId()
    {
        $contents = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'type' => 'course',
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $permission = $this->fakePermission(
            2,
            [
                'brand' => config('railcontent.brand'),
            ]
        );

        $type = $this->faker->word;
        $otherTypeContent = $this->fakeContent(
            1,
            [
                'status' => 'published',
                'type' => $type,
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $this->fakeContentPermission(
            1,
            [
                'content' => $contents[0],
                'permission' => $permission[0],
                'brand' => config('railcontent.brand'),
            ]
        );
        $this->fakeContentPermission(
            1,
            [
                'contentType' => $type,
                'permission' => $permission[0],
                'brand' => config('railcontent.brand'),
            ]
        );

        $this->fakeContentPermission(
            1,
            [
                'contentType' => $type,
                'permission' => $permission[0],
                'brand' => $this->faker->word,
            ]
        );

        $results = $this->contentPermissionService->getByContentTypeOrIdAndByPermissionId(
            $contents[0]->getId(),
            $type,
            $permission[0]->getId()
        );

        $this->assertEquals(2, count($results));

        foreach ($results as $result) {
            $this->assertTrue(
                (($result->getContentType() == $type) ||
                    ($result->getContent()
                            ->getId() == $contents[0]->getId())) &&
                $result->getPermission()
                    ->getId() == $permission[0]->getId()
            );
        }
    }
}
