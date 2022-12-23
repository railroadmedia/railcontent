<?php

// legacy brand domain redirects
Route::domain('{drumeoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::any(
            'members/{segment1?}/{segment2?}/{segment3?}/{segment4?}/{segment5?}/{segment6?}/{segment7?}/{segment8?}',
            \App\Http\Controllers\Misc\RedirectLegacyMembersURLsToUPController::class . '@redirectDrumeo'
        );
    });
Route::domain('{pianoteDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::any(
            'members/{segment1?}/{segment2?}/{segment3?}/{segment4?}/{segment5?}/{segment6?}/{segment7?}/{segment8?}',
            \App\Http\Controllers\Misc\RedirectLegacyMembersURLsToUPController::class . '@redirectPianote'
        );
    });

Route::domain('{guitareoDomain}')
    ->middleware(['web_public'])
    ->group(function () {
        Route::any(
            'members/{segment1?}/{segment2?}/{segment3?}/{segment4?}/{segment5?}/{segment6?}/{segment7?}/{segment8?}',
            \App\Http\Controllers\Misc\RedirectLegacyMembersURLsToUPController::class . '@redirectGuitareo'
        );
    });
