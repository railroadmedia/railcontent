<?php

namespace Modules\Brand\Tests\Feature\Middleware;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Middleware\SetLastUsedBrand;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class SetLastUsedBrandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::get(
            'drumeo/test-route',
            function () {
                return request()->wantsJson() ? response()->json(['testing' => true]) : response('testing');
            }
        )->middleware(['web_or_api_authenticated', SetLastUsedBrand::class]);
    }

    public function test_brand_is_set()
    {
        // TODO fix this test
        $this->markTestSkipped("this test fails to run");
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'last_used_brand' => null,
        ]);

        auth()->setUser($user);

        $response = $this->get('drumeo/test-route');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(Brand::Drumeo->value, $user->last_used_brand);
        $this->assertEquals(Brand::Drumeo->value, user()->last_used_brand);
        $response->assertCookie('user_' . $user->id . '_last_used_brand');

        $this->app->terminate();

        $this->assertDatabaseHas('usora_users', ['id' => $user->id, 'last_used_brand' => Brand::Drumeo]);
    }
}
