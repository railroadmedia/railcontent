<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;

class SubscriptionService
{
    public function getFirstSubscriptionBrand(int $userId, array $brands)
    : string {
        $result =
            Subscription::query()
                ->whereIn('brand', $brands)
                ->fromUser($userId)
                ->orderBy('created_at')
                ->first('brand');

        return $result['brand'] ?? '';
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

        if ($unsubscribeDate) {
            $musoraSubscription->canceled_on = Carbon::createFromTimestampMs($unsubscribeDate);
            $musoraSubscription->cancellation_reason = $cancelReason;
        } else {
            $musoraSubscription->total_cycles_paid = $musoraSubscription->total_cycles_paid + 1;
        }

        $musoraSubscription->save();

        return $musoraSubscription;
    }
}
