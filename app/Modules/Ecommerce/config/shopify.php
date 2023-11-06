<?php

return [
    'enabled' => ENV('SHOPIFY_ENABLED', false),
    'apiKey' => ENV('SHOPIFY_APP_API_KEY'),
    'apiSecretKey' => ENV('SHOPIFY_APP_API_SECRET'),
    'hostName' => ENV('SHOPIFY_APP_HOST_NAME'),
    'privateAppStorefrontAccessToken' => ENV('SHOPIFY_APP_STOREFRONT_ACCESS_TOKEN'),
    'privateAppAdminAccessToken' => ENV('SHOPIFY_APP_ADMIN_API_ACCESS_TOKEN'),
    'apiVersion' => ENV('SHOPIFY_APP_API_VERSION'),
    'scopes' => 'unauthenticated_write_checkouts, unauthenticated_read_checkouts, unauthenticated_write_customers, unauthenticated_read_customers, unauthenticated_read_customer_tags, unauthenticated_read_metaobjects, unauthenticated_read_product_listings, unauthenticated_read_product_inventory, unauthenticated_read_product_pickup_locations, unauthenticated_read_product_tags, unauthenticated_read_selling_plans, unauthenticated_write_bulk_operations, unauthenticated_read_bulk_operations, unauthenticated_write_gates, unauthenticated_read_gates, unauthenticated_read_content',
    'accountCreationSecretKey' => 'musora_shopify_claim_key_68769727349672736',
    'multipassSecretKey' => ENV('SHOPIFY_MULTIPASS_SECRET_KEY'),
    'rechargeStoreFrontAccessToken' => ENV('RECHARGE_STOREFRONT_ACCESS_TOKEN'),
];
