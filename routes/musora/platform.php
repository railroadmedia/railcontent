<?php

use Illuminate\Support\Facades\Route;

Route::domain('{subdomain}.musora.com')->group(function () {
    Route::get('/', function () {
        return 'Musora only route!';
    });
});
