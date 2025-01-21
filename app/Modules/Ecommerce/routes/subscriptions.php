<?php

use App\Modules\Ecommerce\Controllers\MembershipUpgradeController;
use App\Modules\Ecommerce\Controllers\SubscriptionUpgradeController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('ecommerce.route_prefix'))->middleware(config('ecommerce.route_middleware_logged_in_groups'))->group(function () {
    Route::get(
        '/{brand}/v2/songs-upgrade',
        [MembershipUpgradeController::class, 'index']
    )->name('platform.songs-upgrade');

    Route::post('/subscription/upgrade', SubscriptionUpgradeController::class . '@upgrade')
        ->name('subscription.upgrade');
});
