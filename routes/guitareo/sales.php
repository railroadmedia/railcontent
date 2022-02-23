<?php

use Illuminate\Support\Facades\Route;

Route::domain('{subdomain}.guitareo.com')->group(function () {
    Route::get('/', function () {
        return 'Guitareo only route!';
    });
});
