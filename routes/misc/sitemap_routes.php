<?php

use App\Http\Controllers\Misc\SiteMapController;

Route::middleware(['web_public'])
    ->group(function () {
        Route::get(
            '/sitemap.xml',
            SiteMapController::class . '@sitemap'
        );
    });
