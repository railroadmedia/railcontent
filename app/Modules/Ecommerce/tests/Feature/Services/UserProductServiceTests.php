<?php

namespace App\Modules\Mentor\tests\Feature\Services;


use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;
use App\Modules\Ecommerce\Services\UserProductService;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class UserProductServiceTests extends TestCase
{
    private UserProductService $userProductService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userProductService = app(UserProductService::class);
    }

    public function test_get_latest_subscription_time(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $expected = Carbon::today()->addDays(30);

        UserProduct::factory()->create([
            'user_id' => $user->id,
            'expiration_date' => $expected->copy()->addDays(-100)
        ]);

        UserProduct::factory()->create([
            'user_id' => $user->id,
            'expiration_date' => $expected
        ]);

        UserProduct::factory()->create([
            'user_id' => $user->id,
            'expiration_date' => $expected->copy()->addDays(-10)
        ]);

        $actual = $this->userProductService->getLatestExpirationTime($user->id);
        $this->assertEquals($expected, $actual);
    }

    public function test_get_first_user_product_brand(): void
    {
        $user = User::factory()->create();
        $expected = 'test';
        $decoyBrand = 'test2';

        UserProduct::factory()->create([
            'product_id' => Product::factory()->create(['brand' => $decoyBrand]),
            'user_id' => $user,
            'created_at' => Carbon::now()->addDays(2)
        ]);

        UserProduct::factory()->create([
            'product_id' => Product::factory()->create(['brand' => $expected]),
            'user_id' => $user,
            'created_at' => Carbon::now()->addDays(1)
        ]);

        UserProduct::factory()->create([
            'product_id' => Product::factory()->create(['brand' => $decoyBrand]),
            'user_id' => $user,
            'created_at' => Carbon::now()->addDays(3)
        ]);

        $actual = $this->userProductService->getFirstUserProductBrand($user->id, [$expected, $decoyBrand]);
        $this->assertEquals($expected, $actual);
    }


}
