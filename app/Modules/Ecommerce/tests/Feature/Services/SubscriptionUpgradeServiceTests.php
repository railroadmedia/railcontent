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
use Railroad\Ecommerce\Services\UpgradeService;
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
        $this->testSubscriptionChange(
            DigitalAccessType::Basic,
            Interval::Year,
            DigitalAccessType::Plus,
            Interval::Year
        );
    }

    public function test_downgrade(): void
    {
        $this->testSubscriptionChange(
            DigitalAccessType::Plus,
            Interval::Year,
            DigitalAccessType::Basic,
            Interval::Year
        );
    }

    public function test_crossgrade_basic(): void
    {
        $this->testSubscriptionChange(
            DigitalAccessType::Basic,
            Interval::Year,
            DigitalAccessType::Basic,
            Interval::Month
        );
    }

    public function test_crossgrade_plus(): void
    {
        $this->testSubscriptionChange(
            DigitalAccessType::Plus,
            Interval::Year,
            DigitalAccessType::Plus,
            Interval::Month
        );
    }


    private function testSubscriptionChange(
        DigitalAccessType $originalAccessType,
        Interval $originalInterval,
        DigitalAccessType $newAccessType,
        Interval $newInterval
    ): void {
        /** @var User $user */
        $user = User::factory()->create();
        Auth::loginUsingId($user->id);
        UserPaymentMethodFactory::createPrimarySuccessfulPaymentMethod($user);
        $product1 = ProductFactory::createSubscriptionProduct(
            UpgradeService::MusoraProductBrand,
            $originalAccessType,
            $originalInterval,
            100
        );
        $activeTime = Carbon::today();
        $expirationTime = Carbon::today()->addMonths(6)->addDays(10);
        /** @var Subscription $subscription */
        $subscription = SubscriptionFactory::createWith($user, $product1, $activeTime, $expirationTime);
        UserProductFactory::createUserProduct($user, $product1, $activeTime, $expirationTime);
        $product2 = ProductFactory::createSubscriptionProduct(
            UpgradeService::MusoraProductBrand,
            $newAccessType,
            $newInterval,
            200
        );


        $this->subscriptionUpgradeService->changeSubscription($newAccessType->value, $newInterval->value, $user->id);

        /** @var Subscription $oldSubscription */
        $oldSubscription = Subscription::query()->find($subscription->id);
        /** @var Subscription $newSubscription */
        $newSubscription = Subscription::query()->where('user_id', '=', $user->id)
            ->where('id', '!=', $subscription->id)
            ->where('product_id', '=', $product2->id)
            ->first();

        $this->assertTrue($oldSubscription->isCancelled());
        $this->assertTrue($oldSubscription->paid_until == $newSubscription->paid_until);
    }

}
