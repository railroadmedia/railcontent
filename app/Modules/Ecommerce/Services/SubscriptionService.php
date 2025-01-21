<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\RechargeSubscriptionStatusEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Recharge\Subscription;
use App\Modules\UserManagementSystem\Services\UserService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

class SubscriptionService
{
    private ProductService $productService;
    private RechargeGateway $recharge;
    private UserService $userService;

    public function __construct(
        ProductService $productService,
        RechargeGateway $recharge,
        UserService $userService
    ) {
        $this->productService = $productService;
        $this->recharge = $recharge;
        $this->userService = $userService;
    }

    /**
     * @throws \Exception
     */
    public function getActiveSubscription(User $user): ?Subscription
    {
        $subscriptions = $this->getSubscriptions($user);

        $membershipSubscriptions = $subscriptions->filter(function ($subscription) {
            /** @var Subscription $subscription */
            return $subscription->product?->isRecurringMembershipProduct() ?? false;
        });

        $activeMembershipSubscriptions = $membershipSubscriptions->filter(function ($subscription) {
            /** @var Subscription $subscription */
            return $subscription->status == RechargeSubscriptionStatusEnum::Active->value;
        });

        $mostRecentActiveSubscription = $activeMembershipSubscriptions->sortByDesc('createdAt')->first();
        return $mostRecentActiveSubscription;
    }

    public function updateSubscriptionProduct(Subscription $subscription, Product $product)
    {
        $this->recharge->updateSubscriptionProduct($subscription, $product);
    }

    private function getSubscriptions(User $user): Collection
    {
        $subscriptions = $this->recharge->getSubscriptions($user->shopify_id);
        $subscriptionSkus = $subscriptions->pluck('sku')->toArray();
        $productLookup = $this->productService->getProductsBySkus($subscriptionSkus)
            ->keyBy('sku');

        //migrated recharge subscriptions do not have sku, so we need to get them by shopify variant id
        //keep sku lookup around to make testing simpler
        $shopifyVariantIds = $subscriptions->pluck('shopifyVariantId')->toArray();
        $productIdsLookup = $this->productService->getProductsByShopifyIds($shopifyVariantIds)
            ->keyBy('shopify_id');

        $subscriptions->each(function ($subscription) use ($productLookup, $productIdsLookup) {
            /** @var Product $product */
            /** @var Subscription $subscription */
            $product = $productLookup[$subscription->sku] ?? $productIdsLookup[$subscription->shopifyVariantId] ?? null;
            if (!$product) {
                Log::warning(
                    "Product $subscription->sku $subscription->shopifyVariantId not found for recharge subscription $subscription->id"
                );
                return;
            }
            $subscription->setProduct($product);
        });
        return $subscriptions;
    }

    public function syncSubscriptionData(UserAccessPermissionsCollection $userAccessPermissions)
    {
        $user = $this->userService->getByIdOrNull($userAccessPermissions->getUserId());
        if (!$user->shopify_id) {
            // User doesn't have any subscriptions from Shopify to be synced.
            return null;
        }
        $subscriptions = $this->getSubscriptions($user);

        $membershipSubscriptions = $subscriptions->filter(function ($subscription) {
            /** @var Subscription $subscription */
            return $subscription->product?->isRecurringMembershipProduct() ?? false;
        });

        $activeMembershipSubscriptions = $membershipSubscriptions->filter(function ($subscription) {
            /** @var Subscription $subscription */
            return $subscription->status == RechargeSubscriptionStatusEnum::Active->value;
        });

        $isLifetimeMember = $userAccessPermissions->getIsLifetimeMember();

        $mostRecentActiveSubscription = $activeMembershipSubscriptions->sortByDesc('createdAt')->first();
        /** @var Subscription $mostRecentActiveSubscription */
        if ($isLifetimeMember) {
            foreach ($activeMembershipSubscriptions as $activeMembershipSubscription) {
                $this->recharge->cancelSubscription($activeMembershipSubscription, 'Lifetime Member');
            }
        } elseif ($mostRecentActiveSubscription) {
            if ($activeMembershipSubscriptions->count() > 1) {
                foreach ($activeMembershipSubscriptions as $activeMembershipSubscription) {
                    if ($activeMembershipSubscription->id != $mostRecentActiveSubscription->id) {
                        $this->recharge->cancelSubscription($activeMembershipSubscription, 'Duplicate Subscription');
                    }
                }
            }
            $membershipExpirationDate = $userAccessPermissions->getMembershipExpirationDate(
                includeBuffer: false,
                ignoreSources: [UserAccessPermissionsSourceEnum::Challenges->value]
            )?->startOfDay() ?? null;
            // BR-1243: safety check for null nextChargeScheduledAt
            if (is_null($mostRecentActiveSubscription->nextChargeScheduledAt)) {
                $diff = 0;
                Log::debug('BR-1243: null nextChargeScheduledAt: ' . json_encode($mostRecentActiveSubscription));
            } else {
                $diff = abs(
                    $mostRecentActiveSubscription->nextChargeScheduledAt->startOfDay()->diffInDays(
                        $membershipExpirationDate
                    )
                );
            }
            if ($membershipExpirationDate
                && $diff > 1
                && $membershipExpirationDate > Carbon::today()
                //never move recharge dates backwards could be a paused subscription
                && $membershipExpirationDate > $mostRecentActiveSubscription->nextChargeScheduledAt->startOfDay()) {
                Log::info(
                    "Updating subscription next charge date for user $user->id from $mostRecentActiveSubscription->nextChargeScheduledAt to $membershipExpirationDate"
                );
                $this->recharge->updateSubscriptionNextChargeDate(
                    $mostRecentActiveSubscription,
                    $membershipExpirationDate
                );
                $mostRecentActiveSubscription->nextChargeScheduledAt = $membershipExpirationDate;
            }
        }

        // SRR-82 set the subscription type when the user has a Recharge subscription
        if (!$isLifetimeMember && $mostRecentActiveSubscription) {
            $user->has_recharge_subscription = true;
            $user->recharge_renewal_date = $mostRecentActiveSubscription->nextChargeScheduledAt;
            $user->recharge_interval = $mostRecentActiveSubscription->product?->digital_access_time_interval_type;
        } else {
            $user->has_recharge_subscription = false;
            $user->recharge_renewal_date = null;
            $user->recharge_interval = null;
        }
        $user->save();
        return $membershipSubscriptions;
    }

    public function createTestSubscription(User $user, Product $product, Carbon $nextChargeScheduledAt)
    {
        $this->recharge->createTestSubscription($user, $product, $nextChargeScheduledAt);
    }

    public function cancelAllSubscriptions(User $user, string $reason): void
    {
        if ($user->shopify_id) {
            try {
                $subscriptions = $this->recharge->getSubscriptions($user->shopify_id);
                $subscriptions->each(function ($subscription) use ($reason) {
                    if ($subscription->status == RechargeSubscriptionStatusEnum::Active->value) {
                        $this->recharge->cancelSubscription($subscription, $reason);
                    }
                });
            } catch (\Exception $e) {
                Log::error("Failed to cancel subscriptions for user $user->id");
                Log::error($e);
            }
        } else {
            Log::info("No shopify_id for user $user->id. Subscriptions cannot be cancelled.");
        }
    }
}
