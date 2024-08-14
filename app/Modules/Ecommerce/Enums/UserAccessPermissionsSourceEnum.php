<?php

namespace App\Modules\Ecommerce\Enums;

enum UserAccessPermissionsSourceEnum: string
{
    case Manual = 'manual';
    case Web = 'web';
    case AccessCode = 'access-code';
    case Challenges = 'challenges';
    case Apple = 'apple';
    case Google = 'google';
    case Migration = 'migration';
}
