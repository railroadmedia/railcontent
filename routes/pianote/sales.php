<?php

use Illuminate\Support\Facades\Route;

Route::domain('{subdomain}.pianote.com')->group(function () {
    Route::get('/', function () {
        return 'Pianote only route!';
    });
});
