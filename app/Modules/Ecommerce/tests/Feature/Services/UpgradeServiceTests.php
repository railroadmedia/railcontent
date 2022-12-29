<?php

namespace App\Modules\Mentor\tests\Feature\Services;


use App\Enums\Interval;
use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\database\factories\SubscriptionFactory;
use App\Modules\Ecommerce\database\factories\UserProductFactory;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Services\UpgradeService;
use Tests\TestCase;

class UpgradeServiceTests extends TestCase
{
    private UpgradeService $upgradeService;
    private ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->upgradeService = app(UpgradeService::class);
        $this->productRepository = app(ProductRepository::class);
    }

    private function getDiscountAmount(Product $product): float
    {
        $productE = $this->productRepository->find($product->id);
        return $this->upgradeService->getDiscountAmount($productE);
    }

    public function test_discount_no_subscription(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        Auth::loginUsingId($user->id);
        $product1 = ProductFactory::createSubscriptionProduct(DigitalAccessType::Basic, Interval::Year, 100);

        $discount = $this->getDiscountAmount($product1);

        $this->assertEquals(0, $discount);
    }

    public function test_discount_upgrade_yearly(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        Auth::loginUsingId($user->id);
        $product1 = ProductFactory::createSubscriptionProduct(DigitalAccessType::Basic, Interval::Year, 100);
        $activeTime = Carbon::today();
        $expirationTime = Carbon::today()->addMonths(6)->addDays(10);
        SubscriptionFactory::createWith($user, $product1, $activeTime, $expirationTime);
        UserProductFactory::createUserProduct($user, $product1, $activeTime, $expirationTime);
        $product2 =  ProductFactory::createSubscriptionProduct(DigitalAccessType::Plus, Interval::Year, 200);

        $discount = $this->getDiscountAmount($product2);

        $this->assertEquals(150, $discount);
    }

    public function test_discount_upgrade_monthly(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        Auth::loginUsingId($user->id);
        $product1 = ProductFactory::createSubscriptionProduct(DigitalAccessType::Basic, Interval::Month, 100);
        $activeTime = Carbon::today();
        $expirationTime = Carbon::today()->addDays(10);
        SubscriptionFactory::createWith($user, $product1, $activeTime, $expirationTime);
        UserProductFactory::createUserProduct($user, $product1, $activeTime, $expirationTime);
        $product2 =  ProductFactory::createSubscriptionProduct(DigitalAccessType::Plus, Interval::Month, 200);

        $discount = $this->getDiscountAmount($product2);

        $this->assertEquals(200, $discount);
    }

    public function test_discount_crossgrade_all(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        Auth::loginUsingId($user->id);
        $product1 =  ProductFactory::createSubscriptionProduct(DigitalAccessType::Plus, Interval::Year, 100);
        $activeTime = Carbon::today();
        $expirationTime = Carbon::today()->addMonths(6)->addDays(10);
        SubscriptionFactory::createWith($user, $product1, $activeTime, $expirationTime);
        UserProductFactory::createUserProduct($user, $product1, $activeTime, $expirationTime);
        $product2 =  ProductFactory::createSubscriptionProduct(DigitalAccessType::Plus, Interval::Year, 200);

        $discount = $this->getDiscountAmount($product2);

        $this->assertEquals(200, $discount);
    }

    public function test_discount_crossgrade_basic(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        Auth::loginUsingId($user->id);
        $product1 = ProductFactory::createSubscriptionProduct(DigitalAccessType::Basic, Interval::Year, 100);
        $activeTime = Carbon::today();
        $expirationTime = Carbon::today()->addMonths(6)->addDays(10);
        SubscriptionFactory::createWith($user, $product1, $activeTime, $expirationTime);
        UserProductFactory::createUserProduct($user, $product1, $activeTime, $expirationTime);
        $product2 =  ProductFactory::createSubscriptionProduct(DigitalAccessType::Basic, Interval::Year, 200);

        $discount = $this->getDiscountAmount($product2);

        $this->assertEquals(200, $discount);
    }
}
