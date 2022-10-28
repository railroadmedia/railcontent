<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pianote\AccessCodeRedeemController;

Route::domain('{pianoteDomain}')->group(function () {
    Route::get('/redeem', [AccessCodeRedeemController::class, 'showRedeemPageForNewUsers']);

    Route::get('/redeem/existing', [AccessCodeRedeemController::class, 'showRedeemPageForExistingUsers']);
});
