<?php

use Illuminate\Support\Facades\Route;

require('platform/home.php');

Route::domain('{subdomain}.musora.com')->group(function () {
    Route::get('/', function () {
        return 'Musora sales route!';
    });
});
