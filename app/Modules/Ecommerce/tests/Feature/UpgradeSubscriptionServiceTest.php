<?php

namespace App\Modules\Ecommerce\tests\Feature;

use App\Enums\Interval;
use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\Ecommerce\Enums\MembershipLevel;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\SubscriptionUpgradeService;
use Carbon\Carbon;
use Mockery\MockInterface;
use Modules\UserManagementSystem\Factories\UserFactory;
use Tests\TestCase;

class UpgradeSubscriptionServiceTest extends TestCase
{
    private SubscriptionUpgradeService $subscriptionUpgradeService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subscriptionUpgradeService = $this->app->make(SubscriptionUpgradeService::class);
    }

    public function test_upgrade_subscription_product_month(): void
    {
        $user = UserFactory::createMember(MembershipLevel::Basic, Carbon::now()->addDays(20));
        Product::factory()->create(['sku' => SubscriptionUpgradeService::MonthlySongsAddOnSKU]);

        $productInfo = $this->subscriptionUpgradeService->getUpgradeProductInfo($user);
        $this->assertEquals(SubscriptionUpgradeService::MonthlySongsAddOnSKU, $productInfo['sku']);
        $this->assertEquals(0, $productInfo['quantity']);
    }

    public function test_upgrade_subscription_product_year(): void
    {
        $user = UserFactory::createMember(MembershipLevel::Basic, Carbon::now()->addMonths(7)->addDays(5));
        Product::factory()->create(['sku' => SubscriptionUpgradeService::MonthlySongsAddOnSKU]);

        $productInfo = $this->subscriptionUpgradeService->getUpgradeProductInfo($user);
        $this->assertEquals(SubscriptionUpgradeService::MonthlySongsAddOnSKU, $productInfo['sku']);
        $this->assertEquals(7, $productInfo['quantity']);
    }

    public function test_upgrade_subscription_product_more_than_year(): void
    {
        $user = UserFactory::createMember(MembershipLevel::Basic, Carbon::now()->addMonths(25));
        Product::factory()->create(['sku' => SubscriptionUpgradeService::MonthlySongsAddOnSKU]);

        $productInfo = $this->subscriptionUpgradeService->getUpgradeProductInfo($user);
        $this->assertEquals(SubscriptionUpgradeService::MonthlySongsAddOnSKU, $productInfo['sku']);
        $this->assertEquals(12, $productInfo['quantity']);
    }

    public function test_upgrade_subscription_product_lifetime(): void
    {
        $user = UserFactory::createLifetimeMember();
        Product::factory()->create(['sku' => SubscriptionUpgradeService::LifetimeSongAddOnSKU]);

        $productInfo = $this->subscriptionUpgradeService->getUpgradeProductInfo($user);
        $this->assertEquals(SubscriptionUpgradeService::LifetimeSongAddOnSKU, $productInfo['sku']);
        $this->assertEquals(1, $productInfo['quantity']);
    }

    public function test_upgrade_subscription_month(): void
    {
        $user = UserFactory::createMember(MembershipLevel::Basic, Carbon::now()->addDays(20));
        $product = ProductFactory::createSubscriptionProduct('musora', DigitalAccessType::Basic, Interval::Month, 10);
        $product2 = ProductFactory::createSubscriptionProduct('musora', DigitalAccessType::Plus, Interval::Month, 20);
        $subscriptionData = RechargeSubscriptionHelper::getSubscriptionData(
            $user,
            $product,
            Carbon::now()->addDays(30),
            1,
            Interval::Month
        );

        $this->partialMock(RechargeGateway::class, function (MockInterface $mock) use ($product2, $subscriptionData) {
            $mock->shouldReceive('getSubscriptions')->andReturn($subscriptionData);
            $mock->shouldReceive('updateSubscriptionProduct')->once()->withArgs(
                function ($subscription, $product) use ($subscriptionData, $product2) {
                    return $subscription->id == $subscriptionData[0]->id && $product->id == $product2->id;
                }
            );
        });
        /** @var SubscriptionUpgradeService $upgradeSubscriptionService */
        $upgradeSubscriptionService = $this->app->make(SubscriptionUpgradeService::class);
        $upgradeSubscriptionService->upgradeSubscription($user);
    }

    public function test_upgrade_subscription_year(): void
    {
        $user = UserFactory::createMember(MembershipLevel::Basic, Carbon::now()->addMonths(7)->addDays(5));
        $product = ProductFactory::createSubscriptionProduct('musora', DigitalAccessType::Basic, Interval::Year, 10);
        $product2 = ProductFactory::createSubscriptionProduct('musora', DigitalAccessType::Plus, Interval::Year, 20);
        $subscriptionData = RechargeSubscriptionHelper::getSubscriptionData(
            $user,
            $product,
            Carbon::now()->addDays(30),
            12,
            Interval::Month
        );

        $this->partialMock(RechargeGateway::class, function (MockInterface $mock) use ($product2, $subscriptionData) {
            $mock->shouldReceive('getSubscriptions')->andReturn($subscriptionData);
            $mock->shouldReceive('updateSubscriptionProduct')->once()->withArgs(
                function ($subscription, $product) use ($subscriptionData, $product2) {
                    return $subscription->id == $subscriptionData[0]->id && $product->id == $product2->id;
                }
            );
        });
        /** @var SubscriptionUpgradeService $upgradeSubscriptionService */
        $upgradeSubscriptionService = $this->app->make(SubscriptionUpgradeService::class);
        $upgradeSubscriptionService->upgradeSubscription($user);
    }

    public function test_upgrade_subscription_lifetime(): void
    {
        $user = UserFactory::createLifetimeMember();
        $product = ProductFactory::createSubscriptionProduct('musora', DigitalAccessType::Basic, Interval::Month, 10);
        $product2 = ProductFactory::createSubscriptionProduct('musora', DigitalAccessType::Plus, Interval::Month, 20);
        $subscriptionData = RechargeSubscriptionHelper::getSubscriptionData(
            $user,
            $product,
            Carbon::now()->addDays(30),
            1,
            Interval::Month
        );

        $this->partialMock(RechargeGateway::class, function (MockInterface $mock) use ($product2, $subscriptionData) {
            $mock->shouldReceive('getSubscriptions')->andReturn($subscriptionData);
            $mock->shouldReceive('updateSubscriptionProduct')->once()->withArgs(
                function ($subscription, $product) use ($subscriptionData, $product2) {
                    return $subscription->id == $subscriptionData[0]->id && $product->id == $product2->id;
                }
            );
        });
        /** @var SubscriptionUpgradeService $upgradeSubscriptionService */
        $upgradeSubscriptionService = $this->app->make(SubscriptionUpgradeService::class);
        $upgradeSubscriptionService->upgradeSubscription($user);
    }
}
