<?php

use App\Http\Controllers\Misc\MobileAppStoreAPIKeyFilesController;

Route::get(
    'drumeo-google-play-api.json',
    MobileAppStoreAPIKeyFilesController::class . '@drumeoGooglePlayAPIJSONFile'
);

Route::get(
    'pianote-google-play-api.json',
    MobileAppStoreAPIKeyFilesController::class . '@pianoteGooglePlayAPIJSONFile'
);
