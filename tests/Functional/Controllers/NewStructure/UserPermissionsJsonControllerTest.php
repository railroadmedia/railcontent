<?php

namespace Railroad\Railcontent\Tests\Functional\Controllers\NewStructure;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Entities\UserPermission;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Tests\Fixtures\UserProvider;
use Railroad\Railcontent\Tests\RailcontentTestCase;

class UserPermissionsJsonControllerTest extends RailcontentTestCase
{

    public function setUp()
    {
        parent::setUp();

        ResponseService::$oldResponseStructure = false;
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
                    'type' => 'userPermission',
                    'attributes' => [
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
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $this->faker->numberBetween()
                            ]
                        ]
                    ],
                ],
            ]
        );

        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals(
            [
                [
                    'source' => 'data.relationships.permission.data.id',
                    'detail' => 'The selected permission id is invalid.',
                    'title' => 'Validation failed.',
                ],
            ],
            $results->decodeResponseJson('errors')
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
                'data' => [
                    'type' => 'userPermission',
                    'attributes' => [
                        'start_date' => Carbon::now()
                            ->toDateTimeString(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission['id'],
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $user['id']
                            ]
                        ]
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertArraySubset(
            [
                'data' => [
                    'attributes' => [
                        'user' => $user['id'],
                        'start_date' => Carbon::now()
                            ->toDateTimeString(),
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
            ],
            $results->decodeResponseJson()
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_permissions',
            [
                'user_id' => 1,
                'permission_id' => $permission['id'],
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

        $userPermission = $this->fakeUserPermission(
            [
                'user_id' => $userId,
                'permission_id' => $permission['id'],
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );

        $results = $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'data' => [
                    'type' => 'userPermission',
                    'attributes' => [
                        'user_id' => $userId,
                        'start_date' => Carbon::now()
                            ->toDateTimeString(),
                        'expiration_date' => Carbon::now()
                            ->addMinutes(1)
                            ->toDateTimeString(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => $permission['id'],
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $userId
                            ]
                        ]
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
                    'user' => $userId,
                    'start_date' => Carbon::now()
                        ->toDateTimeString(),
                    'expiration_date' => Carbon::now()
                        ->addMinutes(1)
                        ->toDateTimeString(),
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
            $results->decodeResponseJson('data')
        );

        $this->assertDatabaseHas(
            config('railcontent.table_prefix'). 'user_permissions',
            [
                'user_id' => $userId,
                'permission_id' => $permission['id'],
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
                'data' => [
                    'type' => 'userPermission',
                    'attributes' => [
                        'start_date' => $this->faker->word,
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'type' => 'permission',
                                'id' => rand(),
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $this->faker->numberBetween()
                            ]
                        ]

                    ],
                ],
            ]
        );

        $this->assertEquals(422, $results->getStatusCode());
        $this->assertEquals(
            [
                [
                    'source' => 'data.relationships.permission.data.id',
                    'detail' => 'The selected permission id is invalid.',
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

        $user = $this->fakeUser();

        $userPermission  = $this->fakeUserPermission(
            [
                'user_id' => $user['id'],
                'permission_id' => $permission['id'],
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );

        $userPermissionId = $userPermission['id'];

        $results = $this->call('DELETE', '/railcontent/user-permission/' . $userPermissionId);
        $this->assertEquals(204, $results->getStatusCode());

        $this->assertDatabaseMissing(
            config('railcontent.table_prefix'). 'user_permissions',
            [
                'id' => $userPermissionId,
                'user_id' => $user['id'],
                'permission_id' => $permission['id'],
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
        $permission1 = $this->fakePermission();
        $permission2 = $this->fakePermission();
        $user = $this->fakeUser();

        $userPermission1 = $this->fakeUserPermission(
            [
                'user_id' => $user['id'],
                'permission_id' => $permission1['id'],
                'expiration_date' => Carbon::now()
                    ->addDays(10),
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );

        $userPermission2 = $this->fakeUserPermission(
            [
                'user_id' => $user['id'],
                'permission_id' => $permission2['id'],
                'expiration_date' => Carbon::now()
                    ->addDays(10),
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );

        //pull all the active user permissions
        $results = ($this->call('GET', '/railcontent/user-permission'));

        $this->assertEquals(200, $results->getStatusCode());
        $this->assertEquals(2, count($results->decodeResponseJson('data')));
    }

    public function test_index_specific_user_active_permissions()
    {
        $permission1 = $this->fakePermission();
        $permission2 = $this->fakePermission();
        $user = $this->fakeUser();

        $this->fakeUserPermission(
            [
                'user_id' => $user['id'],
                'permission_id' => $permission1['id'],
                'expiration_date' => Carbon::now()
                    ->addDays(10),
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]

        );

        $this->fakeUserPermission(
            [
                'user_id' => $user['id'],
                'permission_id' => $permission2['id'],
                'expiration_date' => null,
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]

        );


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
        $permission1 = $this->fakePermission();
        $permission2 = $this->fakePermission();
        $user = $this->fakeUser();

        $this->fakeUserPermission(
            [
                'user_id' => $this->app->make(UserProvider::class)->getRailcontentUserById($user['id']),
                'permission_id' => $permission1['id'],
                'expiration_date' => Carbon::now()
                    ->subMonth(10),
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );

        $this->fakeUserPermission(
            [
                'user_id' => $user['id'],
                'permission_id' => $permission2['id'],
                'expiration_date' => null,
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
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
            [
                'content_id' => $content1[0]->getId(),
                'permission_id' => $permission1['id'],
                'brand' => config('railcontent.brand')
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
                'data' => [
                    'type' => 'userPermission',
                    'attributes' => [
                        'start_date' => Carbon::now()
                            ->toDateTimeString(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'id' => $permission1['id'],
                                'type' => 'permission',
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $userId
                            ]
                        ]
                    ],
                ],
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
            [
                'content_id' => $content[0]->getId(),
                'permission_id' => $permission['id'],
                'brand' => config('railcontent.brand')
            ]
        );

        $userPermission = $this->fakeUserPermission(
            [
                'user_id' => $userId,
                'permission_id' => $permission['id'],
                'start_date' => Carbon::now(),
                'expiration_date' => null,
            ]
        );

        $response = $this->call(
            'GET',
            'railcontent/content'
        );

        $this->assertTrue(in_array($content[0]->getId(), array_pluck($response->decodeResponseJson('data'), 'id')));

        $this->call(
            'DELETE',
            'railcontent/user-permission/' . $userPermission['id']
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

        $permission1 = $this->fakePermission();
        $permission2 = $this->fakePermission();

        $contentPermission = $this->fakeContentPermission(
            [
                'content_id' => $content[0]->getId(),
                'permission_id' => $permission1['id'],
            ]
        );

        $this->call(
            'PUT',
            'railcontent/user-permission',
            [
                'data' => [
                    'attributes' => [
                        'start_date' => Carbon::now()
                            ->subDay(1)
                            ->toDateTimeString(),
                        'expiration_date' => Carbon::now()
                            ->addDays(3)
                            ->toDateTimeString(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'id' => $permission1['id'],
                                'type' => 'permission',
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' => $userId
                            ]
                        ]
                    ],
                ],
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
                'data' => [
                    'attributes' => [
                        'start_date' => Carbon::now()
                            ->addHour(1)
                            ->toDateTimeString(),
                        'expiration_date' => Carbon::now()
                            ->addDays(3)
                            ->toDateTimeString(),
                    ],
                    'relationships' => [
                        'permission' => [
                            'data' => [
                                'id' => $permission2['id'],
                                'type' => 'permission',
                            ],
                        ],
                        'user' => [
                            'data' => [
                                'type' => 'user',
                                'id' =>$userId
                            ]
                        ]
                    ],
                ],
            ]
        );
        $cacheKeys = Redis::keys('*pull*');
        $redisTTL = Redis::ttl($cacheKeys[0]);

        //expected 1 hour in seconds (the expiration date for user's permission 1)
        $recentExpirationSeconds = 1 * 60 * 60;

        $this->assertEquals($recentExpirationSeconds, $redisTTL);
    }

}
