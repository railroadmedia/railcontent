<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
 * Domain patterns for usage in routes. This allows routes to accept any subdomain OR no subdomain for a given domain.
 */
Route::pattern('musoraDomain', '(.*musora\.com)');
Route::pattern('drumeoDomain', '(.*drumeo\.com)');
Route::pattern('pianoteDomain', '(.*pianote\.com)');
Route::pattern('guitareoDomain', '(.*guitareo\.com)');
Route::pattern('singeoDomain', '(.*singeo\.com)');

URL::defaults(['musoraDomain' => 'musora.com']);
URL::defaults(['drumeoDomain' => 'drumeo.com']);
URL::defaults(['pianoteDomain' => 'pianote.com']);
URL::defaults(['guitareoDomain' => 'guitareo.com']);
URL::defaults(['singeoDomain' => 'singeo.com']);

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
require_once('platform/platform_pages_routes.php');
