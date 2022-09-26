<?php

use App\Http\Controllers\Misc\HTTPErrorCodeRoutes;

//Route fallback - when no route is matched
Route::fallback([HTTPErrorCodeRoutes::class, 'notFound404'])
    ->middleware(['web_public']);