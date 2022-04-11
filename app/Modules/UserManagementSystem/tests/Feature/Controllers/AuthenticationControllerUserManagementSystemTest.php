<?php

namespace Modules\UserManagementSystem\Tests\Feature\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\DataTransferObjects\AuthenticationType;
use Modules\UserManagementSystem\Middleware\AuthenticatedOnly;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;

class AuthenticationControllerUserManagementSystemTest extends UserManagementSystemTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::get(
            'test-route',
            function () {
                return request()->wantsJson() ? response()->json(['testing' => true]) : response('testing');
            }
        )->middleware([AuthenticatedOnly::class]);
    }

    public function test_authenticate_token_validation_fails()
    {
        $response = $this->json(
            'POST',
            'usora/login/'.AuthenticationType::Token->value,
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

    public function test_authenticate_token_invalid_credentials()
    {
        $response = $this->json(
            'POST',
            'usora/login/'.AuthenticationType::Token->value,
            ['email' => 'fail', 'password' => '123', 'device_name' => 'test_device']
        );

        $this->assertEquals('{"message":"Unauthenticated."}', $response->getContent());

        $this->assertEmpty(auth()->id());
    }

    public function test_authenticate_token_success()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);
        $device = 'test_device';

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->json(
            'POST',
            'usora/login/'.AuthenticationType::Token->value,
            ['email' => $email, 'password' => $password, 'device_name' => $device]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $responseJson = json_decode($response->getContent());

        $this->assertNotEmpty($responseJson->token);
        $this->assertEquals($user->toArray(), (array)$responseJson->user);

        $this->assertEquals($user->toArray(), auth()->user()->toArray());
        $this->assertEquals($user->toArray(), user()->toArray());
    }

    public function test_authenticate_cookie_invalid_credentials()
    {
        $response = $this->call(
            'POST',
            'usora/login/'.AuthenticationType::Cookie->value,
            ['email' => 'fail', 'password' => '123']
        );

        $response->assertSessionHasErrors(['invalid-credentials']);

        $this->assertEmpty(auth()->id());
    }

    public function test_authenticate_cookie_validation_fails()
    {
        $response = $this->call(
            'POST',
            'usora/login/'.AuthenticationType::Cookie->value
        );

        $this->assertEmpty(auth()->id());

        $response->assertSessionHasErrors(['email', 'password']);

        $response->assertRedirect(config('user_management_system.login_page_path'));
    }

    public function test_authenticate_cookie_success()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->call(
            'POST',
            'usora/login/'.AuthenticationType::Cookie->value,
            ['email' => $email, 'password' => $password]
        );

        $this->assertEquals(302, $response->getStatusCode());

        // todo: fix
//        $response->assertRedirect(config('user_management_system.login_page_path'));

        $this->assertEquals($user->toArray(), auth()->user()->toArray());
        $this->assertEquals($user->toArray(), user()->toArray());
    }

    public function test_authenticate_via_remember_token()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->call(
            'POST',
            'usora/login/'.AuthenticationType::Cookie->value,
            ['email' => $email, 'password' => $password]
        );

        $this->assertEquals($user->toArray(), auth()->user()->toArray());

        session()->flush();
        auth()
            ->guard()
            ->nullCurrentUser();

        $cookies = [];

        foreach (cookie()->getQueuedCookies() as $cookie) {
            $cookies[$cookie->getName()] = $cookie->getValue();
        }

        $response = $this->call(
            'GET',
            'test-route',
            [],
            $cookies
        );

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_logout()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->call(
            'POST',
            'usora/login/'.AuthenticationType::Cookie->value,
            ['email' => $email, 'password' => $password]
        );

        $this->assertEquals($user->toArray(), auth()->user()->toArray());

        $response = $this->call(
            'GET',
            'usora/logout',
        );

        $this->assertEmpty(auth()->user());
    }

    public function test_deauthenticate_with_remember()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->call(
            'POST',
            'usora/login/'.AuthenticationType::Cookie->value,
            ['email' => $email, 'password' => $password]
        );

        $cookies = [];

        foreach (cookie()->getQueuedCookies() as $cookie) {
            $cookies[$cookie->getName()] = $cookie->getValue();
        }

        $response = $this->call(
            'POST',
            'usora/login/'.AuthenticationType::Cookie->value,
            ['email' => $email, 'password' => $password],
            $cookies
        );

        $this->assertEquals($user->toArray(), auth()->user()->toArray());

        $response = $this->call(
            'GET',
            'usora/logout',
        );

        $this->assertEmpty(auth()->user());
    }
}
