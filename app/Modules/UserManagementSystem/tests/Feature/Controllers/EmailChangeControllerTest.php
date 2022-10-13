<?php

namespace Modules\UserManagementSystem\Tests\Feature\Controllers;

use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Models\EmailChange;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Tests\UserManagementSystemTestCase;
use Modules\UserManagementSystem\Events\EmailChangeRequest;

class EmailChangeControllerTest extends UserManagementSystemTestCase
{

    public function test_request()
    {
        Event::fake();
        Notification::fake();

        $password = $this->faker->word;
        $user = User::factory()->create([
            'email' => $this->faker->email,
            'password' => Hash::make($password),
            'display_name' => $this->faker->word
        ]);

        $user->save();

        auth()->onceUsingId($user->id);
        $newEmail = $this->faker->email;
        $this->assertNotEquals($newEmail, $user->email);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/email-change/request',
            [
                'email' => $newEmail,
                'user_password' => $password,
            ]
        );

        $token = '';

        Event::assertDispatched(
            EmailChangeRequest::class,
            function ($e) use ($newEmail, &$token) {
                $token = $e->token;
                return $e->email === $newEmail;
            }
        );

        // assert response code
        $this->assertEquals(302, $response->getStatusCode());

        // assert session message
        $response->assertSessionHas(
            ['successes']
        );


        // assert the request data was saved in db
        $this->assertDatabaseHas(
            'usora_email_changes',
            [
                'user_id' => $user->id,
                'email' => $newEmail,
                'token' => $token,
            ]
        );

        Notification::assertSentTo(
            (new AnonymousNotifiable)->route(config('user_management_system.email_change_notification_channel'), $newEmail),
            config('user_management_system.email_change_notification_class'),
            function ($notification) use ($token) {
                return $notification->token === $token;
            }
        );
    }

    public function test_request_validation_fail()
    {
        $user = User::factory()->create([
            'email' => $this->faker->email,
            'password' => $this->faker->words(3, true),
        ]);

        auth()->login($user);

        $response = $this->call(
            'POST',
            config('user_management_system.route_prefix') . '/email-change/request',
            []
        );

        $response->assertSessionHasErrors(
            ['error-message']
        );

        $response = $this->json(
            'POST',
            config('user_management_system.route_prefix') . '/email-change/request',
            ['email' => 'test1@test.com']
        );

        $response->assertSessionHasErrors(
            ['error-message']
        );
    }


    public function test_confirmation()
    {
        $user = User::factory()->create([
            'email' => $this->faker->email,
            'password' => $this->faker->words(3, true),
        ]);
        auth()->login($user);

        $newEmail = 'test_change@test.com';
        $myToken = 'token1';

        $emailChange = new EmailChange();
        $emailChange->user_id = $user->id;
        $emailChange->email = $newEmail;
        $emailChange->token = $myToken;
        $emailChange->created_at = time();
        $emailChange->updated_at = time();

        $emailChange->save();

        $response = $this->call(
            'GET',
            config('user_management_system.route_prefix') . '/email-change/confirm',
            ['code' => $myToken]
        );

        // assert the new email was saved in users table
        $this->assertDatabaseHas(
           'usora_users',
            [
                'id' => 1,
                'email' => $newEmail,
            ]
        );

        // assert response code
        $this->assertEquals(302, $response->getStatusCode());

        // assert session message
        $response->assertSessionHas(
            ['successes']
        );
    }


    public function test_confirmation_validation_fail()
    {

        $user = User::factory()->create([
            'email' => $this->faker->email,
            'password' => $this->faker->words(3, true),
        ]);
        auth()->login($user);

        $response = $this->call(
            'GET',
            config('user_management_system.route_prefix') . '/email-change/confirm',
            []
        );

        // assert session has error for missing token
        $response->assertSessionHasErrors(
            ['code']
        );

        app('session.store')->flush();

        $response = $this->call(
            'GET',
            config('user_management_system.route_prefix') . '/email-change/confirm',
            ['code' => Str::random(40)]
        );

        // assert session has error for invalid token
        $response->assertSessionHasErrors(
            ['error-message']
        );

        app('session.store')->flush();

        $response = $this->call(
            'GET',
            config('user_management_system.route_prefix') . '/email-change/confirm',
            ['code' => 'token2']
        );

        // assert session has error for expired token
        $response->assertSessionHasErrors(
            ['error-message']
        );
    }

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

}
