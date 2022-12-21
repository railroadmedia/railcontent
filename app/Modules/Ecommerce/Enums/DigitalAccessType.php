<?php

namespace App\Modules\Ecommerce\Enums;

enum DigitalAccessType: string
{
    case All = 'all content access';
    case Basic = 'basic content access';
    case Specific = 'specific content access';
}
