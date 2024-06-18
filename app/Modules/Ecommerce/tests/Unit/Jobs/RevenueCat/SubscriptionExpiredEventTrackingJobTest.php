<?php

namespace App\Modules\Ecommerce\Tests\Unit\Jobs\RevenueCat;

use App\Modules\Ecommerce\Jobs\RevenueCat\SubscriptionExpiredEventTrackingJob;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\EventTrackingService;
use Mockery\MockInterface;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class SubscriptionExpiredEventTrackingJobTest extends TestCase
{
    public function test_subscription_expired()
    {
        $this->markTestIncomplete();
        $user = User::factory()->create(['membership_expiration_date' => now()->subMonthsNoOverflow(2)]);
        $revenueCatProductId = 'drumeo_app_1_year_member';
        $store = 'app_store';
        $product = Product::factory()->create(['sku' => 'DLM-1-year']);

        $mock = $this->mock(
            EventTrackingService::class,
            function (MockInterface $mock) use ($user, $product) {
                $mock->shouldReceive('handleSubscriptionExpired')
                    ->once()
                    // TODO: Figure out how to assert the $user argument
                    ->with($user, $product->brand)
                    ->andReturn(true);
            }
        );

        $data = [
            'event' => [
                'subscriber_attributes' => [
                    'email' => [
                        'value' => $user->email
                    ]
                ],
                'original_app_user_id' => '1',
                'aliases' => [fake()->word()],
                'store' => $store,
                'product_id' => $revenueCatProductId,
                'type' => 'EXPIRATION',
                'period_type' => 'NORMAL'
            ]
        ];

        SubscriptionExpiredEventTrackingJob::dispatchSync($data);
    }
}
