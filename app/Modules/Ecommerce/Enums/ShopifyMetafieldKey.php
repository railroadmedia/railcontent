<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Keys used for Shopify Metafield entries.
 * NOTE: the key must be at least 3 characters long.
 */
enum ShopifyMetafieldKey: string
{
    case Id = '_id'; // the internal ID in our db
    case IsMusoraAccountSetUp = 'is_musora_account_set_up';
    case Brand = 'brand';
    case PaymentSource = 'payment_source';
}
