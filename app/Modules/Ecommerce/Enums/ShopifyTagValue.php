<?php

namespace App\Modules\Ecommerce\Enums;

use Railroad\Ecommerce\Entities\Payment;

enum ShopifyTagValue: string
{
    case PaymentSource_Apple = 'apple-app';
    case PaymentSource_Google = 'google-app';
    case PaymentSource_Web = 'web-app';

    /**
     * Get the tag value enum to use for the given payment
     *
     * @param  Payment  $payment
     * @return self
     */
    public static function getForPayment(Payment $payment): self
    {
        return match ($payment->getType()) {
            Payment::TYPE_APPLE_SUBSCRIPTION_RENEWAL => self::PaymentSource_Apple,
            Payment::TYPE_GOOGLE_SUBSCRIPTION_RENEWAL => self::PaymentSource_Google,
            default => self::PaymentSource_Web,
        };
    }
}
