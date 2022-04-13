<?php

namespace Modules\Brand\Tests\Feature\Services;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Services\BrandService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Modules\Brand\Tests\BrandTestCase;
use Modules\UserManagementSystem\Models\User;

class BrandServiceTest extends BrandTestCase
{
    /**
     * @var $brandService BrandService
     */
    protected $brandService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->brandService = app(BrandService::class);
    }

    public function test_set_last_used_brand_empty()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'last_used_brand' => null,
        ]);

        auth()->setUser($user);

        Cache::shouldReceive('get')
            ->once()
            ->with('user_' . $user->id . '_last_used_brand')
            ->andReturnNull();

        Cache::shouldReceive('add')
            ->once()
            ->with('user_' . $user->id . '_last_used_brand', Brand::Drumeo->value)
            ->andReturnNull();

        $this->brandService->setLastUsedBrand($user, Brand::Drumeo);

        $this->assertEquals(Brand::Drumeo->value, $user->last_used_brand);
        $this->assertEquals(Brand::Drumeo->value, user()->last_used_brand);
        $this->assertEquals(
            Brand::Drumeo->value,
            cookie()->queued('user_' . $user->id . '_last_used_brand')->getValue()
        );

        $this->app->terminate();

        $this->assertDatabaseHas('usora_users', ['id' => $user->id, 'last_used_brand' => Brand::Drumeo]);
    }

    public function test_set_last_used_brand_unchanged()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'last_used_brand' => Brand::Drumeo->value,
        ]);

        auth()->setUser($user);

        Cache::shouldReceive('get')
            ->once()
            ->with('user_' . $user->id . '_last_used_brand')
            ->andReturn(Brand::Drumeo->value);

        Cache::shouldReceive('add')
            ->never();

        $this->brandService->setLastUsedBrand($user, Brand::Drumeo);

        $this->assertEquals(Brand::Drumeo->value, $user->last_used_brand);
        $this->assertEquals(Brand::Drumeo->value, user()->last_used_brand);

        $this->assertDatabaseHas('usora_users', ['id' => $user->id, 'last_used_brand' => Brand::Drumeo]);
    }

    public function test_set_last_used_brand_change()
    {
        $email = $this->faker->email;
        $password = $this->faker->words(3, true);

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
            'last_used_brand' => Brand::Drumeo,
        ]);

        auth()->setUser($user);

        Cache::shouldReceive('get')
            ->once()
            ->with('user_' . $user->id . '_last_used_brand')
            ->andReturn(Brand::Drumeo);

        Cache::shouldReceive('add')
            ->once()
            ->with('user_' . $user->id . '_last_used_brand', Brand::Pianote->value)
            ->andReturnNull();

        $this->brandService->setLastUsedBrand($user, Brand::Pianote);

        $this->assertEquals(Brand::Pianote->value, $user->last_used_brand);
        $this->assertEquals(Brand::Pianote->value, user()->last_used_brand);
        $this->assertEquals(
            Brand::Pianote->value,
            cookie()->queued('user_' . $user->id . '_last_used_brand')->getValue()
        );

        $this->app->terminate();

        $this->assertDatabaseHas('usora_users', ['id' => $user->id, 'last_used_brand' => Brand::Pianote]);
    }
}
