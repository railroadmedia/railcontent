<?php

namespace Modules\UserManagementSystem\Tests\Feature\Controllers;

use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Models\PasswordReset;
use Modules\UserManagementSystem\Notifications\ResetPassword;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;
use Modules\UserManagementSystem\Models\User;

class ResetPasswordControllerTest extends UserManagementSystemTestCase
{
    // TODO: fix all of these tests. They all throw ErrorException: Redis::connect(): php_network_getaddresses: getaddrinfo for redis failed: Name or service not known...
    public function test_reset_password_validation_failed()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/password/reset-password-with-token'
        );

        $response->assertSessionHasErrors(['password']);
    }

    public function test_reset_password_invalid_token()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
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

        $response->assertSessionHasErrors(['password' => 'Password reset failed, please try again. Error: passwords.user',]);
    }

    public function test_reset_password_email_notification_and_reset_with_token()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
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
            config('user_management_system.route_prefix') . '/password/send-reset-email',
            ['email' => $email]
        );

        $hashedToken = null;

        Notification::assertSentOnDemand(ResetPassword::class, function (ResetPassword $notification) use (&$hashedToken) {
            $hashedToken = $notification->token;

            return !empty($notification->token);
        });

        // make sure no web based auth cookies are passed back
        $this->assertEquals(200, $response->getStatusCode());

        $resetToken = $hashedToken;

        $this->assertNotEmpty($resetToken);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/password/reset-password-with-token',
            [
                'email' => $user->email,
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
                'token' => $resetToken,
            ]
        );

        $this->assertFalse(auth()->attempt(['email' => $user->email, 'password' => $password]));
        $this->assertTrue(auth()->attempt(['email' => $user->email, 'password' => $newPassword]));
    }
}
