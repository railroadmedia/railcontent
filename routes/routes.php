<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

$subDomain = current(explode('.', request()->getHost()));

/*
 * Domain patterns for usage in routes. This allows routes to accept any subdomain OR no subdomain for a given domain.
 */
Route::pattern('musoraDomain', '(.*musora\.com)');
Route::pattern('drumeoDomain', '(.*drumeo\.com)');
Route::pattern('pianoteDomain', '(.*pianote\.com)');
Route::pattern('guitareoDomain', '(.*guitareo\.com)');
Route::pattern('singeoDomain', '(.*singeo\.com)');

URL::defaults(['musoraDomain' => !empty($subDomain) ? $subDomain . '.musora.com' : 'musora.com']);
URL::defaults(['drumeoDomain' => !empty($subDomain) ? $subDomain . '.drumeo.com' : 'drumeo.com']);
URL::defaults(['pianoteDomain' => !empty($subDomain) ? $subDomain . '.pianote.com' : 'pianote.com']);
URL::defaults(['guitareoDomain' => !empty($subDomain) ? $subDomain . '.guitareo.com' : 'guitareo.com']);
URL::defaults(['singeoDomain' => !empty($subDomain) ? $subDomain . '.singeo.com' : 'singeo.com']);

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
