<?php

namespace App\Modules\Mentor\tests\Feature\Services;


use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;
use App\Modules\Ecommerce\Services\SubscriptionService;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class SubscriptionServiceTests extends TestCase
{
    private SubscriptionService $subscriptionService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subscriptionService = app(SubscriptionService::class);
    }


    public function test_get_latest_subscription_time(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $expected = Carbon::today()->addDays(30);

        Subscription::factory()->create([
            'user_id' => $user->id,
            'paid_until' => $expected->copy()->addDays(-100)
        ]);

        Subscription::factory()->create([
            'user_id' => $user->id,
            'paid_until' => $expected
        ]);

        Subscription::factory()->create([
            'user_id' => $user->id,
            'paid_until' => $expected->copy()->addDays(-10)
        ]);

        $actual = $this->subscriptionService->getLatestSubscriptionTime($user->id);
        $this->assertEquals($expected, $actual);
    }


    public function test_get_first_subscription_brand(): void
    {
        $user = User::factory()->create();
        $expected = 'test';
        $decoyBrand = 'test2';

        Subscription::factory()->create([
            'user_id' => $user,
            'brand' => $decoyBrand,
            'created_at' => Carbon::now()->addDays(2)
        ]);

        Subscription::factory()->create([
            'user_id' => $user,
            'brand' => $expected,
            'created_at' => Carbon::now()->addDays(1)
        ]);

        Subscription::factory()->create([
            'user_id' => $user,
            'brand' => $decoyBrand,
            'created_at' => Carbon::now()->addDays(3)
        ]);

        $actual = $this->subscriptionService->getFirstSubscriptionBrand($user->id, [$expected, $decoyBrand]);
        $this->assertEquals($expected, $actual);
    }


}
