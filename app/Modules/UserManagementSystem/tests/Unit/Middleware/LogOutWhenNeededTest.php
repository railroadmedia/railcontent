<?php

namespace Modules\UserManagementSystem\Tests\Unit\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Middleware\LogOutWhenNeeded;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;
use Tests\TestCase;

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
     *
     * @param  bool  $needsLogout
     * @return User
     */
    private function createUser(bool $needsLogout): User
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        auth()->attempt(['email' => $email, 'password' => $password]);

        // auth()->attempt will emit the authenticated event, and will set needs_logout to false,
        // so set it to true afterwards, if needed
        if ($needsLogout) {
            $user->update(['needs_logout' => true]);
            $user->refresh();
        }
        return $user;
    }

    /**
     * Call the parent actingAs function, and update the user's needs_logout value when necessary,
     * to work around the automatic change of needs_logout to false caused by the Authenticated event.
     *
     * @param  User  $user
     * @param  bool  $needsLogout
     * @return TestCase
     */
    private function actingAsNeedsLogout(User $user, bool $needsLogout): TestCase
    {
        parent::actingAs($user);

        // actingAs authenticates the user, which in turn sets needs_logout to false, if it was true before,
        // so we need to set needs_logout again
        if ($needsLogout)
        {
            $user->update(['needs_logout' => true]);
            $user->refresh();
        }

        return $this;
    }

    public function test_successful_web_request_when_needs_logout_is_false()
    {
        $user = $this->createUser(false);
        $response = $this->actingAsNeedsLogout($user, false)->get($this->testRouteName);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_user_is_logged_out_from_web_request_when_needs_logout_is_true()
    {
        $user = $this->createUser(true);
        $this->assertTrue($user->needs_logout);

        $testCase = $this->actingAsNeedsLogout($user, true);
        $this->assertTrue($user->needs_logout);

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message) use ($user) {
                return str_contains($message, "Logging out user {$user->id}");
            });

        $response = $testCase->get($this->testRouteName);

        $response->assertRedirectContains(config('user_management_system.login_page_path'));
        $this->assertEquals(302, $response->getStatusCode());

        Auth::login($user);
        $user->refresh();
        $this->assertFalse($user->needs_logout);
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
}
