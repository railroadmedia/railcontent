<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Faker\ORM\Doctrine\Populator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserPermissionsJsonControllerTest extends RailcontentTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        Cache::store('redis')
            ->flush();
    }

    public function test_store_validation()
    {
        $results = $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'data' => [
                    'attributes' => [
                        'user_id' => $this->faker->numberBetween(),
                        'start_date' => Carbon::now()
                            ->toDateTimeString(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $this->faker->numberBetween(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals(
            [
                [
                    'source' => 'data.relationships.permission.data.id',
                    'detail' => 'The selected permission is invalid.',
                    'title' => 'Validation failed.',
                ],
            ],
            $results->decodeResponseJson('errors')
        );
    }

    public function test_store()
    {
        $permission = $this->fakePermission();

        $results = $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'data' => [
                    'attributes' => [
                        'user_id' => 1,
                        'start_date' => Carbon::now()
                            ->toDateTimeString(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertArraySubset(
            [
                'data' => [
                    'attributes' => [
                        'user_id' => 1,
                        'start_date' => Carbon::now()
                            ->toDateTimeString(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ],
            $results->decodeResponseJson()
        );

        $this->assertDatabaseHas(
            ConfigService::$tableUserPermissions,
            [
                'user_id' => 1,
                'permission_id' => $permission[0]->getId(),
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => null,
                'created_at' => Carbon::now()
                    ->toDateTimeString(),
                'updated_at' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
    }

    public function test_update()
    {
        $permission = $this->fakePermission();

        $userId = $this->faker->numberBetween();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'userId' => $userId,
                'permission' => $permission[0],
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
            ]
        );
        $fakeData = $this->populator->execute();
        $userPermission = $fakeData[UserPermission::class][0];

        $results = $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'data' => [
                    'attributes' => [
                        'user_id' => $userId,
                        'start_date' => Carbon::now()
                            ->toDateTimeString(),
                        'expiration_date' => Carbon::now()
                            ->addMonth(1)
                            ->toDateTimeString(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission[0]->getId(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertArraySubset(
            [
                'type' => 'userPermission',
                'id' => 1,
                'attributes' => [
                    'user_id' => $userId,
                    'start_date' => Carbon::now()
                        ->toDateTimeString(),
                    'expiration_date' => Carbon::now()
                        ->addMonth(1)
                        ->toDateTimeString(),
                ],
                'relationships' => [
                    'permission' => [
                        'data' => [
                            'type' => 'permission',
                            'id' => $permission[0]->getId(),
                        ],
                    ],
                ],
            ],
            $results->decodeResponseJson('data')
        );

        $this->assertDatabaseHas(
            ConfigService::$tableUserPermissions,
            [
                'user_id' => $userId,
                'permission_id' => $permission[0]->getId(),
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->addMonth(1)
                    ->toDateTimeString(),
                'updated_at' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );
    }

    public function test_update_validation()
    {
        $results = $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'data' => [
                    'attributes' => [
                        'user_id' => rand(),
                        'start_date' => $this->faker->word,
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => rand(),
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals(
            [
                [
                    'source' => 'data.relationships.permission.data.id',
                    'detail' => 'The selected permission is invalid.',
                    'title' => 'Validation failed.',
                ],
                [
                    "source" => "data.attributes.start_date",
                    "detail" => "The start date is not a valid date.",
                    'title' => 'Validation failed.',
                ],
            ],
            $results->decodeResponseJson('errors')
        );
    }

    public function test_delete_user_permission_not_exist()
    {
        $randomId = rand();
        $results = $this->call('DELETE', '/railcontent/user-permission/' . $randomId);
        $this->assertEquals(404, $results->getStatusCode());
        $this->assertEquals(
            [
                'title' => 'Not found.',
                'detail' => 'Delete failed, user permission not found with id: ' . $randomId,
            ],
            $results->decodeResponseJson('errors')
        );
    }

    public function test_delete_user_permission()
    {
        $permission = $this->fakePermission();

        $userId = rand();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'userId' => $userId,
                'permission' => $permission[0],
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
            ]
        );
        $fakeData = $this->populator->execute();
        $userPermission = $fakeData[UserPermission::class][0];
        $userPermissionId = $userPermission->getId();

        $results = $this->call('DELETE', '/railcontent/user-permission/' . $userPermissionId);
        $this->assertEquals(204, $results->getStatusCode());

        $this->assertDatabaseMissing(
            ConfigService::$tableUserPermissions,
            [
                'id' => $userPermissionId,
                'user_id' => $userId,
                'permission_id' => $permission[0]->getId(),
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
        $permissions = $this->fakePermission(2);
        $userId = rand();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'userId' => $userId,
                'permission' => $permissions[0],
                'expirationDate' => Carbon::now()
                    ->addDays(10),
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
            ]
        );
        $this->populator->execute();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'userId' => $userId,
                'permission' => $permissions[1],
                'expirationDate' => null,
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
            ]
        );
        $this->populator->execute();

        //pull all the active user permissions
        $results = ($this->call('GET', '/railcontent/user-permission'));

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(2, count($results->decodeResponseJson('data')));
    }

    public function test_index_specific_user_active_permissions()
    {
        $permissions = $this->fakePermission(2);
        $userId = rand();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'userId' => $userId,
                'permission' => $permissions[0],
                'expirationDate' => Carbon::now()
                    ->addDays(10),
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
            ]

        );
        $this->populator->execute();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'userId' => rand(),
                'permission' => $permissions[1],
                'expirationDate' => null,
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
            ]

        );
        $this->populator->execute();

        //pull all the active user permissions
        $results = $this->call(
            'GET',
            '/railcontent/user-permission',
            [
                'user_id' => $userId,
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(1, count($results->decodeResponseJson('data')));
    }

    public function test_index_pull_active_and_expired_user_permissions()
    {
        $permissions = $this->fakePermission(2);
        $userId = rand();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'userId' => $userId,
                'permission' => $permissions[0],
                'expirationDate' => Carbon::now()
                    ->subMonth(10),
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
            ]
        );
        $this->populator->execute();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'userId' => $userId,
                'permission' => $permissions[1],
                'expirationDate' => null,
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
            ]
        );
        $this->populator->execute();

        //pull all the active user permissions
        $results = $this->call(
            'GET',
            '/railcontent/user-permission',
            [
                'only_active' => false,
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(2, count($results->decodeResponseJson('data')));
    }

    public function _test_old_user_cache_deleted_when_new_user_permission_activate()
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
                'permission_id' => $permission1['id'],
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
                'permission_id' => $permission1['id'],
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

    public function _test_ttl_to_user_permission_start_date()
    {
        $userId = $this->createAndLogInNewUser();

        $userCacheKeys = CacheHelper::getUserSpecificHashedKey();

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
            'railcontent/permission/assign',
            [
                'content_id' => $content1['id'],
                'permission_id' => $permission1['id'],
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
                'permission_id' => $permission1['id'],
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
                $userCacheKeys
            )
        );

        //assert ttl it's the seconds until permission activation date
        $this->assertEquals(
            60 * 60,
            Redis::ttl(
                $userCacheKeys
            )
        );
    }

    public function _test_user_cache_deleted_when_user_permission_deleted()
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
            'railcontent/permission/assign',
            [
                'content_id' => $content['id'],
                'permission_id' => $permission['id'],
            ]
        );

        $userPermission = $this->userPermissionRepository->create(
            [
                'user_id' => $userId,
                'permission_id' => $permission['id'],
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
            'railcontent/user-permission/' . $userPermission['id']
        );

        $this->assertEquals(
            [],
            Redis::hgetall(
                Cache::store(ConfigService::$cacheDriver)
                    ->getPrefix() . 'userId_' . $userId
            )
        );
    }

    public function _test_user_multiple_permissions()
    {
        $userId = $this->createAndLogInNewUser();

        $userCacheKeys = CacheHelper::getUserSpecificHashedKey();

        $content = $this->contentRepository->create(
            [
                'slug' => $this->faker->word,
                'type' => $this->faker->word,
                'status' => 'published',
                'brand' => ConfigService::$brand,
                'language' => 'en',
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

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
                'permission_id' => $permission['id'],
            ]
        );

        $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'user_id' => $userId,
                'permission_id' => $permission['id'],
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
                'permission_id' => $permission2['id'],
                'start_date' => Carbon::now()
                    ->addDays(5)
                    ->toDateTimeString(),
            ]
        );

        //expected 5 days in seconds (the expiration date for user's permission 1)
        $recentExpirationSeconds = 5 * 24 * 60 * 60;

        $redisTTL = Redis::ttl($userCacheKeys);

        $this->assertEquals($recentExpirationSeconds, $redisTTL);
    }
}
