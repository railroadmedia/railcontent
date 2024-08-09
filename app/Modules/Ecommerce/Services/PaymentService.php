<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\AppleReceipt;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

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

    /**
     * Get the total amount paid, in USD, for the given Order or Subscription Payment,
     * using the payments' source of truth
     *
     * @param  Order|SubscriptionPayment  $model
     * @return float
     * @throws Exception
     */
    public function getTotalPaid(Order|SubscriptionPayment $model): float
    {
        $payments = $model instanceof Order ? $model->payments->filter(
            fn (Payment $payment) => $payment->status == Payment::STATUS_PAID
        ) : collect([$model->payment]);

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

    /**
     * Get the total USD amount paid for the given payment, that was made with Stripe
     *
     * @param  Payment  $payment
     * @return float
     * @throws Exception
     */
    private function getPaymentAmountForStripe(Payment $payment): float
    {
        // safety check for external provider
        // @codeCoverageIgnoreStart
        if ($payment->external_provider !== Payment::EXTERNAL_PROVIDER_STRIPE) {
            throw new InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        // we recorded the correct amount for Stripe payments, so we can just use that
        return $this->getAsUsd(floatval($payment->total_paid), $payment->currency, $payment->created_at);
    }

    /**
     * @param  float  $amount
     * @param  string  $currency
     * @param  Carbon  $date
     * @return float
     * @throws Exception
     */
    private function getAsUsd(float $amount, string $currency, Carbon $date): float
    {
        $currency = strtoupper($currency);
        // if the currency is already USD, we're done
        if ($currency === 'USD') {
            return $amount;
        }

        return $this->getConvertedCurrencyAmount($amount, $currency, $date, 'USD');
    }

    /**
     * Get the amount of money the given amount was worth in the desired currency, on the given date
     *
     * @throws RequestException
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function getConvertedCurrencyAmount(
        float $amount,
        string $originalCurrencyCode,
        Carbon $date,
        string $desiredCurrencyCode
    ): float {
        $originalCurrencyCode = strtoupper($originalCurrencyCode);
        $desiredCurrencyCode = strtoupper($desiredCurrencyCode);

        if (!$this->isValidCurrencyCode($originalCurrencyCode)) {
            throw new InvalidArgumentException(
                sprintf('%s is not a valid ISO 4217 currency code', $originalCurrencyCode)
            );
        }

        if (!$this->isValidCurrencyCode($desiredCurrencyCode)) {
            throw new InvalidArgumentException(
                sprintf('%s is not a valid ISO 4217 currency code', $desiredCurrencyCode)
            );
        }

        $baseUrl = 'https://v6.exchangerate-api.com/v6/';
        $apiKey = config('ecommerce.exchange_rate_api_token');
        $currency = $originalCurrencyCode;
        $year = $date->year;
        $month = $date->month;
        $day = $date->day;
        $url = sprintf('%s/%s/history/%s/%s/%s/%s/%s', $baseUrl, $apiKey, $currency, $year, $month, $day, $amount);

        $response = Http::get($url);
        $response->throw();

        $results = $response->object();
        if ($results->result !== "success") {
            throw new Exception(json_encode($results, JSON_PRETTY_PRINT));
        }
        $conversions = $results->conversion_amounts;
        if (!property_exists($conversions, $desiredCurrencyCode)) {
            throw new Exception(sprintf('%s is not available for %s', $desiredCurrencyCode, $date->toDateString()));
        }

        return round($conversions->$desiredCurrencyCode, 2);
    }

    /**
     * Check if the current code is a valid ISO 4217 currency code
     *
     * @param  string  $code
     * @return bool
     */
    private function isValidCurrencyCode(string $code): bool
    {
        // valid currency codes supported by exchangerate-api.com
        $codes = config('ecommerce.allowable_currencies');

        return in_array($code, $codes);
    }

    /**
     * Get the total USD amount paid for the given payment, that was made with PayPal
     *
     * @param  Payment  $payment
     * @return float
     * @throws Exception
     */
    private function getPaymentAmountForPayPal(Payment $payment): float
    {
        // safety check for external provider
        // @codeCoverageIgnoreStart
        if ($payment->external_provider !== Payment::EXTERNAL_PROVIDER_PAYPAL) {
            throw new InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        // we recorded the correct amount for PayPal payments, so we can just use that
        return $this->getAsUsd(floatval($payment->total_paid), $payment->currency, $payment->created_at);
    }

    /**
     * Get the total USD amount paid for the given payment, that was made with Apple
     *
     * @param  Payment  $payment
     * @return float
     * @throws Exception
     */
    private function getPaymentAmountForApple(Payment $payment): float
    {
        // safety check for external provider
        // @codeCoverageIgnoreStart
        if ($payment->external_provider !== Payment::EXTERNAL_PROVIDER_APPLE) {
            throw new InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        // grab the Apple receipts for this payment
        $receipts = $payment->appleReceipts()->whereNotNull('local_price')->get();
        $total = 0.0;
        $receipts->each(function (AppleReceipt $appleReceipt) use (&$total) {
            $total += $this->getAsUsd(
                $appleReceipt->local_price,
                $appleReceipt->local_currency,
                $appleReceipt->created_at
            );
        });
        return $total;
    }

    /**
     * Get the total USD amount paid for the given payment, that was made with Google
     *
     * @param  Payment  $payment
     * @return float
     * @throws Exception
     */
    private function getPaymentAmountForGoogle(Payment $payment): float
    {
        // safety check for external provider
        // @codeCoverageIgnoreStart
        if ($payment->external_provider !== Payment::EXTERNAL_PROVIDER_GOOGLE) {
            throw new InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        // grab the Google receipts for this payment
        // DEV NOTE: we're hoping that there should only be one valid payment amount that we would actually report,
        // so just grab the latest valid receipt.
        $googleReceipt = $payment->googleReceipts()
            ->whereNotNull('local_price')
            ->where('valid', 1)
            ->whereNot('notification_type', 'cancel')
            ->orderByDesc('created_at')
            ->first();

        // get the receipt's value in USD
        $total = 0.0;
        if ($googleReceipt) {
            $total = $this->getAsUsd(
                $googleReceipt->local_price,
                $googleReceipt->local_currency,
                $googleReceipt->created_at
            );
        }

        /*
        // DEV NOTE: leaving this in case the hope above is wrong
        // we have some duplicate entries, so make sure to get the unique entries
        $receipts = $receipts->unique(function (GoogleReceipt $googleReceipt) {
            $attributes = $googleReceipt->getAttributes();
            unset($attributes['id']);
            unset($attributes['created_at']);
            unset($attributes['updated_at']);
            return $attributes;
        });

        // go through each receipt and get its value in USD
        $total = 0.0;
        $receipts->each(function (GoogleReceipt $googleReceipt) use (&$total) {
            $total += $this->getAsUsd(
                $googleReceipt->local_price,
                $googleReceipt->local_currency,
                $googleReceipt->created_at
            );
        });
        */
        return $total;
    }

    /**
     * Get the payment amount for a payment that doesn't use an external service.
     *
     * @param  Payment  $payment
     * @return float the float value of the payment in USD
     * @throws Exception
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
            throw new InvalidArgumentException(
                sprintf(
                    'Payment has external_provider of %s. Please use the appropriate function.',
                    $payment->external_provider
                )
            );
        }
        // @codeCoverageIgnoreEnd

        return $this->getAsUsd(floatval($payment->total_paid), $payment->currency, $payment->created_at);
    }

}
