<?php

use Illuminate\Support\Facades\Route;

Route::domain('{subdomain}.singeo.com')->group(function () {
    Route::get('/', function () {
        return 'Singeo only route!';
    });
});
