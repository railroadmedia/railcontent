<?php

namespace App\Modules\Mentor\tests\Feature\Services;


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


}
