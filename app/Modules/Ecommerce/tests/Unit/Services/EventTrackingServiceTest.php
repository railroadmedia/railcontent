<?php

namespace App\Modules\Ecommerce\tests\Feature;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Recharge\Subscription;
use App\Modules\Ecommerce\Services\EventTrackingService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoCreateEventByUserId;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use Illuminate\Support\Arr;
use Modules\UserManagementSystem\Models\User;
use Queue;
use stdClass;
use Tests\TestCase;
use Tests\traits\CreatesReflectionProperty;

class EventTrackingServiceTest extends TestCase
{
    use CreatesReflectionProperty;

    private EventTrackingService $eventTrackingService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventTrackingService = $this->app->make(EventTrackingService::class);
    }

    public function test_handle_subscription_paused()
    {
        $user = User::factory()->create(['membership_expiration_date' => now()->addMonthsNoOverflow(2)]);
        $product = Product::factory()->create();

        $subscriptionData = new stdClass();
        $subscriptionData->id = fake()->randomNumber();
        $subscriptionData->customer_id = $user->id;
        $subscriptionData->email = $user->email;
        $subscriptionData->status = 'active';
        $subscriptionData->cancellation_reason = null;
        $subscriptionData->cancelled_at = null;
        $subscriptionData->sku = $product->sku;
        $subscriptionData->shopify_variant_id = $product->shopify_variant_id;
        $subscriptionData->next_charge_scheduled_at = now()->addMonthsNoOverflow(4)->timestamp;
        $subscriptionData->created_at = now()->subMonthNoOverflow(10)->timestamp;
        $subscriptionData->updated_at = now()->timestamp;

        $subscription = new Subscription($subscriptionData);
        $subscription->setProduct($product);

        // $this->markTestIncomplete('This test has not been implemented yet.');

        Queue::fake();

        $this->eventTrackingService->handleSubscriptionPaused($subscription, $user);

        Queue::assertPushed(CustomerIoSyncUserByUserId::class, function ($job) use ($user, $subscription) {
            return
                $this->getReflectionProperty($job, 'user')->id === $user->id &&
                $this->getReflectionProperty($job, 'data')[$subscription->product->brand . '_subscription_paused_until'] === $subscription->nextChargeScheduledAt->timestamp;
        });

        Queue::assertPushed(CustomerIoCreateEventByUserId::class, function ($job) use ($user, $subscription) {
            return
                $this->getReflectionProperty($job, 'userId') === $user->id &&
                $this->getReflectionProperty($job, 'eventData')['paused_until'] === $subscription->nextChargeScheduledAt->timestamp &&
                $this->getReflectionProperty($job, 'eventData')['duration_in_months'] === $subscription->nextChargeScheduledAt->diffInMonths($user->membership_expiration_date) &&
                $this->getReflectionProperty($job, 'eventName') === 'musora_user_subscription_paused';
        });
    }
}
