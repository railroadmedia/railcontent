<?php

namespace App\Modules\Ecommerce\Enums;

enum ShopifyPaymentSourceEnum: string
{
    case Web = 'web';
    case Google = 'google';
    case Apple = 'apple';
}
