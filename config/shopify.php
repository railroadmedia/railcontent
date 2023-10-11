<?php

return [

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
    ]
];
