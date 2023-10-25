<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\RechargeSubscriptionStatusEnum;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\UserManagementSystem\Services\UserService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SubscriptionService
{

    private UserAccessPermissionsService $userAccessPermissionsService;
    private ProductService $productService;
    private RechargeGateway $recharge;
    private UserService $userService;

    public function __construct(
        UserAccessPermissionsService $userAccessPermissionsService,
        ProductService $productService,
        RechargeGateway $recharge,
        UserService $userService
    ) {
        $this->userAccessPermissionsService = $userAccessPermissionsService;
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

    public function syncSubscriptionData(UserAccessPermissionsCollection $userAccessPermissions): void
    {
        $user = $this->userService->getByIdOrNull($userAccessPermissions->getUserId());
        if (!$user->shopify_id) {
            // User doesn't have any subscriptions from Shopify to be synced.
            return;
        }
        $subscriptions = $this->recharge->getSubscriptions($user->shopify_id);
        $shopifyVariantIds = $subscriptions->pluck('shopify_variant_id')->toArray();
        $productLookup = $this->productService->getProductsByShopifyIds($shopifyVariantIds)
            ->keyBy('shopify_id');

        $membershipSubscriptions = $subscriptions->filter(function ($subscription) use ($productLookup) {
            $product = $productLookup[$subscription->shopify_variant_id] ?? null;
            if (!$product) {
                Log::error("Product not found for recharge subscription $subscription->id");
                return false;
            }
            return $product->isMembershipProduct() && $subscription->status == RechargeSubscriptionStatusEnum::Active;
        });

        $isLifetimeMember = $userAccessPermissions->getIsLifetimeMember();

        if ($isLifetimeMember) {
            foreach ($membershipSubscriptions as $membershipSubscription) {
                $this->recharge->cancelSubscription($membershipSubscription, 'Lifetime Member');
            }
        } elseif ($membershipSubscriptions->count() > 1) {
            $mostRecentSubscription = $subscriptions->sortByDesc('created_at')->first();

            foreach ($membershipSubscriptions as $membershipSubscription) {
                if ($membershipSubscription->id != $mostRecentSubscription->id) {
                    $this->recharge->cancelSubscription($membershipSubscription, 'Duplicate Subscription');
                }
            }

            $membershipExpirationDate = $userAccessPermissions->getMembershipExpirationDate();

            $this->recharge->updateSubscriptionNextChargeDate($mostRecentSubscription, $membershipExpirationDate);
        }

        // SRR-82 set the subscription type when the user has a Recharge subscription
        if (!$isLifetimeMember && $membershipSubscriptions->count() > 0) {
            $user->has_recharge_subscription = true;
            $user->save();
        } else {
            $user->has_recharge_subscription = false;
            $user->save();
        }
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
        $musoraSubscription->type = $type.'_subscription';
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
            $musoraSubscription->canceled_on = ($unsubscribeDate)?Carbon::createFromTimestampMs($unsubscribeDate):null;
            $musoraSubscription->cancellation_reason = $cancelReason;
        }

        $musoraSubscription->save();

        return $musoraSubscription;
    }
}
