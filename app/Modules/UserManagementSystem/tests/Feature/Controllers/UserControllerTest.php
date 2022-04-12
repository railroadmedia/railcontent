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

        $permission = Permission::create(['guard' => 'user-management-system', 'name' => 'users.create']);
        $user->givePermissionTo($permission);

        auth()->login($user);

        $response = $this->json(
            'PUT',
            config('user_management_system.route_prefix') . '/user/store',
            []
        );

        dd($response);

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
            config('user_management_system.route_prefix') . '/login/token',
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

        $this->expectsEvents([MobileAppLogin::class]);
        $this->expectsEvents([UserEvent::class]);

        $response = $this->json(
            'POST',
            config('user_management_system.route_prefix') . '/login/token',
            ['email' => $email, 'password' => $password, 'device_name' => $device]
        );

        // make sure no web based auth cookies are passed back
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
            config('user_management_system.route_prefix') . '/login/cookie',
            ['email' => 'fail', 'password' => '123']
        );

        $response->assertSessionHasErrors(['invalid-credentials']);

        $this->assertEmpty(auth()->id());
    }

    public function test_authenticate_cookie_validation_fails()
    {
        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/login/cookie'
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

        $this->expectsEvents([UserEvent::class]);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/login/cookie',
            ['email' => $email, 'password' => $password]
        );

        $this->assertEquals(302, $response->getStatusCode());

        // todo: fix
//        $response->assertRedirect(config('user_management_system.login_page_path'));

        $this->assertEquals($user->toArray(), auth()->user()->toArray());
        $this->assertEquals($user->toArray(), user()->toArray());
    }

    public function test_authenticate_cookie_success_follows_redirect_parameter()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);
        $redirectUrl = $this->faker->url;

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->expectsEvents([UserEvent::class]);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/login/cookie',
            ['email' => $email, 'password' => $password, 'redirect' => $redirectUrl]
        );

        $this->assertEquals(302, $response->getStatusCode());

        $response->assertRedirect($redirectUrl);

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

        $this->expectsEvents([UserEvent::class]);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/login/cookie',
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

    public function test_logout_token()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/login/token',
            ['email' => $email, 'password' => $password, 'device_name' => 'test']
        );

        $this->assertEquals($user->toArray(), auth()->user()->toArray());

        $this->assertDatabaseHas('personal_access_tokens', ['id' => 1, 'tokenable_id' => $user->id]);

        $response = $this->get(
            config('user_management_system.route_prefix') . '/logout/token',
            ['Authorization' => 'Bearer ' . json_decode($response->getContent())->token]
        );

        $this->assertEmpty(auth()->user());

        $this->assertDatabaseMissing('personal_access_tokens', ['id' => 1, 'tokenable_id' => $user->id]);
    }

    public function test_logout_cookie()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/login/cookie',
            ['email' => $email, 'password' => $password]
        );

        $this->assertEquals($user->toArray(), auth()->user()->toArray());

        $response = $this->call(
            'GET',
            config('user_management_system.route_prefix') . '/logout/cookie',
        );

        $this->assertEmpty(auth()->user());
    }

    public function test_logout_cookie_with_remember()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/login/cookie',
            ['email' => $email, 'password' => $password]
        );

        $cookies = [];

        foreach (cookie()->getQueuedCookies() as $cookie) {
            $cookies[$cookie->getName()] = $cookie->getValue();
        }

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/login/cookie',
            ['email' => $email, 'password' => $password],
            $cookies
        );

        $this->assertEquals($user->toArray(), auth()->user()->toArray());

        $response = $this->call(
            'GET',
            config('user_management_system.route_prefix') . '/logout/cookie',
        );

        $this->assertEmpty(auth()->user());
    }
}
