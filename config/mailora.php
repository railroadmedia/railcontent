<?php

return [
    // REQUIRED
    'safety-recipient' => env('MAILORA_SAFETY_RECIPIENT', 'musora-dev-test-5632c3@inbox.mailtrap.io'),

    // required to make "public" route work
    'approved-recipients' => [],
    'approved-recipient-domains' => ['drumeo.com', 'singeo.com', 'pianote.com', 'guitareo.com', 'musora.com'],

    // required to make "authentication-protected" route work
    'route_middleware_public_groups' => ['web_or_api_public'],
    'route_middleware_logged_in_groups' => ['web_or_api_authenticated'],

    // 1. Advanced, see documentation for details
    'views-root-directory' => 'resources/platform/views',
    'views-email-directory' => 'emails',
    'mailables-namespace' => '\\App\\Mail\\',
    'name-of-production-env' => env('MAILORA_NAME_OF_PROD_ENV', 'production'),
    'public-free-for-all' => env('MAILORA_PUBLIC_FREE_FOR_ALL', false),
    'admin' => env('MAILORA_DEFAULT_ADMIN', null),

    // 2. Some required, some optional...
    'defaults' => [
        // 2.0 REQUIRED (either hardcoded here, or provided by environmental variables)
        // 3.0 - we are setting the defaults directly from the config for each brand; we might not need these parameters later; to be checked and deleted if not needed
        'sender-address' => env('MAILORA_DEFAULT_SENDER_ADDRESS', 'support@musora.com'), // REQUIRED
        'sender-name' => env('MAILORA_DEFAULT_SENDER_NAME', 'Musora'), // REQUIRED
        'recipient-address' => env('MAILORA_DEFAULT_RECIPIENT_ADDRESS', 'musora@drumeo.com'), // REQUIRED

        // 2.1 Optional
        'recipient-name' => env('MAILORA_DEFAULT_RECIPIENT_NAME', 'Caleb'),
        'subject' => null,
        'message' => null,

        // 2.3 Advanced, see documentation for details
        'type' => env('MAILORA_DEFAULT_TYPE', null),
        'users-email-set-reply-to' => true,
    ],

    'drumeo' => [
        'support-email-address' => 'support@drumeo.com',
        'support-sender-name' => 'Drumeo',
        'submit-student-focus-recipient' => 'support@drumeo.com',
        'ask-question-recipient' => 'support+question-and-answer@drumeo.com',
        'logo-link' => 'https://dmmior4id2ysr.cloudfront.net/logos/drumeo-logo.png',
        'report-comment-recipient' => 'support@musora.com',
        'report-user-recipient' => 'support@musora.com',
    ],

    'pianote' => [
        'support-email-address' => 'support@pianote.com',
        'support-sender-name' => 'Pianote System',
        'submit-student-focus-recipient' => 'team+studentreviews@pianote.com',
        'ask-question-recipient' => 'team+question-and-answer@pianote.com',
        'logo-link' => 'https://dmmior4id2ysr.cloudfront.net/logos/pianote-logo-red.png',
        'report-comment-recipient' => 'support@musora.com',
        'report-user-recipient' => 'support@musora.com',
    ],

    'guitareo' => [
        'support-email-address' => 'support@guitareo.com',
        'support-sender-name' => 'Guitareo System',
        'submit-student-focus-recipient' => 'support@guitareo.com',
        'ask-question-recipient' => 'support@guitareo.com',
        'logo-link' => 'https://dmmior4id2ysr.cloudfront.net/logos/guitareo-logo.png',
        'report-comment-recipient' => 'support@musora.com',
        'report-user-recipient' => 'support@musora.com',
    ],

    'singeo' => [
        'support-email-address' => 'support@singeo.com',
        'support-sender-name' => 'Singeo System',
        'submit-student-focus-recipient' => 'support@singeo.com',
        'ask-question-recipient' => 'team+question-and-answer@singeo.com',
        'logo-link' => 'https://dmmior4id2ysr.cloudfront.net/logos/singeo-logo-purple.png',
        'report-comment-recipient' => 'support@musora.com',
        'report-user-recipient' => 'support@musora.com',
    ]

];
