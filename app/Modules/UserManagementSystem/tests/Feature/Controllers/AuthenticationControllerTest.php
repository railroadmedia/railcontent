<?php

namespace Modules\UserManagementSystem\Tests\Feature\Controllers;

use App\Mail\Agnostic;
use App\Modules\Brand\Services\BrandService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\UserEvent;
use Modules\UserManagementSystem\Middleware\AuthenticatedOnly;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;

class AuthenticationControllerTest extends UserManagementSystemTestCase
{
    public function test_check_email_account_exists()
    {
        $email = $this->faker->email();

        User::factory()->create([
            'email' => $email,
        ]);

        $response = $this->post(
            route('user_management_system.login.check-email'),
            ['email' => $email]
        );

        $response->assertJson(
            [
                'message' => 'success',
                'is_setup' => true,
                'links' => [
                    'login' => route('user_management_system.login')
                ]
            ]
        );
    }

    public function test_check_email_doesnt_exist()
    {
        $email = $this->faker->email();

        $response = $this->post(
            route('user_management_system.login.check-email'),
            ['email' => $email]
        );

        $response->assertInvalid(['email' => 'The selected email is invalid.']);
    }

    public function test_check_email_needs_setup()
    {
        $email = $this->faker->email();

        User::factory()->create([
            'email' => $email,
            'requires_password_update' => true
        ]);

        Mail::fake();

        $response = $this->post(
            route('user_management_system.login.check-email'),
            ['email' => $email]
        );

        Mail::assertSent(
            Agnostic::class,
            function (Agnostic $mail) use ($email) {
                return $mail->hasTo($email) && $mail->view === 'emails.account-setup';
            }
        );

        $response->assertJson(
            [
                'message' => 'User requires password update. Email sent to user.',
                'is_setup' => false,
                'links' => [
                    'resend-email' => route('user_management_system.login.send-account-setup-email')
                ]
            ]
        );
    }

    public function test_send_account_setup_email()
    {
        $email = $this->faker->email();

        User::factory()->create([
            'email' => $email,
        ]);

        $response = $this->post(
            route('user_management_system.login.send-account-setup-email'),
            ['email' => $email]
        );

        Mail::assertSent(
            Agnostic::class,
            function (Agnostic $mail) use ($email) {
                return $mail->hasTo($email) && $mail->view === 'emails.account-setup';
            }
        );

        $response->assertOk();
    }

    public function test_login()
    {
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        Event::fake();
        $this->assertFalse(Auth::check());

        $response = $this->post(
            route('user_management_system.login'),
            ['email' => $email, 'password' => $password]
        );

        $this->assertTrue(Auth::check());
        Event::assertDispatched(UserEvent::class);
        $response->assertOk();
        $response->assertJson([
            "message" => "success",
            "redirect_to" => '/' . BrandService::getLastUsedBrand($user)
        ]);
    }

    public function test_login_fails_for_invalid_password()
    {
        $this->assertFalse(Auth::check());
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);

        User::factory()->create([
            'email' => $email,
            'password' => 'some-other-string-123',
        ]);

        Event::fake();

        $response = $this->post(
            route('user_management_system.login'),
            ['email' => $email, 'password' => $password]
        );

