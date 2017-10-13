<?php
/**
 * Created by PhpStorm.
 * User: roxana
 * Date: 9/7/2017
 * Time: 10:59 AM
 */

namespace Railroad\Railcontent\Tests\Functional\Repositories;

use Carbon\Carbon;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class PermissionRepositoryTest extends RailcontentTestCase
{
    protected $classBeingTested, $languageId;

    protected function setUp()
    {
        parent::setUp();

        $this->classBeingTested = $this->app->make(PermissionRepository::class);
        $userId = $this->createAndLogInNewUser();
        $this->languageId = $this->setUserLanguage($userId);
    }

    public function test_create_permission()
    {
        $name = $this->faker->word;

        $permissionId = $this->classBeingTested->create($name);

        $this->assertDatabaseHas(
            ConfigService::$tablePermissions,
            [
                'id' => $permissionId,
                'created_on' => Carbon::now()->toDateTimeString()
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'entity_type' => ConfigService::$tablePermissions,
                'entity_id' => $permissionId,
                'language_id' => $this->languageId,
                'value' => $name
            ]
        );
    }

    public function test_update_permission_name()
    {
        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->languageId, $permissionId, ConfigService::$tablePermissions, $permissionName);

        $newName = $this->faker->word;

        $this->classBeingTested->update($permissionId, $newName);

        $this->assertDatabaseHas(
            ConfigService::$tablePermissions,
            [
                'id' => $permissionId,
                'created_on' => Carbon::now()->toDateTimeString()
            ]
        );

        $this->assertDatabaseMissing(
            ConfigService::$tableTranslations,
            [
                'entity_type' => ConfigService::$tablePermissions,
                'entity_id' => $permissionId,
                'value' => $permissionName,
                'language_id' => $this->languageId
            ]
        );

        $this->assertDatabaseHas(
            ConfigService::$tableTranslations,
            [
                'entity_type' => ConfigService::$tablePermissions,
                'entity_id' => $permissionId,
                'value' => $newName,
                'language_id' => $this->languageId
            ]
        );
    }

    public function test_delete_permission()
    {
        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];
        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->languageId, $permissionId, ConfigService::$tablePermissions, $permissionName);

        $this->classBeingTested->delete($permissionId);

        $this->assertDatabaseMissing(
            ConfigService::$tablePermissions,
            [
                'id' => $permissionId
            ]
        );

        //check that the permission name was deleted
        $this->assertDatabaseMissing(
            ConfigService::$tableTranslations,
            [
                'entity_type' => ConfigService::$tablePermissions,
                'entity_id' => $permissionId
            ]
        );
    }

    public function test_get_permission_by_id()
    {
        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->languageId, $permissionId, ConfigService::$tablePermissions, $permissionName);

        $response = $this->classBeingTested->getById($permissionId);

        $this->assertEquals(
            array_merge(['id' => $permissionId, 'name' => $permissionName], $permission),
            $response
        );
    }

    public function test_get_permission_by_id_none_exist()
    {
        $response = $this->classBeingTested->getById(rand());

        $this->assertEquals(
            null,
            $response
        );
    }

    public function test_assign_permission_to_specific_content()
    {
        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->languageId, $permissionId, ConfigService::$tablePermissions, $permissionName);

        $content = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->languageId, $contentId, ConfigService::$tableContent, $contentSlug);

        $this->classBeingTested->assign($permissionId, $contentId, null);

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'id' => $permissionId,
                'content_id' => $contentId,
                'content_type' => null,
                'required_permission_id' => $permissionId
            ]
        );
    }

    public function test_assign_permission_to_content_type()
    {
        $permission = [
            'created_on' => Carbon::now()->toDateTimeString()
        ];

        $permissionId = $this->query()->table(ConfigService::$tablePermissions)->insertGetId($permission);

        $permissionName = $this->faker->word;
        $this->translateItem($this->languageId, $permissionId, ConfigService::$tablePermissions, $permissionName);

        $content = [
            'status' => $this->faker->word,
            'type' => $this->faker->word,
            'position' => $this->faker->numberBetween(),
            'parent_id' => null,
            'published_on' => null,
            'created_on' => Carbon::now()->toDateTimeString(),
            'archived_on' => null,
        ];

        $contentId = $this->query()->table(ConfigService::$tableContent)->insertGetId($content);

        $contentSlug = $this->faker->word;
        $this->translateItem($this->languageId, $contentId, ConfigService::$tableContent, $contentSlug);

        $this->classBeingTested->assign($permissionId, null, $content['type']);

        $this->assertDatabaseHas(
            ConfigService::$tableContentPermissions,
            [
                'id' => $permissionId,
                'content_id' => null,
                'content_type' => $content['type'],
                'required_permission_id' => $permissionId
            ]
        );
    }
}
