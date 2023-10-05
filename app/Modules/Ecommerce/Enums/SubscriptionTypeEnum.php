<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Based on shopify order statuses
 */
enum SubscriptionTypeEnum: int
{
    case None = 0;
    case Recharge = 1;
    case Apple = 2;
    case Google = 3;

    /**
     * @param string $store
     * @return SubscriptionTypeEnum
     */
    public static function fromRevenueCatStore(string $store)
    : SubscriptionTypeEnum {
        return match ($store) {
            'apple' => SubscriptionTypeEnum::Apple,
            'google' => SubscriptionTypeEnum::Google,
            default => SubscriptionTypeEnum::None
        };
    }

    /**
     * @param SubscriptionTypeEnum $type
     * @return string
     */
    public static function toCustomerIOAttribute(SubscriptionTypeEnum $type)
    : string {
        return match ($type) {
            SubscriptionTypeEnum::None, SubscriptionTypeEnum::Recharge => '',
            SubscriptionTypeEnum::Apple => 'apple_subscription',
            SubscriptionTypeEnum::Google => 'google_subscription'
        };
    }
}
