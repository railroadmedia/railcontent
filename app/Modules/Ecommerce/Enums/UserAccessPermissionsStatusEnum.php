<?php

namespace App\Modules\Ecommerce\Enums;

enum UserAccessPermissionsStatusEnum: string
{
    case Active = 'active';
    case Revoked = 'revoked';
}
