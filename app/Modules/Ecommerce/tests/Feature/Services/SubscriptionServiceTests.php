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

        $subscription = Subscription::factory()->create([
            'user_id' => $user->id,
            'paid_until' => $expected->copy()->addDays(-100)
        ]);

        $subscription = Subscription::factory()->create([
            'user_id' => $user->id,
            'paid_until' => $expected
        ]);

        $subscription = Subscription::factory()->create([
            'user_id' => $user->id,
            'paid_until' => $expected->copy()->addDays(-10)
        ]);

        $actual = $this->subscriptionService->getLatestSubscriptionTime($user->id);
        $this->assertEquals($expected, $actual);
    }


}
