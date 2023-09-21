<?php

namespace Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\Payment;
use Carbon\Carbon;
use Modules\Ecommerce\Models\SubscriptionPayment;

class PaymentService
{
    /**
     * @param $subscription
     * @param $type
     * @param $purchasedAt
     * @param $transactionId
     * @return Payment
     */
    public function create(
        $subscription, $type, $purchasedAt, $transactionId
    )
    {
        $payment = new Payment();
        $payment->total_due = $subscription->total_price;
        $payment->total_paid = $subscription->total_price;
        $payment->type = ($type == 'apple') ? Payment::TYPE_APPLE_SUBSCRIPTION_RENEWAL : Payment::TYPE_GOOGLE_SUBSCRIPTION_RENEWAL;
        $payment->external_provider = $type;
        $payment->gateway_name = $subscription->product->brand;
        $payment->status = Payment::STATUS_PAID;
        $payment->external_id = $transactionId;
        $payment->created_at = Carbon::createFromTimestampMs($purchasedAt);
        $payment->currency = 'USD';

        $payment->save();


        $subscriptionPayment = new SubscriptionPayment();
        $subscriptionPayment->payment_id = $payment->id;
        $subscriptionPayment->subscription_id = $subscription->id;
        $subscriptionPayment->save();

        return $payment;
    }


}
