<?php

return [
    // database
    'database_connection_name' => 'musora_laravel_mysql',
    'data_mode' => 'host',
    'development_mode' => env('APP_DEBUG', true),

    // unique user validation database info
    'database_info_for_unique_user_email_validation' => [
        'database_connection_name' => 'musora_laravel_mysql',
        'table' => 'usora_users',
        'email_column' => 'email',
        'phone_number_column' => 'phone_number',
    ],

    'password_creation_rules' => 'confirmed|min:8|max:128',

    'route_prefix' => 'referral',
    'route_middleware_public_groups' => ['web_or_api_public'],
    'route_middleware_logged_in_groups' => ['web_or_api_authenticated'],

    'email_invite_redirect_route' => 'platform.home',
    'claim_redirect_route' => 'platform.home',

    'referrals_per_user' => 5,

    'saasquatch_api_key' => env('SAASQUATCH_API_KEY', 'TEST_HHxOG6K0aWBwLVFXiQOippYPDo6jxXIC'),
    'saasquatch_tenant_alias' => env('SAASQUATCH_TENANT_ALIAS', 'test_aqv1e8qhpmnxs'),
    'saasquatch_referral_program_id' => [
        'drumeo' => env('SAASQUATCH_CURRENT_PROGRAM_ID_DRUMEO', 'drumeo-web-staging-three'),
        'pianote' => env('SAASQUATCH_CURRENT_PROGRAM_ID_PIANOTE', 'pianote-web-staging-three'),
        'guitareo' => env('SAASQUATCH_CURRENT_PROGRAM_ID_GUITAREO', 'guitareo-web-staging-three'),
        'singeo' => env('SAASQUATCH_CURRENT_PROGRAM_ID_SINGEO', 'singeo-web-staging-three'),
    ],

    'messages' => [
        'email_invite_success' => 'Your invitation was emailed successfully!',
        'email_invite_fail' => 'Maximum referrals reached.',
    ],

    // once claimed, this product is assigned to the claiming user for the amount of days
    'referral_program_product_sku' => 'drumeo_access_30-days',
    'referral_program_product_free_days' => 30,

    // google reCaptcha, use this in form validation
    'recaptcha_site_secret' => '6LfwMZ4dAAAAALEGLsEUwAqrJLLnec_sSbl72Oqx',
];
