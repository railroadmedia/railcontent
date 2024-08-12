<?php

namespace Modules\UserManagementSystem\Tests\Unit\Middleware;

use App\Http\Middleware\DynamicWebOrAppMiddlewareGroupsPublic;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Middleware\LogOutWhenNeeded;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;

class LogOutWhenNeededTest extends UserManagementSystemTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::get(
            $this->testRouteName,
            function () {
                return request()->wantsJson() ? response()->json(['testing' => true]) : response('testing');
            }
        )->middleware([LogOutWhenNeeded::class]);
    }

    /**
     * Create a new user, setting their needs_logout attribute as required.
     */
    private function createUser(bool $needsLogout): User
    {
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'needs_logout' => $needsLogout
        ]);
        auth()->attempt(['email' => $email, 'password' => $password]);

        return $user;
    }

    public function test_successful_web_request_when_needs_logout_is_false()
    {
        $user = $this->createUser(false);
        $response = $this->actingAs($user)->get($this->testRouteName);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_user_is_logged_out_from_web_request_when_needs_logout_is_true()
    {
        $user = $this->createUser(true);
        $this->assertTrue($user->needs_logout);

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message) use ($user) {
                return str_contains($message, "Logging out user {$user->id}");
            });

        $response = $this->actingAs($user)->get($this->testRouteName);

        $response->assertRedirectContains(config('user_management_system.login_page_path'));
    }

    public function test_successful_json_request_when_needs_logout_is_false()
    {
        $user = $this->createUser(false);
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->getJson(
            $this->testRouteName,
            ['HTTP_REFERER' => $this->testRoutePath, 'AUTHORIZATION' => 'Bearer ' . $token]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('{"testing":true}', $response->getContent());
    }

    public function test_user_is_logged_out_from_json_request_when_needs_logout_is_true()
    {
        $user = $this->createUser(true);
        $token = $user->createToken('test-token')->plainTextToken;

        $this->assertTrue($user->needs_logout);

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message) use ($user) {
                return str_contains($message, "Logging out user {$user->id}");
            });

        $response = $this->getJson(
            $this->testRouteName,
            ['HTTP_REFERER' => $this->testRoutePath, 'AUTHORIZATION' => 'Bearer ' . $token]
        );

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertStringContainsString('"message":"Unauthenticated."', $response->getContent());
    }

    /**
     * @throws \JsonException
     */
    public function test_needs_login_is_removed_after_login()
    {
        $user = $this->createUser(true);
        // manually set the password here, so we know what it is
        $password = $this->faker->words(3, true);
        $user->password = Hash::make($password);
        $user->save();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message) use ($user) {
                return str_contains($message, "User {$user->id} has authenticated for the first time after needing to log out. Logging user out of other devices.");
            });

        // DEV NOTE: do this test without the specified middleware so that we can get around its usage of Redis
        $response = $this->withoutMiddleware(DynamicWebOrAppMiddlewareGroupsPublic::class)
            ->post(route('user_management_system.login.cookie'), [
                'email' => $user->email,
                'password' => $password
            ]);

        $response->assertSessionHasNoErrors();
        $user->refresh();
        $this->assertFalse($user->needs_logout);
    }
}
