<?php

return [
    // Most of these variables are not necessary as the default from Vapor's
    // core library is okay for most cases but I will leave here you need to use any of them
    'middleware' => 'web_authenticated',

    // if this is false, it breaks all subdomain URLs and redirects them to www.subdomain.musora.com
    // therefore for all non-production environments is must be true, and false for prod since we do want
    // production on www.musora.com
    'redirect_to_root' => env('REDIRECT_TO_ROOT', true),
];
