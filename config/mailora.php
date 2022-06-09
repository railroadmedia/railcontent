<?php

return [
    // REQUIRED
    'safety-recipient' => env('MAILORA_SAFETY_RECIPIENT', 'musora-dev-test-5632c3@inbox.mailtrap.io'),

    // required to make "public" route work
    'approved-recipients' => [],
    'approved-recipient-domains' => ['drumeo.com', 'pianote.com', 'musora.com'],

    // required to make "authentication-protected" route work
    'route_middleware_public_groups' => ['web_public'],
    'route_middleware_logged_in_groups' => ['web_authenticated'],

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
        'sender-address' => env('MAILORA_DEFAULT_SENDER_ADDRESS', 'support@drumeo.com'), // REQUIRED
        'sender-name' => env('MAILORA_DEFAULT_SENDER_NAME', 'Drumeo'), // REQUIRED
        'recipient-address' => env('MAILORA_DEFAULT_RECIPIENT_ADDRESS', 'support@drumeo.com'), // REQUIRED

        // 2.1 Optional
        'recipient-name' => env('MAILORA_DEFAULT_RECIPIENT_NAME', 'Caleb'),
        'subject' => null,
        'message' => null,

        // 2.3 Advanced, see documentation for details
        'type' => env('MAILORA_DEFAULT_TYPE', null),
        'users-email-set-reply-to' => true,
    ],

    'submit_student_focus_recipient' => [
        'drumeo' => 'support@drumeo.com',
        'pianote' => 'team+studentreviews@pianote.com',
        'guitareo' => 'team+studentreviews@guitareo.com',
        'singeo' => 'team+studentreviews@singeo.com'
    ],
];
