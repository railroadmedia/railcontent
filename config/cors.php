<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'mentors/*', 'ecommerce/*', 'user-management-system/*'],

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
        '*.singeo.com',
        'cdn.shopify.com',
        '*',
    ],

    'supports_credentials' => true,

];
