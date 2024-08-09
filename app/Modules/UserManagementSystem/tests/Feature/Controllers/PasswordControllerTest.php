<?php

namespace Modules\UserManagementSystem\Tests\Feature\Controllers;

use Illuminate\Support\Facades\Hash;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;
use Spatie\Permission\Models\Permission;

class PasswordControllerTest extends UserManagementSystemTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_update_password()
    {
        // TODO fix this test. Throws ErrorException: Redis::connect(): php_network_getaddresses: getaddrinfo for redis failed: Name or service not known...
        $this->markTestSkipped("this test fails to run");
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);
        $newPassword = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'edit-users']);
        $user->givePermissionTo($permission);

        auth()->login($user);

        $response = $this->json(
            'PATCH',
            config('user_management_system.route_prefix') . '/password/update',
            [
                'current_password' => $password,
                'new_password' => $newPassword,
                'new_password_confirmation' => $newPassword,
            ]
        );

        $this->assertFalse(auth()->attempt(['email' => $email, 'password' => $password]));
        $this->assertTrue(auth()->attempt(['email' => $email, 'password' => $newPassword]));
    }

}