        $response->assertUnauthorized();
        $response->assertJson(['message' => 'Invalid credentials']);
        $this->assertFalse(Auth::check());
    }

    // TODO: fix all of these tests. They all throw ErrorException: Redis::connect(): php_network_getaddresses: getaddrinfo for redis failed: Name or service not known...
    protected function setUp(): void
    {
        parent::setUp();

        Route::get(
            $this->testRouteName,
            function () {
                return request()->wantsJson() ? response()->json(['testing' => true]) : response('testing');
            }
        )->middleware([AuthenticatedOnly::class]);
    }

    public function test_authenticate_token_validation_fails()
    {
        $response = $this->json(
            'POST',
            config('user_management_system.route_prefix') . '/login/token',
            []
        );

        $this->assertEquals(
            json_encode([
                'errors' =>
                    [
                        'email' =>
                            [
                                0 => 'The email field is required.',
                            ],
                        'password' =>
                            [
                                0 => 'The password field is required.',
                            ],
                        'device_name' =>
                            [
                                0 => 'The device name field is required.',
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

        $this->assertEquals('{"success":false,"message":"Invalid Email or Password"}', $response->getContent());

        $this->assertEmpty(auth()->id());
    }

    public function test_authenticate_token_success()
    {
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);
        $device = 'test_device';

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        Event::fake([MobileAppLogin::class, UserEvent::class]);

        $response = $this->json(
            'POST',
            config('user_management_system.route_prefix') . '/login/token',
            ['email' => $email, 'password' => $password, 'device_name' => $device]
        );

        // make sure no web based auth cookies are passed back
        $this->assertEquals(200, $response->getStatusCode());

        $responseJson = json_decode($response->getContent());

        $this->assertNotEmpty($responseJson->token);
        $this->assertArraySubset($user->toArray(), (array)$responseJson->user);

        $this->assertArraySubset($user->toArray(), auth()->user()->toArray());
        $this->assertArraySubset($user->toArray(), user()->toArray());

        Event::assertDispatched(MobileAppLogin::class);
        Event::assertDispatched(UserEvent::class);
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
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        Event::fake([UserEvent::class]);

        $response = $this->post(
            config('user_management_system.route_prefix') . '/login/cookie',
            ['email' => $email, 'password' => $password]
        );

        $this->assertEquals(302, $response->getStatusCode());

        $response->assertRedirect('/' . $user->last_used_brand);

        $this->assertArraySubset($user->toArray(), auth()->user()->toArray());
        $this->assertArraySubset($user->toArray(), user()->toArray());

        Event::assertDispatched(UserEvent::class);
    }

    public function test_authenticate_cookie_success_follows_redirect_parameter()
    {
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);
        $redirectUrl = $this->faker->url();

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        Event::fake([UserEvent::class]);

        $response = $this->post(
            config('user_management_system.route_prefix') . '/login/cookie',
            ['email' => $email, 'password' => $password, 'redirect_to' => $redirectUrl]
        );

        $this->assertEquals(302, $response->getStatusCode());

        $response->assertRedirect($redirectUrl);

        $this->assertEquals($user->toArray(), auth()->user()->toArray());
        $this->assertEquals($user->toArray(), user()->toArray());

        Event::assertDispatched(UserEvent::class);
    }

        public function test_authenticate_via_remember_token()
    {
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        // Fake the event
        Event::fake([UserEvent::class]);

        $response = $this->post(
            config('user_management_system.route_prefix') . '/login/cookie',
            ['email' => $email, 'password' => $password]
        );

        $this->assertEquals($user->toArray(), auth()->user()->toArray());
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/' . $user->last_used_brand);

        // Assert that the UserEvent was dispatched
        Event::assertDispatched(UserEvent::class);

        session()->flush();
        auth()->guard()->logout();

        $cookies = $response->headers->getCookies();

        $response = $this->withCookies($cookies)->get($this->testRouteName);
        $response->assertRedirect(
            config('user_management_system.login_page_path') . '?redirect_to=/' . $this->testRouteName
        );

        $this->assertNull(auth()->user());
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_authenticate_generated_key_success()
    {
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $hashKey = md5($user->id . $user->password . Carbon::now()->startOfMinute()->toDateTimeString());

        Event::fake([UserEvent::class]);

        $response = $this->call(
            'get',
            config('user_management_system.route_prefix') . '/login/generated-key',
            ['auth_key' => $hashKey, 'user_id' => $user->id]
        );

        $this->assertEquals(302, $response->getStatusCode());

        $this->assertEquals($user->toArray(), auth()->user()->toArray());
        $this->assertEquals($user->toArray(), user()->toArray());

        Event::assertDispatched(UserEvent::class);
    }

    public function test_authenticate_generated_key_success_1_minute_later()
    {
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $hashKey = md5($user->id . $user->password . Carbon::now()->startOfMinute()->subMinutes(1)->toDateTimeString());

        Event::fake([UserEvent::class]);

        $response = $this->call(
            'get',
            config('user_management_system.route_prefix') . '/login/generated-key',
            ['auth_key' => $hashKey, 'user_id' => $user->id]
        );

        $this->assertEquals(302, $response->getStatusCode());

        $this->assertArraySubset($user->toArray(), auth()->user()->toArray());
        $this->assertArraySubset($user->toArray(), user()->toArray());

        Event::assertDispatched(UserEvent::class);
    }

    public function test_check_for_auth_then_redirect_back_with_auth_key_success()
    {
        $redirectUrl = 'https://www.domain.com/order';
        $email = $this->faker->email();
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $hashKey = md5($user->id . $user->password . Carbon::now()->startOfMinute()->toDateTimeString());

        auth()->login($user);

        $response = $this->call(
            'GET',
            config('user_management_system.route_prefix') . '/check-for-auth-then-redirect-back-with-auth-key',
            ['redirect_to' => $redirectUrl]
        );

        $response->assertRedirect($redirectUrl . '?user_id=' . $user->id . '&auth_key=' . $hashKey);

        $this->assertEquals(302, $response->getStatusCode());

        $this->assertEquals($user->toArray(), auth()->user()->toArray());
        $this->assertEquals($user->toArray(), user()->toArray());
    }

    public function test_check_for_auth_then_redirect_back_with_auth_key_fail()
    {
        $redirectUrl = 'https://www.domain.com/order';

        $response = $this->call(
            'GET',
            config('user_management_system.route_prefix') . '/check-for-auth-then-redirect-back-with-auth-key',
            ['redirect_to' => $redirectUrl]
        );

        $response->assertRedirect($redirectUrl);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_logout_token()
    {
        $email = $this->faker->email();
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

        $this->assertArraySubset($user->toArray(), auth()->user()->toArray());

        $this->assertDatabaseHas('personal_access_tokens', ['tokenable_id' => $user->id]);

        $response = $this->get(
            config('user_management_system.route_prefix') . '/logout/token',
            ['Authorization' => 'Bearer ' . json_decode($response->getContent())->token]
        );

        $this->assertDatabaseMissing('personal_access_tokens', ['id' => 1, 'tokenable_id' => $user->id]);
    }

    public function test_logout_cookie()
    {
        $email = $this->faker->email();
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
        $email = $this->faker->email();
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
