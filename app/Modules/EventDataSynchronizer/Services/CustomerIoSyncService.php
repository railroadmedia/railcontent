<?php

namespace App\Modules\EventDataSynchronizer\Services;

use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Carbon\Carbon;
use Doctrine\ORM\NonUniqueResultException;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\PaymentMethod;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Entities\UserProduct;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Repositories\UserProductRepository;
use Railroad\Railcontent\Repositories\ContentFollowsRepository;
use Railroad\Railcontent\Services\ConfigService as RailcontentConfigService;

class CustomerIoSyncService
{
    const AttributeLimit = 1000;

    /**
     * @var SubscriptionRepository
     */
    protected $subscriptionRepository;

    /**
     * @var UserProductRepository
     */
    protected $userProductRepository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var ContentFollowsRepository
     */
    private $contentFollowsRepository;

    private UserMembershipFieldsService $userMembershipFieldsService;
    private UserAccessPermissionsService $userAccessPermissionsService;

    public function __construct(
        SubscriptionRepository $subscriptionRepository,
        UserProductRepository $userProductRepository,
        ProductRepository $productRepository,
        ContentFollowsRepository $contentFollowsRepository,
        UserMembershipFieldsService $userMembershipFieldsService,
        UserAccessPermissionsService $userAccessPermissionsService
    ) {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->userProductRepository = $userProductRepository;
        $this->productRepository = $productRepository;
        $this->contentFollowsRepository = $contentFollowsRepository;
        $this->userMembershipFieldsService = $userMembershipFieldsService;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    /**
     * @param User $user
     * @param array|null $brands
     * @return array
     */
    public function getUsersCustomAttributes(User $user, array $brands = null)
    {
        if (config('shopify.enabled')) {
            $membershipAccessAttributes = $this->getUsersMembershipAccessAttributes($user, $brands);
            $contentFollowAttributes = $this->getUsersContentFollowAttributes($user);

            return array_merge(
                $this->getUsersMusoraProfileAttributes($user),
                $membershipAccessAttributes,
                $contentFollowAttributes,
            );
        } else {
            //TODO: remove post shopify
            $membershipAccessAttributes = $this->getUsersMembershipAccessAttributesDeprecated($user, $brands);

            $contentFollowAttributes = $this->getUsersContentFollowAttributes($user);

            return array_merge(
                $this->getUsersMusoraProfileAttributes($user),
                $membershipAccessAttributes,
                $this->getUsersSubscriptionAttributes($user, $membershipAccessAttributes, $brands),
                $this->getUsersProductOwnershipStrings($user, $brands),
                $contentFollowAttributes,
            );
        }

    }

    /**
     * @param User $user
     * @return array
     */
    public function getUsersMusoraProfileAttributes(User $user)
    {
        $fullNameArray = [];

        if (!empty($user->first_name)) {
            $fullNameArray[] = $user->first_name;
        }

        if (!empty($user->last_name)) {
            $fullNameArray[] = $user->last_name;
        }

        return [
            'musora_profile_preffered-name' => !empty($fullNameArray) ? implode(' ', $fullNameArray) : null,
            'musora_profile_display-name' => $user->display_name,
            'musora_profile_gender' => $user->gender,
            'musora_profile_country' => $user->country,
            'musora_profile_region' => $user->region,
            'musora_profile_city' => $user->city,
            'musora_profile_birthday' => $user->birthday,
            'musora_phone-number' => $user->phone_number,
            'musora_timezone' => $user->timezone,
            'musora_notify_of_weekly_updates' => $user->notify_weekly_update > 0,
        ];
    }

    private function getUsersMembershipAccessAttributes(User $user, mixed $brands): array
    {
        $attributes = [];
        foreach ($brands as $brand) {
            $attributes += [
                $brand . "_membership_access-expiration-date" => !empty($user->membership_expiration_date) ? Carbon::parse($user->membership_expiration_date)->timestamp : null,
                $brand . "_membership_is_lifetime" => $user->is_lifetime_member ? "true" : "false",
                //$brand . '_membership_subscription_source_app-store' => $user->hasMobileMembership() ? "true" : "",
            ];
        }
        return $attributes;
    }


    /**
     * Attribute list:
     * BRAND_membership_access-expiration-date (null if BRAND_membership_is_lifetime is true)
     * BRAND_membership_is_lifetime
     * BRAND_membership_latest-start-date
     * BRAND_membership_first-start-date
     *
     * @param User $user
     * @param array $brands
     * @return array
     * @throws NonUniqueResultException
     */
    public function getUsersMembershipAccessAttributesDeprecated(User $user, array $brands = []): array
    {
        if (empty($brands)) {
            $brands = config('event-data-synchronizer.customer_io_brands_to_sync');
        }

        $latestSubscription = $this->subscriptionRepository->getUserMembershipSubscriptionBeforeDate(
            $user->id,
            Carbon::now()
        );
        $userProducts = $this->userProductRepository->getAllUsersProducts($user->id);
        $membershipProduct = $this->userMembershipFieldsService->getUserProductThatRepresentsUsersMembership(
            $user->id,
            $userProducts
        );

        $productAttributes = [];

        foreach ($brands as $brand) {
            // get all the eligible user products for this brand
            $eligibleUserProducts = [];

            foreach ($userProducts as $userProductIndex => $userProduct) {
                if (!$this->isEligibleMembershipProduct($brand, $userProduct->getProduct())) {
                    continue;
                }

                $eligibleUserProducts[] = $userProduct;
            }

            $latestMembershipUserProductToSync = $this->getLatestMembershipUserProduct($eligibleUserProducts);
            $firstMembershipUserProductToSync = $this->getFirstMembershipUserProduct($eligibleUserProducts);
            $this->addMembershipAccessProperties(
                $brand,
                $latestSubscription,
                $membershipProduct,
                $latestMembershipUserProductToSync,
                $firstMembershipUserProductToSync,
                $productAttributes
            );
        }

        $this->handleLifetimeMembership($userProducts, $brands, $productAttributes);

        return $productAttributes;
    }

    /**
     * Get the latest membership UserProduct
     * (or the lifetime membership product, if applicable)
     *
     * @param array<UserProduct> $eligibleUserProducts
     * @return UserProduct|null
     */
    private function getLatestMembershipUserProduct(array $eligibleUserProducts): UserProduct|null
    {
        $latestMembershipUserProductToSync = null;
        foreach ($eligibleUserProducts as $eligibleUserProductIndex => $eligibleUserProduct) {
            // if it's lifetime, use it
            if (empty($eligibleUserProduct->getExpirationDate())) {
                $latestMembershipUserProductToSync = $eligibleUserProduct;
                break;
            }

            if (empty($latestMembershipUserProductToSync)) {
                $latestMembershipUserProductToSync = $eligibleUserProduct;
                continue;
            }

            // if this product expiration date is further in the past than whatever is currently set, skip it
            if ($latestMembershipUserProductToSync->getExpirationDate() < $eligibleUserProduct->getExpirationDate()) {
                $latestMembershipUserProductToSync = $eligibleUserProduct;
            }
        }
        return $latestMembershipUserProductToSync;
    }

    /**
     * Get the first membership UserProduct
     *
     * @param array<UserProduct> $eligibleUserProducts
     * @return UserProduct|null
     */
    private function getFirstMembershipUserProduct(array $eligibleUserProducts): UserProduct|null
    {
        $firstMembershipUserProductToSync = null;
        foreach ($eligibleUserProducts as $eligibleUserProductIndex => $eligibleUserProduct) {
            if (empty($firstMembershipUserProductToSync)) {
                $firstMembershipUserProductToSync = $eligibleUserProduct;

                continue;
            }

            // if this product expiration date is further in the past than whatever is currently set, skip it
            if ($eligibleUserProduct->getCreatedAt() < $firstMembershipUserProductToSync->getCreatedAt()) {
                $firstMembershipUserProductToSync = $eligibleUserProduct;
            }
        }

        return $firstMembershipUserProductToSync;
    }

    /**
     * Add attributes related to the user's membership product
     *
     * @param string $brand
     * @param Subscription|null $latestSubscription
     * @param UserProduct|null $membershipProduct
     * @param UserProduct|null $latestMembershipUserProductToSync
     * @param UserProduct|null $firstMembershipUserProductToSync
     * @param array $productAttributes
     * @return void
     */
    private function addMembershipAccessProperties(
        string $brand,
        ?Subscription $latestSubscription,
        ?UserProduct $membershipProduct,
        ?UserProduct $latestMembershipUserProductToSync,
        ?UserProduct $firstMembershipUserProductToSync,
        array &$productAttributes
    ): void {
        $membershipAccessExpirationDate = $membershipProduct?->getExpirationDate() ?: null;

        if (!empty($latestMembershipUserProductToSync) && !empty($firstMembershipUserProductToSync)) {
            $membershipLatestAccessStartDate = $latestMembershipUserProductToSync->getCreatedAt();
            $membershipFirstAccessStartDate = $firstMembershipUserProductToSync->getCreatedAt();
        } else {
            $membershipLatestAccessStartDate = null;
            $membershipFirstAccessStartDate = null;
        }

        $productAttributes += [
            $brand . '_membership_access-expiration-date' => !empty($membershipAccessExpirationDate) ?
                $membershipAccessExpirationDate->timestamp : null,
            $brand . '_membership_latest-access-start-date' => !empty($membershipLatestAccessStartDate) ?
                $membershipLatestAccessStartDate->timestamp : null,
            $brand . '_membership_first-access-start-date' => !empty($membershipFirstAccessStartDate) ?
                $membershipFirstAccessStartDate->timestamp : null,
            $brand . '_membership_is_lifetime' => !empty($latestMembershipUserProductToSync) ?
                empty($latestMembershipUserProductToSync->getExpirationDate()) : null,
            $brand . '_membership_latest-access-type' => !empty($latestSubscription) ?
                $latestSubscription->getIntervalType() : null,
            $brand . '_membership_status' => !empty($latestSubscription) ?
                $latestSubscription->getIsActive() : null,
            $brand . '_membership_latest-access-product-id' => !empty($latestMembershipUserProductToSync) ?
                $latestMembershipUserProductToSync->getProduct()->getId() : null
        ];
    }

    /**
     * Handle special cases if the user has a lifetime membership product
     *
     * @param array<UserProduct> $userProducts
     * @param array<string> $brands
     * @param array $productAttributes
     * @return void
     */
    private function handleLifetimeMembership(array $userProducts, array $brands, array &$productAttributes): void
    {
        $lifetimeMemberships = collect($userProducts)->filter(function (UserProduct $userProduct) {
            return empty($userProduct->getExpirationDate())
                && $userProduct->getProduct()->getDigitalAccessTimeType() == Product::DIGITAL_ACCESS_TIME_TYPE_LIFETIME;
        });

        if ($lifetimeMemberships->isNotEmpty()) {
            /**
             * @var UserProduct $lifetimeMembership
             */
            $lifetimeMembership = $lifetimeMemberships->first();
            $brand_ltm_keys = collect($brands)->transform(fn($brand) => "{$brand}_membership_is_lifetime")->toArray();
            foreach ($brand_ltm_keys as $brand_ltm_key) {
                $productAttributes[$brand_ltm_key] = true;
            }
            // BR-904: the musora_membership_latest-access-product-id should use the lifetime membership product, if applicable
            $rootBrand = config('event-data-synchronizer.customer_io_account_to_sync_all_brands');
            $productAttributes[$rootBrand . '_membership_latest-access-product-id'] = $lifetimeMembership->getProduct(
            )?->getId() ?? null;
        }
    }

    /**
     * Attribute list:
     * BRAND_subscribed_coaches => 'ID123_FNAME_LNAME, ID1234_FNAME2_LNAME2, etc'
     *
     * @param User $user
     * @param array $brands
     * @return array
     */
    public function getUsersContentFollowAttributes(User $user, array $brands = [])
    {
        // for now we'll sync all brands to all workspaces

        $contentFollowRows = $this->contentFollowsRepository->query()
            ->join(
                RailcontentConfigService::$tableContent,
                RailcontentConfigService::$tableContent . '.id',
                '=',
                RailcontentConfigService::$tableContentFollows . '.content_id'
            )
            ->where(
                [
                    RailcontentConfigService::$tableContent . '.type' => 'instructor',
                    RailcontentConfigService::$tableContentFollows . '.user_id' => $user->id,
                ]
            )
            ->get();

        // ['brand1' => ['ID_COACH_NAME', 'ID2_COACH_NAME'], 'brand2' => ['ID_COACH_NAME', 'ID2_COACH_NAME'],]
        $brandCoachFollows = [];

        foreach ($contentFollowRows as $contentFollowRow) {
            $brandCoachFollows[$contentFollowRow['brand']][] = $contentFollowRow['content_id'] . '_' . str_replace(
                    '-',
                    '_',
                    $contentFollowRow['slug']
                );
        }

        $contentFollowAttributes = [];

        foreach ($brandCoachFollows as $contentBrand => $followContentIdsAndSlugsString) {
            $contentFollowAttributes[$contentBrand . '_subscribed_coaches'] = substr(
                implode(
                    ', ',
                    $followContentIdsAndSlugsString
                ),
                0,
                self::AttributeLimit
            );
        }

        return $contentFollowAttributes;
    }

    /**
     * If no brands are passed in this will get attributes for all brands in the config.
     * We need the $userProductAttributes since if the user is lifetime all the attributes should be null.
     *
     * @param User $user
     * @param array $userMembershipAccessAttributes
     * @param array $brands
     * @return array
     */
    public function getUsersSubscriptionAttributes(
        User $user,
        array $userMembershipAccessAttributes,
        array $brands = []
    ) {
        if (empty($brands)) {
            $brands = config('event-data-synchronizer.customer_io_brands_to_sync');
        }

        $subscriptionAttributes = [];

        $userSubscriptions = $this->subscriptionRepository->getAllUsersSubscriptions($user->id);

        foreach ($brands as $brand) {
            $membershipRenewalDate = null;
            $membershipCancellationDate = null;
            $membershipCancellationReason = null;
            $membershipRenewalAttempts = null;
            $subscriptionStatus = null;
            $subscriptionPriceCents = null;
            $subscriptionCurrency = null;
            $latestSubscriptionStartedDate = null;
            $firstSubscriptionStartedDate = null;
            $trialType = null;
            $expirationDate = null;
            $isAppSignup = null;

            /**
             * @var $latestSubscriptionToSync Subscription|null
             */
            $latestSubscriptionToSync = null;

            /**
             * @var $latestSubscriptionToSync Subscription|null
             */
            $firstSubscriptionToSync = null;

            // We only want to sync attributes to subscriptions for membership products.
            // If there are multiple active membership subs we will always sync the one with the further paid_until
            // in the future.
            foreach ($userSubscriptions as $userSubscription) {
                if (!$this->isEligibleMembershipProduct($brand, $userSubscription->getProduct())) {
                    continue;
                }

                if (empty($latestSubscriptionToSync)) {
                    $latestSubscriptionToSync = $userSubscription;
                    continue;
                }

                // if this subscription paid_until is further in the past than whatever is currently set, skip it
                // unless the set subscription is not-active and this one is, then use the active one
                if (($latestSubscriptionToSync->getPaidUntil() < $userSubscription->getPaidUntil() ||
                    !$latestSubscriptionToSync->getIsActive() &&
                    $userSubscription->getIsActive())) {
                    $latestSubscriptionToSync = $userSubscription;
                }
            }

            foreach ($userSubscriptions as $userSubscription) {
                if (!$this->isEligibleMembershipProduct($brand, $userSubscription->getProduct())) {
                    continue;
                }

                if (empty($firstSubscriptionToSync)) {
                    $firstSubscriptionToSync = $userSubscription;

                    continue;
                }

                // get the earliest started subscription
                if ($firstSubscriptionToSync->getStartDate() > $userSubscription->getStartDate()) {
                    $firstSubscriptionToSync = $userSubscription;
                }
            }

            if (!empty($firstSubscriptionToSync)) {
                $firstSubscriptionStartedDate = $firstSubscriptionToSync->getStartDate()->timestamp;
            }

            // Get expiration date
            if (!empty($latestSubscriptionToSync)) {
                $totalPaymentsOnActiveSubscription = 0;

                foreach ($latestSubscriptionToSync->getPayments() as $_payment) {
                    if ($_payment->getTotalPaid() == $_payment->getTotalDue()) {
                        $totalPaymentsOnActiveSubscription++;
                    }
                }

                $membershipRenewalDate = $latestSubscriptionToSync->getPaidUntil()->timestamp;
                $subscriptionPriceCents = $latestSubscriptionToSync->getTotalPrice() * 100;
                $subscriptionCurrency = $latestSubscriptionToSync->getCurrency();
                $membershipRenewalAttempts = $latestSubscriptionToSync->getRenewalAttempt();
                $membershipCancellationDate =
                    !empty($latestSubscriptionToSync->getCanceledOn()) ?
                        $latestSubscriptionToSync->getCanceledOn()->timestamp :
                        null;
                $membershipCancellationReason = $latestSubscriptionToSync->getCancellationReason();
                $subscriptionStatus = $latestSubscriptionToSync->getState();
                $latestSubscriptionStartedDate = $latestSubscriptionToSync->getCreatedAt()->timestamp;

                if (in_array(
                    $latestSubscriptionToSync->getType(),
                    [
                        Subscription::TYPE_APPLE_SUBSCRIPTION,
                        Subscription::TYPE_GOOGLE_SUBSCRIPTION,
                    ]
                )) {
                    $isAppSignup = true;
                }
                // i could not figure out how else to catch the doctrine exception when no payment method exists - caleb sept 2019
                try {
                    if (!empty($latestSubscriptionToSync->getPaymentMethod())) {
                        if ($latestSubscriptionToSync->getPaymentMethod()
                                ->getMethodType() == PaymentMethod::TYPE_CREDIT_CARD) {
                            $expirationDate = Carbon::parse(
                                $latestSubscriptionToSync->getPaymentMethod()
                                    ->getMethod()
                                    ->getExpirationDate()
                            )->timestamp;
                        } elseif ($latestSubscriptionToSync->getPaymentMethod()
                                ->getMethodType() == PaymentMethod::TYPE_PAYPAL) {
                            $expirationDate = null;
                        }
                    }
                } catch (Exception $exception) {
                    $expirationDate = null;
                }
            }

            // if the cancelled_on date is changed to null, then set the cancellation_reason to null as well
            if (!empty($latestSubscriptionToSync)) {
                $cancelledOnIsNull = is_null($latestSubscriptionToSync->getCanceledOn());
                if ($cancelledOnIsNull) {
                    $latestSubscriptionToSync->setCancellationReason(null);
                }
            }

            $subscriptionProductTag = null;

            if (!empty($latestSubscriptionToSync)) {
                $subscriptionProductTag =
                    $latestSubscriptionToSync->getIntervalCount() . '_' . $latestSubscriptionToSync->getIntervalType();

                // trial type
                $customerIoTrialProductSkuToType =
                    config('event-data-synchronizer.customer_io_trial_product_sku_to_type', []);

                if (!empty($customerIoTrialProductSkuToType[$latestSubscriptionToSync->getProduct()->getBrand()]) &&
                    !empty(
                    $customerIoTrialProductSkuToType[$latestSubscriptionToSync->getProduct()->getBrand(
                    )][$latestSubscriptionToSync->getProduct()->getSku()]
                    )) {
                    $trialType = $customerIoTrialProductSkuToType[$latestSubscriptionToSync->getProduct()->getBrand()]
                    [$latestSubscriptionToSync->getProduct()->getSku()] ?? null;
                }
            }

            // if the user is a lifetime make sure all subscription related info is set to null
            if (($userMembershipAccessAttributes[$brand . '_membership_is_lifetime'] ?? false)) {
                $subscriptionPriceCents = null;
                $subscriptionCurrency = null;
                $membershipRenewalDate = null;
                $membershipRenewalAttempts = null;
                $membershipCancellationDate = null;
                $membershipCancellationReason = null;
                $subscriptionStatus = null;
                $latestSubscriptionStartedDate = null;
                $firstSubscriptionStartedDate = null;
                $subscriptionProductTag = null;
                $trialType = null;
                $expirationDate = null;
                $isAppSignup = null;
            }


            $subscriptionAttributes += [
                $brand . '_membership_status' => $subscriptionStatus,
                $brand . '_membership_subscription_type' => $subscriptionProductTag,
                $brand . '_membership_subscription-rate-cents' => $subscriptionPriceCents,
                $brand . '_membership_subscription-currency' => $subscriptionCurrency,
                $brand . '_membership_subscription_renewal-date' => $membershipRenewalDate,
                $brand . '_retention_failed-billing_membership_subscription-renewal-attempts' => $membershipRenewalAttempts,
                $brand . '_membership_subscription_cancellation-date' => $membershipCancellationDate,
                $brand . '_membership_subscription_cancellation-reason' => $membershipCancellationReason,
                $brand . '_membership_subscription_latest-start-date' => $latestSubscriptionStartedDate,
                $brand . '_membership_subscription_first-start-date' => $firstSubscriptionStartedDate,
                $brand . '_membership_subscription_trial-type' => $trialType,
                $brand . '_user_payment_primary-method-expiration-date' => $expirationDate,
                $brand . '_membership_subscription_source_app-store' => $isAppSignup,
            ];

            if ($isAppSignup) {
                $subscriptionAttributes[$brand . '_membership_trial_type'] = '7_days_free';
            }

            // if the subscription due date is passed by more than a day, or its cancelled or suspended, but the user
            // still has access to the membership, they are considered in 'escrow'
            // todo: build, it should change the _membership_status attribute if they are in escrow
        }

        return $subscriptionAttributes;
    }

    /**
     * This returns an array of 2 strings:
     * ['BRAND_owned_pack_product_skus' => 'string', 'BRAND_owned_pack_product_ids' => 'string']
     *
     * The first string is a list of all the users owned pack skus separated by ', '
     * The first string is a list of all the users owned pack ids separated by ', '
     * each entry is also surrounded by underscores
     *
     * Ex: _electrify-your-drumming_, _rock-drumming-masterclass-pack_, _LDS-DIGI_
     * Ex: _523_, _9_, _3774_
     *
     * @param User $user
     * @param array $brands
     * @return array
     */
    public function getUsersProductOwnershipStrings(User $user, array $brands = [])
    {
        if (empty($brands)) {
            $brands = config('event-data-synchronizer.customer_io_brands_to_sync');
        }

        $userProducts = $this->userProductRepository->getAllUsersProducts($user->id);

        $finalArray = [];

        foreach ($brands as $brand) {
            $productSkuArray = [];
            $idArray = [];

            foreach ($userProducts as $userProduct) {
                if ($userProduct->getProduct()->getBrand() !== $brand) {
                    continue;
                }

                if ($userProduct->getProduct()->isDigitalProduct() && $userProduct->isValid()) {
                    $productSkuArray[] = "_" . $userProduct->getProduct()->getSku() . "_";
                    $idArray[] = "_" . $userProduct->getProduct()->getId() . "_";
                }
            }

            if (!empty($productSkuArray)) {
                $finalArray[$brand . '_owned_pack_product_skus'] = implode(', ', $productSkuArray);
            }

            if (!empty($idArray)) {
                $finalArray[$brand . '_owned_pack_product_ids'] = implode(', ', $idArray);
            }
        }

        return $finalArray;
    }

    private function isEligibleMembershipProduct(?string $brand, ?Product $product): bool
    {
        return !empty($product)
            && $product->getBrand() == $brand
            && $product->isMembershipProduct();
    }

}
