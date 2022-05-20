<?php

namespace Modules\UserManagementSystem\Tests\Feature\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Middleware\AuthenticatedOnly;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;
use Spatie\Permission\Models\Permission;

class UserControllerTest extends UserManagementSystemTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

//        Route::get(
//            'test-route',
//            function () {
//                return request()->wantsJson() ? response()->json(['testing' => true]) : response('testing');
//            }
//        )->middleware([AuthenticatedOnly::class]);
    }

    public function test_create()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);
        $device = 'test_device';

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'create-users']);
        $user->givePermissionTo($permission);

        auth()->login($user);

        $response = $this->json(
            'PUT',
            config('user_management_system.route_prefix') . '/user/store',
            []
        );

        $this->assertEquals(
            json_encode([
                'errors' =>
                    [
                        'email' =>
                            [
                                0 => 'validation.required',
                            ],
                        'password' =>
                            [
                                0 => 'validation.required',
                            ],
                        'display_name' =>
                            [
                                0 => 'validation.required',
                            ],
                    ],
            ]),
            $response->getContent()
        );

//        $this->assertEmpty(auth()->id());
    }



    public function test_user_delete_with_permission()
    {
        $userId = 1;
        $user = User::factory()->create([
            'id'=> $userId,
            'email' => $this->faker->email,
            'password' => Hash::make($this->faker->words(3, true)),
        ]);

        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'delete-users']);
        $user->givePermissionTo($permission);

        auth()->login($user);

        $response = $this->call(
            'DELETE',
            config('user_management_system.route_prefix') . '/user/delete/' . $userId
        );


        // assert the user was not removed from the db
        $this->assertDatabaseMissing(
            'usora_users',
            [
                'id' => $userId,
            ]
        );
    }



    public function test_user_delete_without_permission()
    {
        $userId = 1;

        $user = User::factory()->create([
            'email' => $this->faker->email,
            'password' => Hash::make($this->faker->words(3, true)),
        ]);

        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'create-users']);
        $user->givePermissionTo($permission);

        auth()->login($user);

        $response = $this->call(
            'DELETE',
            config('user_management_system.route_prefix') . '/user/delete/' . $userId
        );

        // assert the response code is not found
        $this->assertEquals(403, $response->getStatusCode());

        // assert the user was not removed from the db
        $this->assertDatabaseHas(
            'usora_users',
            [
                'id' => $userId,
            ]
        );
    }

    
    public function test_user_update_validation_fail()
    {
        $userId = 1;

        $user = User::factory()->create([
            'email' => $this->faker->email,
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
}
