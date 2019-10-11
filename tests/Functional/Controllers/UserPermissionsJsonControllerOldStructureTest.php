<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\Fixtures\UserProvider;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserPermissionsJsonControllerOldStructureTest extends RailcontentTestCase
{

    public function setUp()
    {
        parent::setUp();

        ResponseService::$oldResponseStructure = true;
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
                    'source' => 'id',
                    'detail' => 'The selected permission id is invalid.',
                ],
            ],
            $results->decodeResponseJson('meta')['errors']
        );
    }

    public function test_store()
    {
        $user = $this->fakeUser();

        $permission = $this->fakePermission();

        $results = $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'user_id' => $user['id'],
                'permission_id' => $permission[0]->getId(),
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertArraySubset(
            [
                'id' => 1,
                'user_id' => $user['id'],
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'permission_id' => $permission[0]->getId(),
            ],
            $results->decodeResponseJson('data')
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'user_permissions',
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

        $userId = $this->createAndLogInNewUser();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'user' => $this->app->make(UserProvider::class)
                    ->getRailcontentUserById($userId),
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
                'user_id' => $userId,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->addMinutes(1)
                    ->toDateTimeString(),
                'permission_id' => $permission[0]->getId(),
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertArraySubset(
            [
                'id' => 1,
                'user_id' => $userId,
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'permission_id' => $permission[0]->getId(),
                'expiration_date' => Carbon::now()
                    ->addMinutes(1)
                    ->toDateTimeString(),
            ],
            $results->decodeResponseJson('data')
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix') . 'user_permissions',
            [
                'user_id' => $userId,
                'permission_id' => $permission[0]->getId(),
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->addMinutes(1)
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
                'start_date' => $this->faker->word,
                'permission_id' => rand(),
                'user_id' => rand()
            ]
        );

        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals(
            [
                [
                    'source' => 'id',
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
                'title' => 'Not found.',
                'detail' => 'Delete failed, user permission not found with id: ' . $randomId,
            ],
            $results->decodeResponseJson('errors')
        );
    }

    public function test_delete_user_permission()
    {
        $permission = $this->fakePermission();

        $user = $this->fakeUser();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'user' => $this->app->make(UserProvider::class)
                    ->getRailcontentUserById($user['id']),
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
            config('railcontent.table_prefix') . 'user_permissions',
            [
                'id' => $userPermissionId,
                'user_id' => $user['id'],
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
        $user = $this->fakeUser();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'user' => $this->app->make(UserProvider::class)
                    ->getRailcontentUserById($user['id']),
                'permission' => $permissions[0],
                'expirationDate' => Carbon::now()
                    ->addDays(10),
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
                'updatedAt' => null,
            ]
        );
        $this->populator->execute();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'user' => $this->app->make(UserProvider::class)
                    ->getRailcontentUserById($user['id']),
                'permission' => $permissions[1],
                'expirationDate' => null,
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
                'updatedAt' => null,
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
        $user = $this->fakeUser();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'user' => $this->app->make(UserProvider::class)
                    ->getRailcontentUserById($user['id']),
                'permission' => $permissions[0],
                'expirationDate' => Carbon::now()
                    ->addDays(10),
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
                'updatedAt' => null,
            ]

        );
        $this->populator->execute();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'user' => $this->app->make(UserProvider::class)
                    ->getRailcontentUserById($user['id']),
                'permission' => $permissions[1],
                'expirationDate' => null,
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
                'updatedAt' => null,
            ]

        );
        $this->populator->execute();

        //pull all the active user permissions
        $results = $this->call(
            'GET',
            '/railcontent/user-permission',
            [
                'user_id' => $user['id'],
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(2, count($results->decodeResponseJson('data')));
    }

    public function test_index_pull_active_and_expired_user_permissions()
    {
        $permissions = $this->fakePermission(2);
        $user = $this->fakeUser();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'user' => $this->app->make(UserProvider::class)
                    ->getRailcontentUserById($user['id']),
                'permission' => $permissions[0],
                'expirationDate' => Carbon::now()
                    ->subMonth(10),
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
                'updatedAt' => null,
            ]
        );
        $this->populator->execute();

        $this->populator->addEntity(
            UserPermission::class,
            1,
            [
                'user' => $this->app->make(UserProvider::class)
                    ->getRailcontentUserById($user['id']),
                'permission' => $permissions[1],
                'expirationDate' => null,
                'startDate' => Carbon::now(),
                'createdAt' => Carbon::now(),
                'updatedAt' => null,
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

    public function test_old_user_cache_deleted_when_new_user_permission_activate()
    {
        $userId = $this->createAndLogInNewUser();
        $content1 = $this->fakeContent(
            2,
            [
                'slug' => $this->faker->word,
                'type' => $this->faker->word,
                'status' => 'published',
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $permission1 = $this->fakePermission();

        $contentPermission = $this->fakeContentPermission(
            1,
            [
                'content' => $content1[0],
                'permission' => $permission1[0],
                'brand' => config('railcontent.brand'),
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
        $this->assertEquals(1, $response->decodeResponseJson('meta')['pagination']['total']);
        $this->assertEquals($content1[1]->getId(), $response->decodeResponseJson('data')[0]['id']);

        //assign permission to user
        $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'start_date' => Carbon::now()
                    ->toDateTimeString(),
                'permission_id' =>  $permission1[0]->getId(),
                'user_id' => $userId
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

        $this->assertEquals(2, $response->decodeResponseJson('meta')['pagination']['total']);
        $this->assertEquals($content1[0]->getId(), $response->decodeResponseJson('data')[0]['id']);
        $this->assertEquals($content1[1]->getId(), $response->decodeResponseJson('data')[1]['id']);
    }

    public function test_user_cache_deleted_when_user_permission_deleted()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'slug' => $this->faker->word,
                'type' => $this->faker->word,
                'status' => 'published',
                'brand' => config('railcontent.brand'),
                'publishedOn' => Carbon::now(),
            ]
        );

        $permission = $this->fakePermission();

        $this->fakeContentPermission(
            1,
            [
                'content' => $content[0],
                'permission' => $permission[0],
                'brand' => config('railcontent.brand'),
            ]
        );

        $userPermission = $this->fakeUserPermission(
            1,
            [
                'user' => $this->app->make(UserProvider::class)
                    ->getRailcontentUserById($userId),
                'permission' => $permission[0],
                'startDate' => Carbon::now(),
                'expirationDate' => null,
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content'
        );

        $this->assertTrue(in_array($content[0]->getId(), array_pluck($response->decodeResponseJson('data'), 'id')));

        $this->call(
            'DELETE',
            'railcontent/user-permission/' . $userPermission[0]->getId()
        );

        $response = $this->call(
            'GET',
            'railcontent/content'
        );

        $this->assertFalse(in_array($content[0]->getId(), array_pluck($response->decodeResponseJson('data'), 'id')));

    }

    public function test_user_multiple_permissions()
    {
        $userId = $this->createAndLogInNewUser();

        $content = $this->fakeContent(
            1,
            [
                'slug' => $this->faker->word,
                'type' => $this->faker->word,
                'status' => 'published',
                'brand' => config('railcontent.brand'),
                'language' => 'en',
            ]
        );

        $permission = $this->fakePermission(2);

        $contentPermission = $this->fakeContentPermission(
            1,
            [
                'content' => $content[0],
                'permission' => $permission[0],
            ]
        );

        $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'start_date' => Carbon::now()
                    ->subDay(1)
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->addDays(3)
                    ->toDateTimeString(),
                'permission_id' =>  $permission[0]->getId(),
                'user_id' => $userId
            ]
        );

        $this->call(
            'GET',
            'railcontent/content'
        );

        $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'start_date' => Carbon::now()
                    ->addHour(1)
                    ->toDateTimeString(),
                'expiration_date' => Carbon::now()
                    ->addDays(3)
                    ->toDateTimeString(),
                'permission_id' => $permission[1]->getId(),
                'user_id' => $userId
            ]
        );
        $cacheKeys = Redis::keys('*pull*');
        $redisTTL = Redis::ttl($cacheKeys[0]);

        //expected 1 hour in seconds (the expiration date for user's permission 1)
        $recentExpirationSeconds = 1 * 60 * 60;

        $this->assertEquals($recentExpirationSeconds, $redisTTL);
    }

}
