<?php

namespace App\Modules\Ecommerce\Enums;

enum MembershipLevel: string
{
    case None = "";
    case Basic = "basic";
    case Plus = "plus";
}
