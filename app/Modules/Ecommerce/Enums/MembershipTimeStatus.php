<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Based on shopify order statuses
 */
enum MembershipTimeStatus: string
{
    case Open = 'open';
    case Cancelled = 'cancelled';
    case Archived = 'archived';
}
