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
    const ROOT_BRAND = "musora";
    const MEMBERSHIP_LATEST_ACCESS_PRODUCT_ID_KEY = "_membership_latest-access-product-id";
    private CustomerIoSyncService $customerIoSyncService;

    /**
     * @throws BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->customerIoSyncService = app()->make(CustomerIoSyncService::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function test_lifetime_membership_applies_to_all_brands_in_customer_io()
    {
        $user = $this->createUser();
        $this->createProductForUser($user);

        // verify that the user does not have any lifetime membership
        $lifetimeAccess = $this->getLifetimeMembershipAccessAttributes($user);
        $lifetimeMemberships = $this->getTrueLifetimeMembershipAccessAttributes($lifetimeAccess);

        $this->assertEmpty($lifetimeMemberships);

        // record the number of brand memberships, so we can ensure we have that many true later
        $membershipCount = $lifetimeAccess->count();

        // create a lifetime product and assign it to the user
        $this->createLifetimeProduct($user);
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

    public function test_musora_membership_latest_access_product_respects_lifetime_memberships_in_customer_io()
    {
        $brand_1 = "singeo";
        $brand_2 = "pianote";
        $brand_3 = "drumeo";

        // create a user with a non-lifetime membership product for singeo
        $user = $this->createUser();
        $firstProduct = $this->createProductForUser($user, $brand_1);
        // then add a lifetime membership product for pianote
        $lifetimeProduct = $this->createLifetimeProduct($user, $brand_2);
        // and another non-lifetime membership, that will be the later product
        $laterProduct = $this->createProductForUser($user, $brand_3);

        $user->refresh();

        $brandAccounts = config("event-data-synchronizer.customer_io_account_name_brands_to_sync", []);

        $brand_1_membershipLatestAccessProductIdAttributes = $this->getMembershipLatestAccessProductIdAttributes($user, $brandAccounts[$brand_1]);
        $brand_2_membershipLatestAccessProductIdAttributes = $this->getMembershipLatestAccessProductIdAttributes($user, $brandAccounts[$brand_2]);
        $brand_3_membershipLatestAccessProductIdAttributes = $this->getMembershipLatestAccessProductIdAttributes($user, $brandAccounts[$brand_3]);

        // brand 1 does not have lifetime membership, so its own product is the original
        $this->assertSame($firstProduct->id, $brand_1_membershipLatestAccessProductIdAttributes->get($brand_1 . self::MEMBERSHIP_LATEST_ACCESS_PRODUCT_ID_KEY));
        // ... and the musora version is the lifetime product
        $this->assertSame($lifetimeProduct->id, $brand_1_membershipLatestAccessProductIdAttributes->get(self::ROOT_BRAND . self::MEMBERSHIP_LATEST_ACCESS_PRODUCT_ID_KEY));

        // brand 2 has a lifetime membership, so its own product and the musora version are both the lifetime product
        $this->assertSame($lifetimeProduct->id, $brand_2_membershipLatestAccessProductIdAttributes->get($brand_2 . self::MEMBERSHIP_LATEST_ACCESS_PRODUCT_ID_KEY));
        $this->assertSame($lifetimeProduct->id, $brand_2_membershipLatestAccessProductIdAttributes->get(self::ROOT_BRAND . self::MEMBERSHIP_LATEST_ACCESS_PRODUCT_ID_KEY));

        // brand 3 does not have lifetime membership, so its own product is the original
        $this->assertSame($laterProduct->id, $brand_3_membershipLatestAccessProductIdAttributes->get($brand_3 . self::MEMBERSHIP_LATEST_ACCESS_PRODUCT_ID_KEY));
        // ... and the musora version is the lifetime product
        $this->assertSame($lifetimeProduct->id, $brand_3_membershipLatestAccessProductIdAttributes->get(self::ROOT_BRAND . self::MEMBERSHIP_LATEST_ACCESS_PRODUCT_ID_KEY));
    }

    /**
     * Create a user who is not a lifetime member
     *
     * @return User
     */
    private function createUser(): User
    {
        // ensure that the user does not have any lifetime membership
        return  User::factory([
            "is_lifetime_member" => false,
            "access_level" => null,
        ])->create();
    }

    /**
     * Create a non-lifetime product and a subscription to it for the given user
     *
     * @param User $user
     * @param string|null $brand
     * @return Product
     */
    private function createProductForUser(User $user, ?string $brand = self::ROOT_BRAND): Product
    {
        $product = Product::factory()->createSubscriptionProduct(
            $brand,
            DigitalAccessType::Basic,
            Interval::Year,
            100
        );
        UserProduct::factory()->create([
            "user_id" => $user->id,
            "product_id" => $product->id,
        ]);

        $activeTime = Carbon::today();
        $expirationTime = Carbon::today()->addMonths(6)->addDays(10);
        SubscriptionFactory::createWith($user, $product, $activeTime, $expirationTime,
            [
                "interval_type" => "year",
                "interval_count" => 1,
            ]);

        return $product;
    }

    /**
     * Create a lifetime membership product for the specified brand.
     * If a user is provided, it will automatically be linked to the user.
     *
     * @param User|null $user
     * @param string|null $brand
     * @return Product
     */
    private function createLifetimeProduct(?User $user = null, ?string $brand = self::ROOT_BRAND): Product
    {
        $name = "Lifetime membership for $brand";
        $product = Product::factory([
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

        if ($user) {
            UserProduct::factory()->create([
                "user_id" => $user->id,
                "product_id" => $product->id,
                "expiration_date" => null
            ]);
        }
        return $product;
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
     * Get the user's custom attributes from the CustomerIO sync service, and return only those that are
     * for brand _membership_latest-access-product-id
     *
     * @param User $user
     * @param array $brands
     * @return Collection
     */
    private function getMembershipLatestAccessProductIdAttributes(User $user, array $brands): Collection
    {
        $userAttrs = collect($this->customerIoSyncService->getUsersCustomAttributes($user, $brands));

        return $userAttrs->filter(function ($value, $key) {
            return Str::endsWith($key, self::MEMBERSHIP_LATEST_ACCESS_PRODUCT_ID_KEY);
        });
    }
}
