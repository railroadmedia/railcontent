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
        $payment = Payment::where('external_id', $transactionId)
            ->where('external_provider', $type)->first();
        if(!$payment) {
            $payment = new Payment();
            $payment->total_due = $subscription->total_price;
            $payment->total_paid = $subscription->total_price;
            $payment->type =
                ($type == 'apple') ? Payment::TYPE_APPLE_SUBSCRIPTION_RENEWAL :
                    Payment::TYPE_GOOGLE_SUBSCRIPTION_RENEWAL;

            $payment->gateway_name = $subscription->product->brand;
            $payment->status = Payment::STATUS_PAID;
            $payment->external_id = $transactionId;
            $payment->external_provider = $type;
            $payment->created_at = Carbon::createFromTimestampMs($purchasedAt);
            $payment->currency = 'USD';

            $payment->save();

            $subscription->total_cycles_paid = $subscription->total_cycles_paid + 1;
            $subscription->save();
        }

        $subscriptionPayment = new SubscriptionPayment();
        $subscriptionPayment->payment_id = $payment->id;
        $subscriptionPayment->subscription_id = $subscription->id;
        $subscriptionPayment->save();

        return $payment;
    }


}
