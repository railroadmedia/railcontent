<?php

namespace App\Modules\CustomerIO\tests\Functional;

use App\Enums\Interval;
use App\Modules\CustomerIO\tests\CustomerIoTestCase;
use App\Modules\Ecommerce\database\factories\SubscriptionFactory;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserProduct;
use App\Modules\EventDataSynchronizer\Services\CustomerIoSyncService;
use Carbon\Carbon;
use Doctrine\ORM\NonUniqueResultException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Models\User;

class CustomerIoSyncServiceTest extends CustomerIoTestCase
{
    const BRAND = "musora";
    private CustomerIoSyncService $customerIoSyncService;

    /**
     * @throws NonUniqueResultException
     */
    public function test_lifetime_membership_applies_to_all_brands_in_customer_io()
    {
        $user = $this->createUser();
        $lifetimeProduct = $this->createLifetimeProduct();

        // verify that the user does not have any lifetime membership
        $lifetimeAccess = $this->getLifetimeMembershipAccessAttributes($user);
        $lifetimeMemberships = $this->getTrueLifetimeMembershipAccessAttributes($lifetimeAccess);

        $this->assertEmpty($lifetimeMemberships);

        // record the number of brand memberships, so we can ensure we have that many true later
        $membershipCount = $lifetimeAccess->count();

        // assign the lifetime product to the user
        UserProduct::factory()->create([
            "user_id" => $user->id,
            "product_id" => $lifetimeProduct->id,
            "expiration_date" => null
        ]);
        $user->refresh();

        $this->customerIoSyncService->getUsersMembershipAccessAttributes($user);

        $lifetimeAccess = $this->getLifetimeMembershipAccessAttributes($user);
        $lifetimeMemberships = $this->getTrueLifetimeMembershipAccessAttributes($lifetimeAccess);

        // user should have lifetime membership for all brands now
        $this->assertEmpty($lifetimeAccess->filter(function ($value) {
            return !$value;
        }));
        $this->assertCount($membershipCount, $lifetimeMemberships);
    }

    /**
     * Create a user with a subscription to a non-lifetime product
     *
     * @return User
     */
    private function createUser(): User
    {
        $product = Product::factory()->createSubscriptionProduct(
            self::BRAND,
            DigitalAccessType::Basic,
            Interval::Year,
            100
        );
        // ensure that the user does not have any lifetime membership
        /**
         * @var User $user
         */
        $user = User::factory([
            "is_lifetime_member" => false,
            "access_level" => null,
        ])->hasUserProduct(["product_id" => $product->id])->create();

        $activeTime = Carbon::today();
        $expirationTime = Carbon::today()->addMonths(6)->addDays(10);
        SubscriptionFactory::createWith($user, $product, $activeTime, $expirationTime,
            [
                "interval_type" => "year",
                "interval_count" => 1,
            ]);

        return $user;
    }

    /**
     * Create a lifetime membership product for the specified brand
     *
     * @param string|null $brand
     * @return Product
     */
    private function createLifetimeProduct(?string $brand = self::BRAND): Product
    {
        $name = "Lifetime membership for $brand";
        return Product::factory([
            "brand" => $brand,
            "name" => $name,
            "sku" => Str::slug($name),
            "fulfillment_sku" => "membership",
            "price" => 500,
            "type" => Product::TYPE_DIGITAL_ONE_TIME,
            "active" => true,
            "is_physical" => false,
            "digital_access_type" => DigitalAccessType::Basic,
            "digital_access_time_interval_type" => null,
            "digital_access_time_type" => "lifetime",
            "digital_access_time_interval_length" => 0,
            "digital_membership_access_expiration_date" => null,
        ])
            ->create();
    }

    /**
     * Get the user's membership access attributes from the CustomerIO sync service, and return only those that are
     * for brand lifetime memberships
     *
     * @param User $user
     * @return Collection
     * @throws NonUniqueResultException
     */
    private function getLifetimeMembershipAccessAttributes(User $user): Collection
    {
        $membershipAccessAttributes = collect($this->customerIoSyncService->getUsersMembershipAccessAttributes($user));
        return $membershipAccessAttributes->filter(function ($value, $key) {
            return Str::endsWith($key, "membership_is_lifetime");
        });
    }

    /**
     * Filter the collection of lifetime membership attributes and return only those that are true
     *
     * @param Collection $lifetimeAccessAttributes
     * @return Collection
     */
    private function getTrueLifetimeMembershipAccessAttributes(Collection $lifetimeAccessAttributes): Collection
    {
        return $lifetimeAccessAttributes->filter(function ($value) {
            return $value;
        });
    }

    /**
     * @throws BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->customerIoSyncService = app()->make(CustomerIoSyncService::class);
    }
}
