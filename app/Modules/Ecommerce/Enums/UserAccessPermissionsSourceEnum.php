<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Based on shopify order statuses
 */
enum UserAccessPermissionsSourceEnum: string
{
    case manual = 'manual';
    case shopify = 'shopify';
}
