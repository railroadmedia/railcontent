<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.s
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'mentors/*', 'ecommerce/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        '*.musora.com:*',
        '*.drumeo.com:*',
        '*.pianote.com:*',
        '*.guitareo.com:*',
        '*.singeo.com:*',
        '*.musora.com',
        '*.drumeo.com',
        '*.pianote.com',
        '*.guitareo.com',
        '*.singeo.com'
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
