<?php

use Illuminate\Support\Facades\Route;

Route::domain('{subdomain}.drumeo.com')->group(function () {
    Route::get('/', function () {
        return 'Drumeo only route!';
    });
});
