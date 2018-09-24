<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Factories\ContentFactory;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentPermissionRepository;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserPermissionsRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserPermissionsJsonControllerTest extends RailcontentTestCase
{
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * @var UserPermissionsRepository
     */
    private $userPermissionRepository;

    /**
     * @var ContentPermissionRepository
     */
    private $contentPermissionRepository;

    /**
     * @var ContentFactory
     */
    private $contentFactory;

    public function setUp()
    {
        parent::setUp();
        $this->permissionRepository = $this->app->make(PermissionRepository::class);
        $this->userPermissionRepository = $this->app->make(UserPermissionsRepository::class);
        $this->contentPermissionRepository = $this->app->make(ContentPermissionRepository::class);
        $this->contentFactory = $this->app->make(ContentFactory::class);
    }

    protected function tearDown()
    {
//        Cache::store('redis')
//            ->flush();
    }

    public function test_store_validation()
    {
        $results = $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'user_id' => $this->faker->numberBetween(),
                'permission_id' => $this->faker->numberBetween(),
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals(
            [
                [
                    'source' => 'permission_id',
                    'detail' => 'The selected permission id is invalid.',
                ],
            ],
            $results->decodeResponseJson('meta')['errors']
        );
    }

    public function test_store()
    {
        $permission = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $contentPermission = $this->contentPermissionRepository->create(
            [
                'content_id' => 1,
                'permission_id' => $permission,
            ]
        );
        $userId = $this->createAndLogInNewUser();
        $results = $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertArraySubset(
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => null,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'updated_on' => null,
            ],
            $results->decodeResponseJson('data')[0]
        );
        $this->assertDatabaseHas(
            ConfigService::$tableUserPermissions,
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => null,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'updated_on' => null,
            ]
        );
    }

    public function test_update()
    {
        $permission = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $userId = $this->faker->numberBetween();

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $results = $this->call(
            'PATCH',
            'railcontent/user-permission/' . $userPermission,
            [
                'expiration_date' => Carbon::now()
                    ->addMonth(1)
                    ->toDateTimeString(),
            ]
        );
        $this->assertEquals(201, $results->getStatusCode());
        $this->assertArraySubset(
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->addMonth(1)
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'updated_on' => Carbon::now()
                    ->toDateTimeString(),
            ],
            $results->decodeResponseJson('data')[0]
        );
        $this->assertDatabaseHas(
            ConfigService::$tableUserPermissions,
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->addMonth(1)
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'updated_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
    }

    public function test_update_user_permission_not_exists()
    {
        $randomId = rand();
        $results = $this->call('PATCH', '/railcontent/user-permission/' . $randomId);
        $this->assertEquals(404, $results->getStatusCode());
        $this->assertEquals(
            [
                'title' => 'Entity not found.',
                'detail' => 'Update failed, user permission not found with id: ' . $randomId,
            ],
            $results->decodeResponseJson('meta')['errors']
        );
    }

    public function test_update_validation()
    {
        $permission = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $userId = $this->faker->numberBetween();

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $results = $this->call(
            'PATCH',
            'railcontent/user-permission/' . $userPermission,
            [
                'permission_id' => rand(),
                'start_date' => $this->faker->word,
            ]
        );
        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals(
            [
                [
                    'source' => 'permission_id',
                    'detail' => 'The selected permission id is invalid.',
                ],
                [
                    "source" => "start_date",
                    "detail" => "The start date is not a valid date.",
                ],
            ],
            $results->decodeResponseJson('meta')['errors']
        );
    }

    public function test_delete_user_permission_not_exist()
    {
        $randomId = rand();
        $results = $this->call('DELETE', '/railcontent/user-permission/' . $randomId);
        $this->assertEquals(404, $results->getStatusCode());
        $this->assertEquals(
            [
                'title' => 'Entity not found.',
                'detail' => 'Delete failed, user permission not found with id: ' . $randomId,
            ],
            $results->decodeResponseJson('meta')['errors']
        );
    }

    public function test_delete_user_permission()
    {
        $permission = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $userId = $this->faker->numberBetween();

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $results = $this->call('DELETE', '/railcontent/user-permission/' . $permission);
        $this->assertEquals(204, $results->getStatusCode());

        $this->assertDatabaseMissing(
            ConfigService::$tableUserPermissions,
            [
                'id' => $userPermission,
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => null,
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'updated_on' => null,
            ]
        );
    }

    public function test_index_all_active_permissions()
    {
        $permission1 = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );

        $permission2 = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 1,
                'permission_id' => $permission1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 2,
                'permission_id' => $permission1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 1,
                'permission_id' => $permission2,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->subMonth(1)
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        //pull all the active user permissions
        $results = ($this->call('GET', '/railcontent/user-permission'));

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(2, count($results->decodeResponseJson('data')));
    }

    public function test_index_specific_user_active_permissions()
    {
        $permission1 = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );

        $permission2 = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 1,
                'permission_id' => $permission1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 2,
                'permission_id' => $permission1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 1,
                'permission_id' => $permission2,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->subMonth(1)
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        //pull all the active user permissions
        $results = $this->call(
            'GET',
            '/railcontent/user-permission',
            [
                'user_id' => 1,
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(1, count($results->decodeResponseJson('data')));
    }

    public function test_index_pull_active_and_expired_user_permissions()
    {
        $permission1 = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );

        $permission2 = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 1,
                'permission_id' => $permission1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 2,
                'permission_id' => $permission1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => 1,
                'permission_id' => $permission2,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->subMonth(1)
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        //pull all the active user permissions
        $results = $this->call(
            'GET',
            '/railcontent/user-permission',
            [
                'only_active' => false,
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(3, count($results->decodeResponseJson('data')));
    }

    public function test_old_user_cache_deleted_when_new_user_permission_activate()
    {
        $userId = $this->createAndLogInNewUser();
        $content1 = $this->contentFactory->create();
        $content2 = $this->contentFactory->create();
        $permission1 = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $contentPermission = $this->contentPermissionRepository->create(
            [
                'content_id' => $content1['id'],
                'permission_id' => $permission1,
            ]
        );

        //only the content2 it's returned to the user
        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'sort' => 'id',
            ]

        );
        $this->assertArraySubset([(array)$content2], $response->decodeResponseJson('data'));

        //assign permission to user
        $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'user_id' => $userId,
                'permission_id' => $permission1,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        //both contents are returned to user
        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'sort' => 'id',
            ]
        );
        $this->assertArraySubset([(array)$content1, (array)$content2], $response->decodeResponseJson('data'));
    }

    public function test_ttl_to_user_permission_start_date()
    {
        $userId = $this->createAndLogInNewUser();
        $content1 = $this->contentFactory->create();
        $content2 = $this->contentFactory->create();
        $permission1 = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $contentPermission = $this->call(
            'PUT',
            'railcontent/permission/assign',[
                'content_id' => $content1['id'],
                'permission_id' => $permission1
            ]
        );

        //only the content2 it's returned to the user
        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'sort' => 'id',
            ]
        );
        $this->assertArraySubset([(array)$content2], $response->decodeResponseJson('data'));

        //assign permission to user
        $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'user_id' => $userId,
                'permission_id' => $permission1,
                'start_date' => Carbon::now()
                    ->addMinutes(60)
                    ->toDateTimeString(),
            ]
        );

        //both contents are returned to user
        $response2 = $this->call(
            'GET',
            'railcontent/content',
            [
                'sort' => 'id',
            ]
        );
        // assert that the user receive only content 2
        $this->assertArraySubset([(array)$content2], $response2->decodeResponseJson('data'));

        //assert that the time to live was set for user cached keys
        $this->assertNotEquals(
            -1,
            Redis::ttl(
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId
            )
        );
    }

    public function test_user_cache_deleted_when_user_permission_deleted()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create();
        $permission = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $contentPermission = $this->call(
            'PUT',
            'railcontent/permission/assign',[
                'content_id' => $content['id'],
                'permission_id' => $permission
            ]
        );

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content',
            [
                'sort' => 'id',
            ]
        );
        $this->assertArraySubset([(array)$content], $response->decodeResponseJson('data'));


        $this->call(
            'DELETE',
            'railcontent/user-permission/' . $userPermission
        );

        $this->assertEquals(
            [],
            Redis::hgetall(
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId
            )
        );
    }

    public function test_user_multiple_permissions()
    {
        $userId = $this->createAndLogInNewUser();
        $content = $this->contentFactory->create();
        $permission = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $permission2 = $this->permissionRepository->create(
            [
                'name' => $this->faker->word,
                'brand' => ConfigService::$brand,
            ]
        );
        $contentPermission = $this->contentPermissionRepository->create(
            [
                'content_id' => $content['id'],
                'permission_id' => $permission,
            ]
        );

        $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'user_id' => $userId,
                'permission_id' => $permission,
                'start_date' => Carbon::now()
                    ->subDay(1)
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->addDays(3)
                    ->toDateTimeString(),
            ]
        );

        $this->call(
            'GET',
            'railcontent/content',
            [
                'sort' => 'id',
            ]
        );

        $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'user_id' => $userId,
                'permission_id' => $permission2,
                'start_date' => Carbon::now()
                    ->addDays(5)
                    ->toDateTimeString(),
            ]
        );

        $userCacheKeys = Cache::store(ConfigService::$cacheDriver)
                ->getPrefix() . 'userId_' . $userId;

        $recentExpirationDate =
            Carbon::now()
                ->addMinutes(ConfigService::$cacheTime)
                ->toDateTimeString();

        $redisTTL =
            Carbon::createFromTimestamp(Redis::ttl($userCacheKeys))
                ->toDateTimeString();

        $this->assertEquals($recentExpirationDate, $redisTTL);

    }
}
