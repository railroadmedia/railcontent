<?php

use Illuminate\Support\Facades\Route;

/*
 * Domain patterns for usage in routes. This allows routes to accept any subdomain OR no subdomain for a given domain.
 */
Route::pattern('musoraDomain', '(.*musora\.com)');
Route::pattern('drumeoDomain', '(.*drumeo\.com)');
Route::pattern('pianoteDomain', '(.*pianote\.com)');
Route::pattern('guitareoDomain', '(.*guitareo\.com)');
Route::pattern('singeoDomain', '(.*singeo\.com)');

/*
 * Public Routes
 */
require_once('musora/routes.php');
require_once('drumeo/routes.php');
require_once('pianote/routes.php');
require_once('singeo/routes.php');
require_once('guitareo/routes.php');

/*
 * Platform Routes
 */
require_once('platform/primary_pages_routes.php');
