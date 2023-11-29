<?php

namespace App\Modules\Ecommerce\Enums;

/**
 * Namespace used for Shopify Metafield entries, acting as a container for a group of metafields and preventing
 * conflicts with other metafields with the same key.
 * NOTE: the namespace must be at least 3 characters long.
 */
enum ShopifyMetafieldNamespace: string
{
    // Musora namespace houses our extra attributes
    case Musora = 'Musora';
    // Model_ namespace is used for model-specific values, which could be in other metafields, such as ID
    case Model_Orders = 'orders';
    case Model_Products = 'products';
    case Model_SubscriptionPayments = 'subscription_payments';
    case Model_Users = 'users';
}
