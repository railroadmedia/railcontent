<?php

namespace App\Modules\Ecommerce\Tests\Unit\Jobs\RevenueCat;

use App\Modules\Ecommerce\Jobs\RevenueCat\SubscriptionExpiredEventTrackingJob;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\EventTrackingService;
use Mockery;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;
use Tests\traits\CreatesReflectionProperty;

class SubscriptionExpiredEventTrackingJobTest extends TestCase
{
    use CreatesReflectionProperty;

    public function test_subscription_expired()
    {
        $userCreated = User::factory()->create(['membership_expiration_date' => now()->subMonthsNoOverflow(2)]);
        $revenueCatProductId = 'drumeo_app_1_year_member';
        $store = 'app_store';
        $product = Product::factory()->create(['sku' => 'DLM-1-year']);
        $data = [
            'event' => [
                'subscriber_attributes' => [
                    'email' => [
                        'value' => $userCreated->email
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

        $this->mock(EventTrackingService::class)
            ->shouldReceive('handleSubscriptionExpired')
            ->with(Mockery::type(User::class), $product->brand)
            ->withArgs(function (User $user, string $brand) use ($userCreated, $product) {
                return $user->id === $userCreated->id && $brand === $product->brand;
            })
            ->once()
            ->andReturnTrue();

        $this->assertEquals(config('ecommerce.apple_store_products_map')[$revenueCatProductId], $product->sku);

        SubscriptionExpiredEventTrackingJob::dispatchSync($data);
    }
}
