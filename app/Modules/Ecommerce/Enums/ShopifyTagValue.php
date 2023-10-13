<?php

namespace App\Modules\Ecommerce\Enums;

use Illuminate\Support\Str;
use Railroad\Ecommerce\Entities\Payment;

enum ShopifyTagValue: string
{
    case PaymentSource_Apple = 'apple-app';
    case PaymentSource_Google = 'google-app';
    case PaymentSource_Web = 'web-app';

    public const SEPARATOR = ":";

    /**
     * Build a tag string for the given value, and identifier if given
     *
     * @param  ShopifyTagIdentifier|null  $identifier
     * @param  ShopifyTagValue  $value
     * @return string
     */
    public static function buildTag(?ShopifyTagIdentifier $identifier, ShopifyTagValue $value): string
    {
        if (is_null($identifier)) {
            return $value->value;
        }
        return $identifier->value.':'.$value->value;
    }

    /**
     * Get the value or enum for the given identifier, from the given string of tags
     *
     * @param  string  $tagsString
     * @param  ShopifyTagIdentifier  $identifier
     * @param  bool  $asEnum
     * @return ShopifyTagValue|string|null
     */
    public static function getValueFromTags(
        string $tagsString,
        ShopifyTagIdentifier $identifier,
        bool $asEnum = false
    ): ShopifyTagValue|string|null {
        // Shopify uses tags a comma-separated string
        $tags = collect(explode(",", $tagsString));
        $matches = $tags->filter(fn($tag) => Str::startsWith($tag, $identifier->value));
        if ($matches->isEmpty()) {
            return null;
        }
        $value = Str::after($matches->first(), self::SEPARATOR);
        return $asEnum ? self::from($value) : $value;
    }

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
