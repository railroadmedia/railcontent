<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Based on shopify order statuses
 */
enum UserAccessPermissionsSourceEnum: string
{
    case Manual = 'manual';
    case Shopify = 'shopify';
    case AccessCode = 'access-code';
    case Challenges = 'challenges';
    case RevenueCat = 'revenue-cat';
}
