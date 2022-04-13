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
        $this->markTestIncomplete();

        $email = $this->faker->email;
        $password = $this->faker->words(3, true);
        $device = 'test_device';

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'users.create']);
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
                        'device_name' =>
                            [
                                0 => 'validation.required',
                            ],
                    ],
            ]),
            $response->getContent()
        );

        $this->assertEmpty(auth()->id());
    }
}
