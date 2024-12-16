<?php

namespace Modules\UserManagementSystem\Tests\Feature\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;
use Spatie\Permission\Models\Permission;

class UserControllerTest extends UserManagementSystemTestCase
{
    // protected function setUp(): void
    // {
    //     parent::setUp();
    //
    //     Route::get(
    //        $this->testRouteName,
    //        function () {
    //            return request()->wantsJson() ? response()->json(['testing' => true]) : response('testing');
    //        }
    //     )->middleware([AuthenticatedOnly::class]);
    // }

    //    public function test_create()
    //    {
    //        $email = $this->faker->email();
    //        $password = $this->faker->words(3, true);
    //        $device = 'test_device';
    //
    //        $user = User::factory()->create([
    //            'email' => $email,
    //            'password' => Hash::make($password),
    //        ]);
    //
    //        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'create-users']);
    //        $user->givePermissionTo($permission);
    //
    //        auth()->login($user);
    //
    //        $response = $this->json(
    //            'PUT',
    //            config('user_management_system.route_prefix') . '/user/store',
    //            []
    //        );
    //
    //        $this->assertEquals(
    //            json_encode([
    //                'errors' =>
    //                    [
    //                        'email' =>
    //                            [
    //                                0 => 'The email field is required.',
    //                            ],
    //                        'password' =>
    //                            [
    //                                0 => 'The password field is required.',
    //                            ],
    //                        'display_name' =>
    //                            [
    //                                0 => 'The display name field is required.',
    //                            ],
    //                    ],
    //            ]),
    //            $response->getContent()
    //        );
    //
    ////        $this->assertEmpty(auth()->id());
    //    }

    public function test_user_delete_with_permission()
    {
        $userId = 1;
        $user = User::factory()->create([
            'id' => $userId,
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->words(3, true)),
            'shopify_id' => null,
        ]);

        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'delete-users']);
        $user->givePermissionTo($permission);

        auth()->login($user);

        $response = $this->call(
            'DELETE',
            config('user_management_system.route_prefix') . '/user/delete/' . $userId
        );

        $this->assertEquals(302, $response->getStatusCode());

        // assert the user was not fully deleted, but our special soft-delete logic was applied
        $this->assertDatabaseHas(
            'usora_users',
            [
                'id' => $userId,
            ]
        );
        $this->assertStringContainsString('deleted', $user->refresh()->email);
    }

    public function test_user_delete_self()
    {
        $user = User::factory()->create([
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->words(3, true)),
            'shopify_id' => null,
        ]);

        auth()->login($user);

        $response = $this->call(
            'DELETE',
            config('user_management_system.route_prefix') . '/user/delete/' . $user->id
        );

        $this->assertEquals(302, $response->getStatusCode());

        // assert the user was not fully deleted, but our special soft-delete logic was applied
        $this->assertDatabaseHas(
            'usora_users',
            [
                'id' => $user->id,
            ]
        );
        $this->assertStringContainsString('deleted', $user->refresh()->email);
    }

    public function test_user_delete_without_permission()
    {
        $user1 = User::factory()->create([
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->words(3, true)),
            'shopify_id' => null,
        ]);

        $user2 = User::factory()->create([
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->words(3, true)),
            'shopify_id' => null,
        ]);

        auth()->login($user2);

        $response = $this->call(
            'DELETE',
            config('user_management_system.route_prefix') . '/user/delete/' . $user1->id
        );

        // assert the response code is not found
        $this->assertEquals(403, $response->getStatusCode());

        // assert the user was not fully deleted and that our special soft-delete logic was NOT applied
        $this->assertDatabaseHas(
            'usora_users',
            [
                'id' => $user1->id,
            ]
        );
        $this->assertStringNotContainsString('deleted', $user1->refresh()->email);
    }

    public function test_user_update_validation_fail()
    {
        $userId = 1;

        $user = User::factory()->create([
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->words(3, true)),
        ]);

        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'test']);
        $user->givePermissionTo($permission);

        auth()->login($user);

        $response = $this->call(
            'PATCH',
            config('user_management_system.route_prefix') . '/user/update/' . rand(),
            ['display_name' => 123]
        );

        $this->assertEquals(403, $response->getStatusCode());
    }

    public function test_users_store_with_permission()
    {
        $user = User::factory()->create([
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->words(3, true)),
        ]);

        auth()->login($user);
        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'create-users']);
        $user->givePermissionTo($permission);

        $userData = [
            'display_name' => $this->faker->words(4, true),
            'email' => $this->faker->email(),
            'password' => '12345678',
        ];

        // fake the UserCreated event so that it doesn't attempt to sync the user with external services
        Event::fake([UserCreated::class]);

        $response = $this->call(
            'PUT',
            config('user_management_system.route_prefix') . '/user/store/',
            $userData
        );

        $this->assertDatabaseHas(
            'usora_users',
            [
                'display_name' => $userData['display_name'],
                'email' => $userData['email'],
            ]
        );

        // assert the users password was encrypted and saved, and that they can login
        $this->assertTrue(auth()->attempt(['email' => $userData['email'], 'password' => $userData['password']]));

        // assert the session has the success message
        $response->assertSessionHas('success', true);
    }

    public function test_users_store_without_login()
    {
        $userData = [
            'display_name' => $this->faker->words(4, true),
            'email' => $this->faker->email(),
            'password' => '12345678',
        ];


        $response = $this->call(
            'PUT',
            config('user_management_system.route_prefix') . '/user/store/',
            $userData
        );

        $this->assertDatabaseMissing(
            'usora_users',
            [
                'display_name' => $userData['display_name'],
                'email' => $userData['email'],
            ]
        );

        // assert the users password was encrypted and saved, and that they can login
        $this->assertFalse(auth()->attempt(['email' => $userData['email'], 'password' => $userData['password']]));
    }

    public function test_users_store_without_permission()
    {
        $user = User::factory()->create([
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->words(3, true)),
        ]);

        auth()->login($user);
        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'invalid-permission']);
        $user->givePermissionTo($permission);

        $userData = [
            'display_name' => $this->faker->words(4, true),
            'email' => $this->faker->email(),
            'password' => '12345678',
        ];


        $response = $this->call(
            'PUT',
            config('user_management_system.route_prefix') . '/user/store/',
            $userData
        );

        $this->assertDatabaseMissing(
            'usora_users',
            [
                'display_name' => $userData['display_name'],
                'email' => $userData['email'],
            ]
        );

        // assert the users password was encrypted and saved, and that they can login
        $this->assertFalse(auth()->attempt(['email' => $userData['email'], 'password' => $userData['password']]));
    }

    public function test_users_store_validation_fail()
    {
        $response = $this->call(
            'PUT',
            config('user_management_system.route_prefix') . '/user/store/',
            []
        );

        $response->assertSessionMissing('success', true);
    }

}
