<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\Payment;
use Carbon\Carbon;
use App\Modules\Ecommerce\Models\SubscriptionPayment;

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
        $subscription,
        $type,
        $purchasedAt,
        $transactionId
    ) {
        $payment = Payment::where('external_id', $transactionId)
            ->where('external_provider', $type)->first();
        if (!$payment) {
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

    public function getTotalPaid(Order|SubscriptionPayment $model): float
    {
        $payments = $model instanceof Order ? $model->payments->filter(fn (Payment $payment) => $payment->status == Payment::STATUS_PAID) : collect([$model->payment]);

        $total = 0.0;
        $payments->each(function (Payment $payment) use (&$total) {
            $total += match ($payment->external_provider) {
                Payment::EXTERNAL_PROVIDER_STRIPE => $this->getPaymentAmountForStripe($payment),
                Payment::EXTERNAL_PROVIDER_PAYPAL => $this->getPaymentAmountForPayPal($payment),
                Payment::EXTERNAL_PROVIDER_APPLE => $this->getPaymentAmountForApple($payment),
                Payment::EXTERNAL_PROVIDER_GOOGLE => $this->getPaymentAmountForGoogle($payment),
                default => $this->getPaymentAmountForOther($payment)
            };
        });

        return $total;
    }

    private function getPaymentAmountForStripe(Payment $payment): float
    {
        // safety check for external provider
        // @codeCoverageIgnoreStart
        if ($payment->external_provider !== Payment::EXTERNAL_PROVIDER_STRIPE) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        // TODO connect to stripe and get the value
        return 0.0;
    }

    private function getPaymentAmountForPayPal(Payment $payment): float
    {
        // safety check for external provider
        // @codeCoverageIgnoreStart
        if ($payment->external_provider !== Payment::EXTERNAL_PROVIDER_PAYPAL) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        // TODO connect to PayPal and get the value
        return 0.0;
    }

    private function getPaymentAmountForApple(Payment $payment): float
    {
        // safety check for external provider
        // @codeCoverageIgnoreStart
        if ($payment->external_provider !== Payment::EXTERNAL_PROVIDER_APPLE) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        // TODO connect to Apple and get the value
        return 0.0;
    }

    private function getPaymentAmountForGoogle(Payment $payment): float
    {
        // safety check for external provider
        // @codeCoverageIgnoreStart
        if ($payment->external_provider !== Payment::EXTERNAL_PROVIDER_GOOGLE) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        // TODO connect to Google and get the value
        return 0.0;
    }

    /**
     * Get the payment amount for a payment that doesn't use an external service.
     *
     * @param  Payment  $payment
     * @return float the float value of the payment in USD
     */
    private function getPaymentAmountForOther(Payment $payment): float
    {
        // safety check for external provider
        // @codeCoverageIgnoreStart
        if (in_array(
            $payment->external_provider,
            [
                Payment::EXTERNAL_PROVIDER_STRIPE,
                Payment::EXTERNAL_PROVIDER_PAYPAL,
                Payment::EXTERNAL_PROVIDER_APPLE,
                Payment::EXTERNAL_PROVIDER_GOOGLE
            ]
        )) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        return floatval($payment->total_paid);
    }
}
