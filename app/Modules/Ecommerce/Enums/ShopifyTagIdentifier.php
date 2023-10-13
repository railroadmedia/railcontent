<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Values used as identifiers in Shopify's tags string.
 * e.g. "payment_source:web_app"
 */
enum ShopifyTagIdentifier: string
{
    case PaymentSource = 'payment_source';
}
