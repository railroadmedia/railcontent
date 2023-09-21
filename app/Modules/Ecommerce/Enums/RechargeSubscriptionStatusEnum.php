<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Based on shopify order statuses
 */
enum RechargeSubscriptionStatusEnum: string
{
    case Active = 'active';
    case Cancelled = 'cancelled';
    case Expired = 'expired';
}
