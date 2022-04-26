<?php

namespace Modules\UserManagementSystem\Tests\Feature\Middleware;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Middleware\AuthenticatedOnly;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;

class AuthenticatedOnlyTest extends UserManagementSystemTestCase
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

    public function test_redirect_to_login_if_not_authed_web_request()
    {
        $response = $this->get('test-route');

        $response->assertRedirectContains(config('user_management_system.login_page_path'));
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_successful_auth_web_request()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        auth()->attempt(['email' => $email, 'password' => $password]);

        $response = $this->get('test-route');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_unauthenticated_response_if_not_authed_json_request()
    {
        $response = $this->getJson('test-route', ['HTTP_REFERER' => 'https://test.musora.com']);

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertEquals('{"message":"Unauthenticated."}', $response->getContent());
    }

    public function test_successful_auth_json_request()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->getJson(
            'test-route',
            ['HTTP_REFERER' => 'https://test.musora.com', 'AUTHORIZATION' => 'Bearer ' . $token]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('{"testing":true}', $response->getContent());
    }
}
