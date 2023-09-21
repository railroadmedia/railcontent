<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Based on shopify order statuses
 */
enum UserAccessPermissionsSourceEnum: string
{
    case Manual = 'manual';
    case Shopify = 'shopify';
}
