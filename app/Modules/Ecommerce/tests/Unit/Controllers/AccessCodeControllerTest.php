<?php

namespace Modules\Ecommerce\tests\Unit\Controllers;

use App\Modules\Ecommerce\database\factories\AccessCodeFactory;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class AccessCodeControllerTest extends TestCase
{
    public function test_access_code_claim_with_valid_email(): void
    {
        Event::fake();
        Bus::fake();

        $product = Product::factory()->create();
        $accessCode = AccessCodeFactory::createAccessCode($product);

        $body = [
            'email' => 'validemail@test.com',
            'access_code' => $accessCode->code,
            'password' => 'Password@123',
            'brand' => $accessCode->brand,
            'credentials_type' => 'new',
        ];

        $response = $this->postJson(
            route('access-codes.form-claim'),
            $body,
        );

        $response->assertStatus(200);
    }

    public function test_access_code_claim_with_invalid_email(): void
    {
        Event::fake();
        Bus::fake();

        $product = Product::factory()->create();
        $accessCode = AccessCodeFactory::createAccessCode($product);

        $body = [
            'email' => 'invalid email@test.com',
            'access_code' => $accessCode->code,
            'password' => 'Password@123',
            'brand' => $accessCode->brand,
            'credentials_type' => 'new',
        ];

        $response = $this->postJson(
            route('access-codes.form-claim'),
            $body,
        );

        $response->assertStatus(422);
        $jsonResponse = $response->json();
        $this->assertEquals('The email field must be a valid email address.', $jsonResponse['errors']['email'][0]);
    }

    public function test_access_code_claim_with_existing_user_and_valid_email(): void
    {
        Event::fake();
        Bus::fake();

        $product = Product::factory()->create();
        $accessCode = AccessCodeFactory::createAccessCode($product);
        $email = 'validemail@test.com';
        $password = $this->faker->words(3, true);

        /** @var User $user */
        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'last_used_brand' => null,
        ]);

        auth()->setUser($user);

        $body = [
            'user_email' => $email,
            'access_code' => $accessCode->code,
            'user_password' => $password,
            'brand' => $accessCode->brand,
            'credentials_type' => 'existing',
        ];

        // Mock the UserAccessPermissionsService's addUserAccessPermissionsForProducts, so that it doesn't actually
        // try to connect to Recharge to get the user's permissions
        $mock = Mockery::mock(UserAccessPermissionsService::class);
        $mock->shouldReceive('addUserAccessPermissionsForProducts')->once();
        $this->app->instance(UserAccessPermissionsService::class, $mock);

        $response = $this->postJson(
            route('access-codes.form-claim'),
            $body,
        );

        $response->assertStatus(200);
    }

    public function test_access_code_claim_with_existing_user_and_invalid_email(): void
    {
        Event::fake();
        Bus::fake();

        $product = Product::factory()->create();
        $accessCode = AccessCodeFactory::createAccessCode($product);
        $email = 'invalid email@test.com';
        $password = $this->faker->words(3, true);

        /** @var User $user */
        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'last_used_brand' => null,
        ]);

        auth()->setUser($user);

        $body = [
            'user_email' => $email,
            'access_code' => $accessCode->code,
            'user_password' => $password,
            'brand' => $accessCode->brand,
            'credentials_type' => 'existing',
        ];

        $response = $this->postJson(
            route('access-codes.form-claim'),
            $body,
        );

        $response->assertStatus(200);
    }
}
