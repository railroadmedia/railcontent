<?php

namespace App\Modules\Mentor\tests\Feature\Services;


use App\Enums\Interval;
use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\database\factories\SubscriptionFactory;
use App\Modules\Ecommerce\database\factories\UserPaymentMethodFactory;
use App\Modules\Ecommerce\database\factories\UserProductFactory;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\SubscriptionUpgradeService;
use Tests\TestCase;

class SubscriptionUpgradeServiceTests extends TestCase
{
    private SubscriptionUpgradeService $subscriptionUpgradeService;
    private ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subscriptionUpgradeService = app(SubscriptionUpgradeService::class);
        $this->productRepository = app(ProductRepository::class);
    }

    public function test_upgrade(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        Auth::loginUsingId($user->id);
        UserPaymentMethodFactory::createPrimarySuccessfulPaymentMethod($user);
        $product1 = ProductFactory::createSubscriptionProduct(DigitalAccessType::Basic, Interval::Year, 100);
        $activeTime = Carbon::today();
        $expirationTime = Carbon::today()->addMonths(6)->addDays(10);
        /** @var Subscription $subscription */
        $subscription = SubscriptionFactory::createWith($user, $product1, $activeTime, $expirationTime);
        UserProductFactory::createUserProduct($user, $product1, $activeTime, $expirationTime);
        $product2 = ProductFactory::createSubscriptionProduct(DigitalAccessType::Plus, Interval::Year, 200);


        $this->subscriptionUpgradeService->upgrade($user->id);

        $oldSubscription = Subscription::query()->find($subscription->id);
        $newSubscription = Subscription::query()->where('user_id', '=', $user->id)
            ->where('id', '!=', $subscription->id)
            ->where('product_id', '=', $product2->id)
            ->first();

        $this->assertTrue($oldSubscription->isCancelled());
        $this->assertTrue($oldSubscription->paid_until == $newSubscription->paid_until);
    }


}
