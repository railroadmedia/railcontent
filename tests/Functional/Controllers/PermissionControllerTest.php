<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PermissionControllerTest extends RailcontentTestCase
{
    protected $serviceBeingTested, $userId;

    protected function setUp()
    {
        parent::setUp();

        $this->serviceBeingTested = $this->app->make(PermissionService::class);
        $this->classBeingTested = $this->app->make(PermissionRepository::class);

        $this->userId = $this->createAndLogInNewUser();
        $this->setUserLanguage($this->userId);
    }

    public function test_store_response()
    {
        $name = $this->faker->word;

        $response = $this->call('POST', 'permission', [
            'name' => $name
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertTrue($response->content());
    }

    public function test_store_validation()
    {
        $response = $this->call('POST', 'permission');

        $this->assertEquals(302, $response->status());

        //expecting session has error for missing field
        $response->assertSessionHasErrors(['name']);
    }

    public function test_new_permission_returned_after_store_service()
    {
        $name = $this->faker->word;

        $permission = $this->serviceBeingTested->store($name);

        $expectedResult = [
            'id' => 1,
            'name' => $name,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $this->assertEquals($expectedResult, $permission);
    }

    public function test_update_response()
    {
        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $name = $this->faker->word;

        $response = $this->call('PUT', 'permission/'.$permissionId, [
            'name' => $name
        ]);

        $this->assertEquals(201, $response->status());

        $response->assertJsonStructure(
            [
                'id',
                'name',
                'created_on'
            ]
        );

        $response->assertJson(
            [
                'id' => '1',
                'name' => $name,
                'created_on' => Carbon::now()->toDateTimeString()
            ]
        );
    }

    public function test_update_not_exist_permission()
    {

        $name = $this->faker->word;

        $response = $this->call('PUT', 'permission/1', [
            'name' => $name
        ]);

        $this->assertEquals(404, $response->status());

        $this->assertEquals('"Update failed, permission not found with id: 1"', $response->content());
    }

    public function test_update_validation()
    {
        $permission = [
           // 'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $response = $this->call('PUT', 'permission/'.$permissionId);

        $this->assertEquals(302, $response->status());

        //expecting session has error for missing field
        $response->assertSessionHasErrors(['name']);
    }

    public function test_updated_permission_returned_after_update_service()
    {
        $permission = [
          //  'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $newName = $this->faker->word;

        $updatedPermission = $this->serviceBeingTested->update($permissionId, $newName);

        $permission['id'] = $permissionId;
        $permission['name'] = $newName;

        $this->assertEquals($permission, $updatedPermission);
    }

    public function test_delete_permission_response()
    {
        $permission = [
          //  'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $response = $this->call('DELETE', 'permission/'.$permissionId);

        $this->assertEquals(200, $response->status());

        $this->assertEquals('true', $response->content());
    }

    public function test_delete_missing_permission_response()
    {
        $response = $this->call('DELETE', 'permission/1');

        $this->assertEquals(404, $response->status());

        $this->assertEquals('"Delete failed, permission not found with id: 1"', $response->content());
    }

    public function test_delete_permission_in_used_response()
    {
        $permission = [
           // 'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $contentId = 1;

        $contentPermission = [
            'content_id' => $contentId,
            'content_type' => '',
            'required_permission_id' => $permissionId
        ];

        $this->query()->table(ConfigService::$tableContentPermissions)->insertGetId($contentPermission);

        $response = $this->call('DELETE', 'permission/'.$permissionId);

        $this->assertEquals(404, $response->status());

        $this->assertEquals('"This permission is being referenced by other content('.$contentId.'), you must delete that reference first."', $response->content());
    }

    public function test_delete_permission_service_result()
    {
        $permission = [
           // 'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $delete = $this->serviceBeingTested->delete($permissionId);

        $this->assertTrue($delete);
    }

    public function test_delete_permission_when_permission_not_exist_service_result()
    {
        $delete = $this->serviceBeingTested->delete(1);

        $this->assertFalse($delete);
    }

    public function test_assign_permission_to_specific_content()
    {
        $permission = [
           // 'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $contentId = $this->createContent();
        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $response = $this->call('POST', 'permission/assign', [
            'permission_id' => $permissionId,
            'content_id' => $contentId
        ]);

        $this->assertEquals(200, $response->status());

        $this->assertEquals("true", $response->content());
    }

    public function test_assign_permission_to_specific_content_type()
    {
        $permission = [
            //'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $content = [
           // 'slug' => $this->faker->word,
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->createContent($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $response = $this->call('POST', 'permission/assign', [
            'permission_id' => $permissionId,
            'content_type' => $content['type']
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function test_assign_permission_validation()
    {
        $response = $this->call('POST', 'permission/assign', [
            'permission_id' => 1
        ]);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['permission_id', 'content_id', 'content_type']);
    }

    public function test_assign_permission_incorrect_content_id()
    {
        $permission = [
           // 'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $contentId = $this->createContent();

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $response = $this->call('POST', 'permission/assign', [
            'permission_id' => $permissionId,
            'content_id' => ($contentId + 1)
        ]);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['content_id']);
    }

    public function test_assign_permission_incorrect_content_type()
    {
        $permission = [
          //  'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $contentId = $this->createContent();

        $contentSlug = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $contentId, ConfigService::$tableContent, $contentSlug);

        $response = $this->call('POST', 'permission/assign', [
            'permission_id' => $permissionId,
            'content_type' => $this->faker->word
        ]);

        $this->assertEquals(302, $response->status());

        $response->assertSessionHasErrors(['content_type']);
    }

    public function test_assign_permission_to_content_type_service_result()
    {
        $permission = [
          //  'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $assigned = $this->serviceBeingTested->assign($permissionId, null,  $this->faker->word);

        $this->assertTrue($assigned);
    }

    public function test_assign_permission_to_specific_content_service_result()
    {
        $permission = [
          //  'name' => $this->faker->word,
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->classBeingTested->getUserLanguage(), $permissionId, ConfigService::$tablePermissions, $permissionName);

        $assigned = $this->serviceBeingTested->assign($permissionId, $this->faker->numberBetween(), null);

        $this->assertTrue($assigned);
    }
}
