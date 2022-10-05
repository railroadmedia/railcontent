<?php

use App\Modules\Content\Controllers\MusoraCenterContentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web_authenticated'])
    ->group(
        function () {
            Route::get('/{brand}/content/{contentId}', ['uses' => MusoraCenterContentController::class . '@showPreview']);
        }
    );


