<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Based on shopify order statuses
 */
enum UserAccessPermissionsStatusEnum: string
{
    case active = 'active';
    case revoked = 'revoked';
}
