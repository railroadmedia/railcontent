<?php

return [

    'enabled' => ENV('SHOPIFY_ENABLED', false),

    'credentials' => [

        /*
         * The API access token from the private app.
         */
        'access_token' => env('SHOPIFY_ACCESS_TOKEN', ''),

        /*
         * The shopify domain for your shop.
         */
        'domain' => env('SHOPIFY_DOMAIN', ''),

        /*
         * The shopify api version.
         */
        'api_version' => env('SHOPIFY_API_VERSION', '2021-01'),

    ],

    'webhooks' => [

        /*
         * The webhook secret provider to use.
         */
        'secret_provider' => \Signifly\Shopify\Webhooks\ConfigSecretProvider::class,

        /*
         * The shopify webhook secret.
         */
        'secret' => env('SHOPIFY_WEBHOOK_SECRET'),

    ],

    'exceptions' => [

        /*
         * Whether to include the validation errors in the exception message.
         */
        'include_validation_errors' => env('SHOPIFY_INCLUDE_VALIDATION_ERRORS', false),

    ],

    'rate_limit' => [
        /*
         * How close to the rate limit we'll allow until we sleep, to recover some requests.
         */
        'threshold' => env('SHOPIFY_RATE_LIMIT_THRESHOLD', 100),

        /*
         * The number of seconds to sleep for, when we hit the rate limit threshold.
         */
        'sleep_time' => env('SHOPIFY_RATE_LIMIT_SLEEP_TIME', 1),
    ],

    'rate_limit_gql' => [
        'threshold_percentage' => env('SHOPIFY_RATE_LIMIT_GRAPH_QL_THRESHOLD_PERCENTAGE', 50),
        'sleep_time' => env('SHOPIFY_RATE_LIMIT_GRAPH_QL_SLEEP_TIME', 1),
    ],

    'recharge' => [
        'access_token' => env('RECHARGE_ACCESS_TOKEN', ''),
        'storefront_access_token' => ENV('RECHARGE_STOREFRONT_ACCESS_TOKEN'),
    ],

    /*
     * Settings for the private app created from the Shopify store admin area to connect to the storefront
     */
    'storefront' => [
        'api_key' => env('SHOPIFY_APP_API_KEY'),
        'api_secret_key' => env('SHOPIFY_APP_API_SECRET'),
        'host_name' => env('SHOPIFY_APP_HOST_NAME'),
        'access_token' => env('SHOPIFY_APP_STOREFRONT_ACCESS_TOKEN'),
        'admin_access_token' => env('SHOPIFY_APP_ADMIN_API_ACCESS_TOKEN'),
        'api_version' => env('SHOPIFY_APP_API_VERSION'),
        'scopes' => 'unauthenticated_write_checkouts, unauthenticated_read_checkouts, unauthenticated_write_customers, unauthenticated_read_customers, unauthenticated_read_customer_tags, unauthenticated_read_metaobjects, unauthenticated_read_product_listings, unauthenticated_read_product_inventory, unauthenticated_read_product_pickup_locations, unauthenticated_read_product_tags, unauthenticated_read_selling_plans, unauthenticated_write_bulk_operations, unauthenticated_read_bulk_operations, unauthenticated_write_gates, unauthenticated_read_gates, unauthenticated_read_content',
    ],

    /*
     * Settings for the Shopify multipass, allowing user login to be shared between Shopify and MWP
     */
    'multipass' => [
        'secret_key' => env('SHOPIFY_MULTIPASS_SECRET_KEY'),

        /*
         * key used in combination with the user's email address to create an md5 hash when creating an account
         */
        'account_creation_secret_key' => 'musora_shopify_claim_key_68769727349672736',
    ],

    'discount_codes' => [
        'free_with_annual' => 'FREE-W-ANNUAL-6702',
    ]
];
