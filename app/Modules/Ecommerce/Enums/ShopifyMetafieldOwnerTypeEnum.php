<?php

namespace App\Modules\Ecommerce\Enums;

enum ShopifyMetafieldOwnerTypeEnum: string
{
    case Customer = 'CUSTOMER';
    case Order = 'ORDER';
    case Product = 'PRODUCT';
    case ProductVariant = 'PRODUCTVARIANT';
}
