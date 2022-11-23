<?php

return [
    'development_mode' => env('APP_DEBUG', true),

    // brands
    'brand' => 'musora',
    'available_brands' => ['drumeo', 'pianote', 'guitareo', 'singeo', 'musora'],

    // database
    'database_connection_name' => env('USER_MANAGEMENT_SYSTEM_DATABASE_CONNECTION_NAME','musora_laravel_mysql_writer_only'),
    'database_name' => env('DB_MUSORA_LARAVEL_MYSQL_DATABASE_NAME'),
    'database_user' => env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME'),
    'database_password' => env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD'),
    'database_host' => env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST'),
    'database_driver' => env('DB_MYSQL_DRIVER', 'pdo_mysql'),
    'database_in_memory' => env('DB_MYSQL_IN_MEMORY', false),
    'enable_query_log' => false,

    // unique user validation database info
    'database_info_for_unique_user_email_validation' => [
        'database_connection_name' => env('DB_DEFAULT_CONNECTION_NAME','musora_laravel_mysql'),
        'table' => 'usora_users',
        'email_column' => 'email',
    ],

    // host does the db migrations, clients do not
    'data_mode' => 'host', // 'host' or 'client'

    // cache
    'redis_host' => env('REDIS_HOST', 'redis'),
    'redis_port' => env('REDIS_PORT', 6379),

    // entities
    'entities' => [
        [
            'path' => __DIR__ . '/../src/Entities',
            'namespace' => 'Railroad\Ecommerce\Entities',
        ],
    ],

    // routes
    'route_prefix' => 'ecommerce',
    'autoload_all_routes' => true,
    'route_middleware_public_groups' => ['web_or_api_public'],
    'route_middleware_logged_in_groups' => ['web_or_api_authenticated'],
    'route_middleware_mobile_app_receipt_validation_groups' => ['api_public'],

    // post purchase redirect
    'post_purchase_redirect_digital_items' => '/members',
    'post_purchase_redirect_customer_order' => '/laravel/public/order-complete/thank-you',

    // tax config
    'country_province_codes' => [
        'canada' => [
            'ab' => 'Alberta',
            'bc' => 'British Columbia',
            'mb' => 'Manitoba',
            'nb' => 'New Brunswick',
            'nl' => 'Newfoundland and Labrador',
            'nt' => 'Northwest Territories',
            'ns' => 'Nova Scotia',
            'nu' => 'Nunavut',
            'on' => 'Ontario',
            'pe' => 'Prince Edward Island',
            'pei' => 'Prince Edward Island',
            'qc' => 'Quebec',
            'sk' => 'Saskatchewan',
            'yt' => 'Yukon',
        ],
    ],

    'tax_rates_and_options' => [
        'canada' => [
            'alberta' => [
                [
                    'type' => 'GST',
                    'rate' => 0.05,
                    'applies_to_shipping_costs' => true,
                ],
            ],
            'british columbia' => [
                [
                    'type' => 'GST',
                    'rate' => 0.05,
                    'applies_to_shipping_costs' => true,
                ],
                [
                    'type' => 'PST',
                    'rate' => 0.07,
                    'applies_to_shipping_costs' => false,
                ],
            ],
            'manitoba' => [
                [
                    'type' => 'GST',
                    'rate' => 0.05,
                    'applies_to_shipping_costs' => true,
                ],
                // PST does not apply until a sales threshold is hit for this province
                //                [
                //                    'type' => 'PST',
                //                    'rate' => 0.07,
                //                    'applies_to_shipping_costs' => false,
                //                ],
            ],
            'new brunswick' => [
                [
                    'type' => 'HST',
                    'rate' => 0.15,
                    'applies_to_shipping_costs' => true,
                ],
            ],
            'newfoundland and labrador' => [
                [
                    'type' => 'HST',
                    'rate' => 0.15,
                    'applies_to_shipping_costs' => true,
                ],
            ],
            'northwest territories' => [
                [
                    'type' => 'GST',
                    'rate' => 0.05,
                    'applies_to_shipping_costs' => true,
                ],
            ],
            'nova scotia' => [
                [
                    'type' => 'HST',
                    'rate' => 0.15,
                    'applies_to_shipping_costs' => true,
                ],
            ],
            'nunavut' => [
                [
                    'type' => 'GST',
                    'rate' => 0.05,
                    'applies_to_shipping_costs' => true,
                ],
            ],
            'ontario' => [
                [
                    'type' => 'HST',
                    'rate' => 0.13,
                    'applies_to_shipping_costs' => true,
                ],
            ],
            'prince edward island' => [
                [
                    'type' => 'HST',
                    'rate' => 0.15,
                    'applies_to_shipping_costs' => true,
                ],
            ],
            'quebec' => [
                [
                    'type' => 'GST',
                    'rate' => 0.05,
                    'applies_to_shipping_costs' => true,
                ],
                // QST does not apply until a sales threshold is hit for this province
                [
                    'type' => 'QST',
                    'rate' => 0.09975,
                    'applies_to_shipping_costs' => false,
                ],
            ],
            'saskatchewan' => [
                [
                    'type' => 'GST',
                    'rate' => 0.05,
                    'applies_to_shipping_costs' => true,
                ],
                // PST does not apply until a sales threshold is hit for this province
                //                [
                //                    'type' => 'PST',
                //                    'rate' => 0.07,
                //                    'applies_to_shipping_costs' => false,
                //                ],
            ],
            'yukon' => [
                [
                    'type' => 'GST',
                    'rate' => 0.05,
                    'applies_to_shipping_costs' => true,
                ],
            ],
        ],
    ],

    'recommended_products_count' => 3,

    'recommended_products' => [
        'drumeo' => [
            //            [
            //                'sku' => 'DLM-Trial-1-month',
            //                'product_page_url' => '/trial/',
            //                'name_override' => 'Drumeo Edge 7-Day Trial',
            //                'excluded_skus' => [
            //                    'DLM-1-month',
            //                    'DLM-1-year',
            //                    'DLM-Trial-1-month',
            //                    'DLM-6-month',
            //                    'DLM-teachers-1-year',
            //                    'DLM-teachers-upgrade-1-month',
            //                    'DLM-teachers-upgrade-1-year',
            //                    'DLM-3-month',
            //                    'DLM-UPSELL-2-month',
            //                    'DLM-Trial-Best-Book-1-month',
            //                    'edge-membership-6-months',
            //                    'DLM-Trial-Drummers-Toolbox-1-month',
            //                    'DLM-Lifetime',
            //                    'drumeo_edge_30_days_access',
            //                    'DLM-Trial-30-Day',
            //                ],
            //                'cta' => '7 Days Free, Then $29/mo',
            //            ],
            [
                'sku' => 'quietpad',
                'product_page_url' => '/drumshop/quietpad/',
            ],
            [
                'sku' => 'Drumeo-VaterSticks',
                'product_page_url' => '/drumshop/drumsticks/',
            ],
            [
                'sku' => 'the-drummers-toolbox-book',
                'product_page_url' => '/drumshop/the-drummers-toolbox/',
            ],
            [
                'sku' => 'BeginnerBook',
                'product_page_url' => '/drumshop/beginner-book/',
            ],
            [
                'sku' => 'tone-control-kit',
                'product_page_url' => '/drumshop/tone-control-kit/',
            ],
        ],
    ],

    // currencies
    'supported_currencies' => [
        'USD',
    ],

    // changing the default currency can have massive consequences
    'default_currency' => 'USD',
    'default_currency_conversion_rates' => [
        'USD' => 1.0,
    ],

    // payment plans
    'financing_cost_per_order' => 1,
    'payment_plan_options' => [1, 2, 5],
    'payment_plan_minimum_price_with_physical_items' => 250,
    'payment_plan_minimum_price_without_physical_items' => 10,

    // gateways
    'default_gateway' => 'drumeo',
    'payment_gateways' => [
        'paypal' => [
            'drumeo' => [
                'paypal_api_username' => env('DRUMEO_PAYPAL_API_USERNAME'),
                'paypal_api_password' => env('DRUMEO_PAYPAL_API_PASSWORD'),
                'paypal_api_signature' => env('DRUMEO_PAYPAL_API_SIGNATURE'),
                'paypal_api_currency_code' => env('DRUMEO_PAYPAL_API_CURRENCY_CODE'),
                'paypal_api_version' => env('DRUMEO_PAYPAL_API_VERSION'),
                'paypal_api_nvp_curl_url' => env('DRUMEO_PAYPAL_API_NVP_CURL_URL'),
                'paypal_api_checkout_return_route' => 'order-form.submit-paypal',
                'paypal_api_checkout_redirect_url' => env('DRUMEO_PAYPAL_API_CHECKOUT_REDIRECT_URL'),
                'paypal_api_checkout_return_url' => env('DRUMEO_PAYPAL_API_CHECKOUT_RETURN_URL'),
                'paypal_api_checkout_cancel_url' => env('DRUMEO_PAYPAL_API_CHECKOUT_CANCEL_URL'),
                'paypal_api_test_billing_agreement_id' => '',
            ],
            'pianote' => [
                'paypal_api_username' => env('PIANOTE_PAYPAL_API_USERNAME'),
                'paypal_api_password' => env('PIANOTE_PAYPAL_API_PASSWORD'),
                'paypal_api_signature' => env('PIANOTE_PAYPAL_API_SIGNATURE'),
                'paypal_api_currency_code' => env('PIANOTE_PAYPAL_API_CURRENCY_CODE'),
                'paypal_api_version' => env('PIANOTE_PAYPAL_API_VERSION'),
                'paypal_api_nvp_curl_url' => env('PIANOTE_PAYPAL_API_NVP_CURL_URL'),
                'paypal_api_checkout_return_route' => 'order-form.submit-paypal',
                'paypal_api_checkout_redirect_url' => env('PIANOTE_PAYPAL_API_CHECKOUT_REDIRECT_URL'),
                'paypal_api_checkout_return_url' => env('PIANOTE_PAYPAL_API_CHECKOUT_RETURN_URL'),
                'paypal_api_checkout_cancel_url' => env('PIANOTE_PAYPAL_API_CHECKOUT_CANCEL_URL'),
                'paypal_api_test_billing_agreement_id' => '',
            ],
            'guitareo' => [
                'paypal_api_username' => env('GUITAREO_PAYPAL_API_USERNAME'),
                'paypal_api_password' => env('GUITAREO_PAYPAL_API_PASSWORD'),
                'paypal_api_signature' => env('GUITAREO_PAYPAL_API_SIGNATURE'),
                'paypal_api_currency_code' => env('GUITAREO_PAYPAL_API_CURRENCY_CODE'),
                'paypal_api_version' => env('GUITAREO_PAYPAL_API_VERSION'),
                'paypal_api_nvp_curl_url' => env('GUITAREO_PAYPAL_API_NVP_CURL_URL'),
                'paypal_api_checkout_return_route' => 'order-form.submit-paypal',
                'paypal_api_checkout_redirect_url' => env('GUITAREO_PAYPAL_API_CHECKOUT_REDIRECT_URL'),
                'paypal_api_checkout_return_url' => env('GUITAREO_PAYPAL_API_CHECKOUT_RETURN_URL'),
                'paypal_api_checkout_cancel_url' => env('GUITAREO_PAYPAL_API_CHECKOUT_CANCEL_URL'),
                'paypal_api_test_billing_agreement_id' => '',
            ],
            'singeo' => [
                'paypal_api_username' => env('SINGEO_PAYPAL_API_USERNAME'),
                'paypal_api_password' => env('SINGEO_PAYPAL_API_PASSWORD'),
                'paypal_api_signature' => env('SINGEO_PAYPAL_API_SIGNATURE'),
                'paypal_api_currency_code' => env('SINGEO_PAYPAL_API_CURRENCY_CODE'),
                'paypal_api_version' => env('SINGEO_PAYPAL_API_VERSION'),
                'paypal_api_nvp_curl_url' => env('SINGEO_PAYPAL_API_NVP_CURL_URL'),
                'paypal_api_checkout_return_route' => 'order-form.submit-paypal',
                'paypal_api_checkout_redirect_url' => env('SINGEO_PAYPAL_API_CHECKOUT_REDIRECT_URL'),
                'paypal_api_checkout_return_url' => env('SINGEO_PAYPAL_API_CHECKOUT_RETURN_URL'),
                'paypal_api_checkout_cancel_url' => env('SINGEO_PAYPAL_API_CHECKOUT_CANCEL_URL'),
                'paypal_api_test_billing_agreement_id' => '',
            ],
        ],

        'stripe' => [
            'drumeo' => [
                'stripe_api_secret' => env('DRUMEO_STRIPE_API_SECRET'),
                'stripe_publishable_key' => env('DRUMEO_STRIPE_PUBLISHABLE_KEY'),
            ],
            'pianote' => [
                'stripe_api_secret' => env('PIANOTE_STRIPE_API_SECRET'),
                'stripe_publishable_key' => env('PIANOTE_STRIPE_PUBLISHABLE_KEY'),
            ],
            'guitareo' => [
                'stripe_api_secret' => env('GUITAREO_STRIPE_API_SECRET'),
                'stripe_publishable_key' => env('GUITAREO_STRIPE_PUBLISHABLE_KEY'),
            ],
            'singeo' => [
                'stripe_api_secret' => env('SINGEO_STRIPE_API_SECRET'),
                'stripe_publishable_key' => env('SINGEO_STRIPE_PUBLISHABLE_KEY'),
            ],
        ],

        'apple_store_kit' => [
            'endpoint' => env('APPLE_VERIFY_RECEIPT_ENDPOINT', 'https://sandbox.itunes.apple.com'),
            'shared_secret' => env('APPLE_STORE_KIT_SHARED_SECRET'),
        ],

        'google_play_store' => [
            'credentials' =>  __DIR__ . '/../google-play-api.json',
            'application_name' => 'com.musoraapp',
            'scope' => ['https://www.googleapis.com/auth/androidpublisher'],
        ],
    ],

    'apple_store_products_map' => [

        // live products
        'drumeo_app_1_year_member' => 'DLM-1-year',
        'drumeo_app_monthly_member' => 'DLM-1-month',

        //2021 products
        'drumeo_app_1_year_2021' => 'DLM-1-year',
        'drumeo_app_1_month_2021' => 'DLM-1-month',

        'anatomy_of_a_drum_solo' => 'AOADS-DIGI',
        'beyond_the_chops' => 'BTC-DIGI',
        'creative_control' => 'CC-DIGI',
        'drum_technique_made_easy_pack' => 'drum-technique-made-easy-pack',
        'drumming_system_2' => 'DSYS2-DIGI',
        'great_hands_for_a_lifetime' => 'GHFAL-DIGI',
        'hands_grooves_fills' => 'HGAF-DIGI',
        'in_constant_motion' => 'ICM-DIGI',
        'independence_made_easy_pack' => 'independence-made-easy-pack',
        'methods_mechanics' => 'MAM-DIGI',
        'rock_drumming_masterclass_pack' => 'rock-drumming-masterclass',
        'successful_drumming' => 'SD-DIGI',
        'the_grid_a_system_for_creative_drumming_and_improvisation' => 'TG-DIGI',
        'the_language_of_drumming' => 'TLOD-DIGI',
        '4_weeks_to_better_drum_fills' => 'four-weeks-to-better-drum-fills',
        'electrify_your_drumming' => 'electrify-your-drumming',
        'new_drummers_start_here' => 'new-drummers-start-here',

        // test products
        'pack' => 'CC-DIGI',
        'test' => '1-YEAR-MEMBERSHIP',
        'test_6month' => '6-MONTH-MEMBERSHIP',

        //musora products
        'musora_app_monthly_member' => 'DLM-1-month',
        'musora_app_1_year_member' => 'DLM-1-year',
    ],

    'google_store_products_map' => [

        // live products
        'drumeo_app_1_year_member' => 'DLM-1-year',
        'drumeo_app_1_month_member' => 'DLM-1-month',

        //2021 products
        'drumeo_app_1_year_2021' => 'DLM-1-year',
        'drumeo_app_1_month_2021' => 'DLM-1-month',

        'anatomy_of_a_drum_solo' => 'AOADS-DIGI',
        'beyond_the_chops' => 'BTC-DIGI',
        'creative_control' => 'CC-DIGI',
        'drum_technique_made_easy_pack' => 'drum-technique-made-easy-pack',
        'drumming_system_2' => 'DSYS2-DIGI',
        'great_hands_for_a_lifetime' => 'GHFAL-DIGI',
        'hands_grooves_fills' => 'HGAF-DIGI',
        'in_constant_motion' => 'ICM-DIGI',
        'independence_made_easy_pack' => 'independence-made-easy-pack',
        'methods_mechanics' => 'MAM-DIGI',
        'rock_drumming_masterclass_pack' => 'rock-drumming-masterclass',
        'successful_drumming' => 'SD-DIGI',
        'the_grid_a_system_for_creative_drumming_and_improvisation' => 'TG-DIGI',
        'the_language_of_drumming' => 'TLOD-DIGI',
        '4_weeks_to_better_drum_fills' => 'four-weeks-to-better-drum-fills',
        'electrify_your_drumming' => 'electrify-your-drumming',
        'new_drummers_start_here' => 'new-drummers-start-here',

        // test products
        '2' => 'DLM-1-year',
        '4' => 'DLM-1-month',
        'pack_1' => 'CC-DIGI',

        //Musora app
        'musora_monthly_subscription' => 'DLM-1-month',
        'musora_annual_subscription' => 'DLM-1-year',
    ],

    // paypal
    'paypal' => [
        'agreement_route' => 'payment-method.paypal.agreement',
        'agreement_fulfilled_path' => '/members/profile/settings/payments',
    ],

    // membership subscription duplicate syncing
    'membership_product_syncing_info' => [
        'drumeo' => [
            'membership_product_skus' => [
                'DLM-1-month',
                'DLM-1-year',
                'DLM-Trial-1-month',
                'DLM-Trial-Annual-30-Day',
                'DLM-Trial-Annual-7-Day',
                'DLM-6-month',
                'DLM-teachers-1-year',
                'DLM-teachers-upgrade-1-month',
                'DLM-teachers-upgrade-1-year',
                'DLM-3-month',
                'DFT-PASS-1_old-1-month',
                'DLM-UPSELL-2-month',
                'DLM-Trial-Best-Book-1-month',
                'DLM-Trial-Drummers-Toolbox-1-month',
                'DLM-Lifetime',
                'DLM-Trial-30-Day',
            ],
        ],
    ],

    // lifetime member product SKUs
    'lifetime_membership_product_skus' => [
        'drumeo' => [
            'DLM-Lifetime',
        ],
    ],

    // memberships number of free days per sku
    // sku => number of free days
    'memberships_number_of_free_days' => [
        'drumeo' => [
            'DLM-Trial-1-month' => 7,
            'DLM-Trial-Annual-30-Day' => 30,
            'DLM-Trial-Annual-7-Day' => 7,
            'DLM-Trial-Best-Book-1-month' => 30,
            'DLM-Trial-Drummers-Toolbox-1-month' => 30,
            'drumeo_edge_30_days_access' => 30,
            'drumeo_access_30-days' => 30,
            'DLM-Trial-30-Day' => 30,
            'drumeo_edge_1_year_access' => 365,
        ],
    ],

    // attempt_number => hours after initial renewal due date
    'subscriptions_renew_cycles' => [
        1 => 8,
        2 => 24 * 3,
        3 => 24 * 7,
//        4 => 24 * 14, // turning off at SX request
    ],

    // the system will not try and renew subscriptions which expired before this date
    // this is for when launching the 2.4 update, since we don't want to re-bill a bunch of old subscriptions on launch
    'subscription_renewal_attempt_system_start_date' => '2020-04-18 00:00:00',

    // permissions
    'role_abilities' => [
        'administrator' => [
            'create.shipping.option',
            'edit.shipping.option',
            'delete.shipping.option',
            'pull.shipping.options',

            'pull.customers',

            'update.payment.method',
            'delete.payment.method',
            'pull.user.payment.method',

            'create.payment',
            'delete.payment',

            'pull.orders',
            'edit.order',
            'delete.order',

            'pull.subscriptions',
            'edit.subscription',
            'delete.subscription',

            'pull.discounts',

            'pull.fulfillments',
            'fulfilled.fulfillment',
            'delete.fulfillment',

            'pull.access_codes',
            'claim.access_codes',
            'release.access_codes',
        ],
    ],

    // invoices config used in user profile / payments page
    'invoice_email_details' => [
        'drumeo' => [
            'subscription_renewal_invoice' => [
                'invoice_sender' => 'support@drumeo.com',
                'invoice_sender_name' => 'Drumeo',
                'invoice_address' => 'Drumeo 107-31265 Wheel Avenue - Abbotsford BC, Canada',
                'invoice_email_subject' => 'Drumeo Invoice - Thank You!',
                'invoice_view' => 'ecommerce::subscription_renewal_invoice',
            ],
            'order_invoice' => [
                'invoice_sender' => 'support@drumeo.com',
                'invoice_sender_name' => 'Drumeo',
                'invoice_address' => 'Drumeo 107-31265 Wheel Avenue - Abbotsford BC, Canada',
                'invoice_email_subject' => 'Drumeo Invoice - Thank You!',
                'invoice_view' => 'ecommerce::order_invoice',
            ],
        ],
        'pianote' => [
            'subscription_renewal_invoice' => [
                'invoice_sender' => 'support@pianote.com',
                'invoice_sender_name' => 'Pianote',
                'invoice_address' => 'Pianote 107-31265 Wheel Avenue - Abbotsford BC, Canada',
                'invoice_email_subject' => 'Pianote Invoice - Thank You!',
                'invoice_view' => 'ecommerce::subscription_renewal_invoice',
            ],
            'order_invoice' => [
                'invoice_sender' => 'support@pianote.com',
                'invoice_sender_name' => 'Pianote',
                'invoice_address' => 'Pianote 107-31265 Wheel Avenue - Abbotsford BC, Canada',
                'invoice_email_subject' => 'Pianote Invoice - Thank You!',
                'invoice_view' => 'ecommerce::order_invoice',
            ],
        ],
        'guitareo' => [
            'subscription_renewal_invoice' => [
                'invoice_sender' => 'support@guitareo.com',
                'invoice_sender_name' => 'Guitareo',
                'invoice_address' => 'Guitareo 107-31265 Wheel Avenue - Abbotsford BC, Canada',
                'invoice_email_subject' => 'Guitareo Invoice - Thank You!',
                'invoice_view' => 'ecommerce::subscription_renewal_invoice',
            ],
            'order_invoice' => [
                'invoice_sender' => 'support@guitareo.com',
                'invoice_sender_name' => 'Guitareo',
                'invoice_address' => 'Guitareo 107-31265 Wheel Avenue - Abbotsford BC, Canada',
                'invoice_email_subject' => 'Guitareo Invoice - Thank You!',
                'invoice_view' => 'ecommerce::order_invoice',
            ],
        ],
        'singeo' => [
            'subscription_renewal_invoice' => [
                'invoice_sender' => 'support@singeo.com',
                'invoice_sender_name' => 'Singeo',
                'invoice_address' => 'Singeo 107-31265 Wheel Avenue - Abbotsford BC, Canada',
                'invoice_email_subject' => 'Singeo Invoice - Thank You!',
                'invoice_view' => 'ecommerce::subscription_renewal_invoice',
            ],
            'order_invoice' => [
                'invoice_sender' => 'support@singeo.com',
                'invoice_sender_name' => 'Singeo',
                'invoice_address' => 'Singeo 107-31265 Wheel Avenue - Abbotsford BC, Canada',
                'invoice_email_subject' => 'Singeo Invoice - Thank You!',
                'invoice_view' => 'ecommerce::order_invoice',
            ],
        ],
    ],

    // this is displayed on all invoices to canadian customers
    'canada_gst_hst_number' => [
        'drumeo' => '81428 3149 RT0001',
        'pianote' => '76853 3879 RT0001',
        'guitareo' => '82759 8434 RT0001',
        'singeo' => '76853 3879 RT0001',
    ],

    'company_name_on_invoice' => [
        'drumeo' => 'Musora Media Inc',
        'pianote' => 'Pianote Media Inc.',
        'guitareo' => 'Guitareo Media Inc.',
        'singeo' => 'Singeo Media Inc.',
    ],

    // constants
    'billing_address' => 'billing',
    'shipping_address' => 'shipping',
    'paypal_payment_method_type' => 'paypal',
    'credit_cart_payment_method_type' => 'credit-card',
    'manual_payment_method_type' => 'manual',
    'order_payment_type' => 'initial_order',
    'renewal_payment_type' => 'subscription_renewal',
    'type_product' => 'product',
    'type_subscription' => 'subscription',
    'type_payment_plan' => 'payment plan',
    'interval_type_daily' => 'day',
    'interval_type_monthly' => 'month',
    'interval_type_yearly' => 'year',
    'fulfillment_status_pending' => 'pending',
    'fulfillment_status_fulfilled' => 'fulfilled',

    'subscription_renewal_date' => 1,
    'failed_payments_before_de_activation' => 1,
    'days_before_access_revoked_after_expiry_in_app_purchases_only' => 0,
    'days_before_access_revoked_after_expiry' => 5,

    'password_creation_rules' => 'min:8|max:128', // also defined in usora

    // todo: centralize this so not duplicated because is copied from \App\Maps\ProductAccessMap::membershipProductIds
    'membership_product_skus' => [
        'drumeo' => [
            'DLM-1-month',
            'DLM-1-year',
            'DLM-Trial-1-month',
            'DLM-Trial-Annual-30-Day',
            'DLM-Trial-Annual-7-Day',
            'DLM-6-month',
            'DLM-teachers-1-year',
            'DLM-teachers-upgrade-1-month',
            'DLM-teachers-upgrade-1-year',
            'DLM-3-month',
            'DLM-UPSELL-2-month',
            'DLM-Trial-Best-Book-1-month',
            'edge-membership-6-months',
            'DLM-Trial-Drummers-Toolbox-1-month',
            'DLM-Lifetime',
            'drumeo_edge_30_days_access',
            'drumeo_access_30-days',
            'DLM-Trial-30-Day',
            'drumeo_edge_1_year_access',
            'drumeo_access_90-days',
        ],
    ],

    // todo: centralize this so not duplicated because is copied from \App\Maps\ProductAccessMap::membershipProductIds
    'membership_product_skus_for_code_redeem' => [
        'DLM-1-month',
        'DLM-1-year',
        'DLM-Trial-1-month',
        'DLM-Trial-Annual-30-Day',
        'DLM-Trial-Annual-7-Day',
        'DLM-6-month',
        'DLM-teachers-1-year',
        'DLM-teachers-upgrade-1-month',
        'DLM-teachers-upgrade-1-year',
        'DLM-3-month',
        'DLM-UPSELL-2-month',
        'DLM-Trial-Best-Book-1-month',
        'edge-membership-6-months',
        'DLM-Trial-Drummers-Toolbox-1-month',
        'DLM-Lifetime',
        'drumeo_edge_30_days_access',
        'drumeo_access_30-days',
        'DLM-Trial-30-Day',
        'drumeo_edge_1_year_access',
        'drumeo_access_90-days',
    ],

    'code_redeem_product_sku_swap' => [
        'DLM-6mo' => 'DLM-6-month',
    ],

    /**
     * Currencies supported by the API.
     *
     * @var array
     */

    'allowable_currencies' => [
        'AED',
        'AFN',
        'ALL',
        'AMD',
        'ANG',
        'AOA',
        'ARS',
        'AUD',
        'AWG',
        'AZN',
        'BAM',
        'BBD',
        'BDT',
        'BGN',
        'BHD',
        'BIF',
        'BMD',
        'BND',
        'BOB',
        'BRL',
        'BSD',
        'BTN',
        'BWP',
        'BYN',
        'BZD',
        'CAD',
        'CDF',
        'CHF',
        'CLP',
        'CNY',
        'COP',
        'CRC',
        'CUC',
        'CUP',
        'CVE',
        'CZK',
        'DJF',
        'DKK',
        'DOP',
        'DZD',
        'EGP',
        'ERN',
        'ETB',
        'EUR',
        'FJD',
        'FKP',
        'FOK',
        'GBP',
        'GEL',
        'GGP',
        'GHS',
        'GIP',
        'GMD',
        'GNF',
        'GTQ',
        'GYD',
        'HKD',
        'HNL',
        'HRK',
        'HTG',
        'HUF',
        'IDR',
        'ILS',
        'IMP',
        'INR',
        'IQD',
        'IRR',
        'ISK',
        'JMD',
        'JOD',
        'JPY',
        'KES',
        'KGS',
        'KHR',
        'KID',
        'KMF',
        'KRW',
        'KWD',
        'KYD',
        'KZT',
        'LAK',
        'LBP',
        'LKR',
        'LRD',
        'LSL',
        'LYD',
        'MAD',
        'MDL',
        'MGA',
        'MKD',
        'MMK',
        'MNT',
        'MOP',
        'MRU',
        'MUR',
        'MVR',
        'MWK',
        'MXN',
        'MYR',
        'MZN',
        'NAD',
        'NGN',
        'NIO',
        'NOK',
        'NPR',
        'NZD',
        'OMR',
        'PAB',
        'PEN',
        'PGK',
        'PHP',
        'PKR',
        'PLN',
        'PYG',
        'QAR',
        'RON',
        'RSD',
        'RUB',
        'RWF',
        'SAR',
        'SBD',
        'SCR',
        'SDG',
        'SEK',
        'SGD',
        'SHP',
        'SLL',
        'SOS',
        'SRD',
        'SSP',
        'STN',
        'SYP',
        'SZL',
        'THB',
        'TJS',
        'TMT',
        'TND',
        'TOP',
        'TRY',
        'TTD',
        'TVD',
        'TWD',
        'TZS',
        'UAH',
        'UGX',
        'USD',
        'UYU',
        'UZS',
        'VES',
        'VND',
        'VUV',
        'WST',
        'XAF',
        'XCD',
        'XDR',
        'XOF',
        'XPF',
        'YER',
        'ZAR',
        'ZMW',
    ],

    // exchangerate-api.com
    'exchange_rate_api_token' => '89916546525703af0b7e1f9a',

    'annual_product_skus' => ['DLM-1-year', 'PIANOTE-MEMBERSHIP-1-YEAR', 'GUITAREO-1-YEAR-MEMBERSHIP', 'singeo-annual-recurring-membership']
];
