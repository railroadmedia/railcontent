<?php

namespace App\Modules\Ecommerce\Enums;

enum SubscriptionIntervalType: string
{
    case Unknown = 'unknown';
    case Month = 'month';
    case Year = 'year';
}
