<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Based on shopify order statuses
 */
enum RechargeSubscriptionStatusEnum: string
{
    case Active = 'ACTIVE';
    case Cancelled = 'CANCELLED';
    case Expired = 'EXPIRED';
}
