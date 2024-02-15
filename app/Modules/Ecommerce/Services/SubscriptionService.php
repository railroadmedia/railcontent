<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\RechargeSubscriptionStatusEnum;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\UserManagementSystem\Services\UserService;
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

    public function getFirstSubscriptionBrand(int $userId, array $brands): string
    {
        $result = Subscription::query()
            ->whereIn('brand', $brands)
            ->fromUser($userId)
            ->orderBy('created_at')
            ->first('brand');
        return $result['brand'] ?? '';
    }

    public function syncSubscriptionData(UserAccessPermissionsCollection $userAccessPermissions)
    {
        $user = $this->userService->getByIdOrNull($userAccessPermissions->getUserId());
        if (!$user->shopify_id) {
            // User doesn't have any subscriptions from Shopify to be synced.
            return null;
        }
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
            /** @var \App\Modules\Ecommerce\Models\Recharge\Subscription $subscription */
            $product = $productLookup[$subscription->sku] ?? $productIdsLookup[$subscription->shopifyVariantId] ?? null;
            if (!$product) {
                Log::warning(
                    "Product $subscription->sku $subscription->shopifyVariantId not found for recharge subscription $subscription->id"
                );
                return;
            }
            $subscription->setProduct($product);
        });

        $membershipSubscriptions = $subscriptions->filter(function ($subscription) {
            /** @var \App\Modules\Ecommerce\Models\Recharge\Subscription $subscription */
            return $subscription->product?->isRecurringMembershipProduct() ?? false;
        });

        $activeMembershipSubscriptions = $membershipSubscriptions->filter(function ($subscription) {
            /** @var \App\Modules\Ecommerce\Models\Recharge\Subscription $subscription */
            return $subscription->status == RechargeSubscriptionStatusEnum::Active->value;
        });

        $isLifetimeMember = $userAccessPermissions->getIsLifetimeMember();

        $mostRecentActiveSubscription = $activeMembershipSubscriptions->sortByDesc('createdAt')->first();
        /** @var \App\Modules\Ecommerce\Models\Recharge\Subscription $mostRecentActiveSubscription */
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
        } else {
            $user->has_recharge_subscription = false;
            $user->recharge_renewal_date = null;
        }
        $user->save();
        return $membershipSubscriptions;
    }

    /**
     * @param $userId
     * @param $expiresDate
     * @param $musoraProduct
     * @param string $type
     * @param $purchasedAtMs
     * @param null $unsubscribeAtMs
     * @return Subscription
     */
    public function createSubscription(
        $userId,
        $expiresDate,
        $musoraProduct,
        string $type,
        $purchasedAtMs,
        $unsubscribeAtMs = null
    ) {
        $musoraSubscription = new Subscription();
        $musoraSubscription->user_id = $userId;
        $musoraSubscription->is_active = Carbon::createFromTimestampMs($expiresDate) > Carbon::now();
        $musoraSubscription->paid_until = Carbon::createFromTimestampMs($expiresDate);
        $musoraSubscription->apple_expiration_date = Carbon::createFromTimestampMs($expiresDate);
        $musoraSubscription->product_id = $musoraProduct->id;
        $musoraSubscription->brand = $musoraProduct->brand;
        $musoraSubscription->type = $type . '_subscription';
        $musoraSubscription->start_date = Carbon::createFromTimestampMs($purchasedAtMs);
        $musoraSubscription->created_at = Carbon::now();
        $musoraSubscription->total_cycles_paid = 1;
        $musoraSubscription->stopped = false;
        $musoraSubscription->renewal_attempt = 0;
        $musoraSubscription->total_price = $musoraProduct->price;
        $musoraSubscription->canceled_on = null;
        $musoraSubscription->currency = config('ecommerce.default_currency');
        $musoraSubscription->interval_type = $musoraProduct->subscription_interval_type;
        $musoraSubscription->interval_count = $musoraProduct->subscription_interval_count;

        if ($unsubscribeAtMs) {
            $musoraSubscription->canceled_on = Carbon::createFromTimestampMs($unsubscribeAtMs);
        }
        $musoraSubscription->save();

        return $musoraSubscription;
    }

    /**
     * @param Subscription $musoraSubscription
     * @param $expiresDate
     * @param null $unsubscribeDate
     * @param null $cancelReason
     * @return Subscription
     */
    public function updateSubscription(
        Subscription $musoraSubscription,
        $expiresDate,
        $unsubscribeDate = null,
        $cancelReason = null
    ) {
        $musoraSubscription->is_active = Carbon::createFromTimestampMs($expiresDate) > Carbon::now();
        $musoraSubscription->paid_until = Carbon::createFromTimestampMs($expiresDate);
        $musoraSubscription->apple_expiration_date = Carbon::createFromTimestampMs($expiresDate);

        $musoraSubscription->canceled_on = null;
        $musoraSubscription->cancellation_reason = null;

        if ($unsubscribeDate || $cancelReason) {
            $musoraSubscription->canceled_on = ($unsubscribeDate) ? Carbon::createFromTimestampMs(
                $unsubscribeDate
            ) : null;
            $musoraSubscription->cancellation_reason = $cancelReason;
        }

        $musoraSubscription->save();

        return $musoraSubscription;
    }

    public function cancelAllSubscriptions(User $user, string $reason): void
    {
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
    }
}
