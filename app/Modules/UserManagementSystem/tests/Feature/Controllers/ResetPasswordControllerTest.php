<?php

namespace Modules\UserManagementSystem\Tests\Feature\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;
use Modules\UserManagementSystem\Models\User;

class ResetPasswordControllerTest extends UserManagementSystemTestCase
{

    public function test_reset_password_validation_failed()
    {
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/password/reset-password-with-token'
        );

        $response->assertSessionHasErrors(['password']);
    }

    public function test_reset_password_invalid_token()
    {
        $hashKey = Str::random(40);
        $password = Str::random(12);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/password/reset-password-with-token',
            [
                'email' => 'test+1@test.com',
                'password' => $password,
                'password_confirmation' => $password,
                'token' => '123',
            ]
        );

        $this->assertFalse(auth()->attempt(['email' => 'test+1@test.com', 'password' => $password]));

        $response->assertSessionHasErrors(['password' => 'Password reset failed, please try again.',]);
    }

    public function test_reset_password()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $newPassword = Str::random(12);

        $user = User::query()->where(['email' => $email])->firstOrFail();

        $this->assertTrue(auth()->attempt(['email' => $user->email, 'password' => $password]));


        $response = $this->json(
            'POST',
            config('user_management_system.route_prefix') . '/login/token',
            ['email' => $email, 'password' => $password, 'device_name' => 'test_device']
        );

        // make sure no web based auth cookies are passed back
        $this->assertEquals(200, $response->getStatusCode());

        $responseJson = json_decode($response->getContent());

        $this->assertNotEmpty($responseJson->token);


        $response = $this->json(
            'POST',
            config('user_management_system.route_prefix') . '/password/send-reset-email',
            ['email' => $email]
        );

        // make sure no web based auth cookies are passed back
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/password/reset-password-with-token',
            [
                'email' => $user->email,
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
                'token' => $responseJson->token,

            ]
        );

        $this->assertFalse(auth()->attempt(['email' => $user->email, 'password' => $password]));
        $this->assertTrue(auth()->attempt(['email' => $user->email, 'password' => $newPassword]));
    }

    protected function setUp(): void
    {
        parent::setUp();
    }

}
