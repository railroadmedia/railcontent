<?php

namespace App\Modules\Ecommerce\Enums;

enum DigitalAccessType: string
{
    case Plus = 'all content access';
    case Basic = 'basic content access';
    case Specific = 'specific content access';
    case Challenge = 'challenge content access';
    case Songs = 'songs content access';
}
