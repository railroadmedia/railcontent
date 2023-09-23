<?php

namespace App\Http;

use App\Http\Middleware\DynamicWebOrAppMiddlewareGroupsAuthenticated;
use App\Http\Middleware\DynamicWebOrAppMiddlewareGroupsPublic;
use App\Http\Middleware\ExpiredMemberRedirect;
use App\Http\Middleware\RedirectIfMobileRequest;
use App\Modules\UserManagementSystem\Middleware\AuthenticatedAdmin;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Railroad\EventDataSynchronizer\Middleware\UserActivitySyncMiddleware;
use Railroad\LeadTracker\Middleware\LeadTrackerMiddleware;
use Railroad\MusoraApi\Middleware\BrandMiddleware;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\SessionDomains::class,
        \App\Http\Middleware\LegacyBrandCartURLRedirects::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web_public' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Modules\UserManagementSystem\Middleware\AuthenticateViaKeyIfAvailable::class,
            \Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class,
            \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
            \Railroad\Railtracker\Middleware\RailtrackerMiddleware::class,
            \App\Http\Middleware\SetContentPermissions::class,
            RedirectIfMobileRequest::class,
            LeadTrackerMiddleware::class,
        ],

        'web_authenticated' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Modules\UserManagementSystem\Middleware\AuthenticateViaKeyIfAvailable::class,
            \Modules\UserManagementSystem\Middleware\AuthenticatedOnly::class,
            \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
            \Railroad\Railtracker\Middleware\RailtrackerMiddleware::class,
            \App\Http\Middleware\SetContentPermissions::class,
            RedirectIfMobileRequest::class,
            LeadTrackerMiddleware::class,
            \App\Modules\EventDataSynchronizer\Middleware\UserActivitySyncMiddleware::class,
        ],

        'web_member_only' => [
            ExpiredMemberRedirect::class,
        ],

        'api_public' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class,
            \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
            \Railroad\Railtracker\Middleware\RailtrackerMiddleware::class,
            \App\Http\Middleware\SetContentPermissions::class,
        ],

        'api_authenticated' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Modules\UserManagementSystem\Middleware\AuthenticatedOnly::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
            \Railroad\Railtracker\Middleware\RailtrackerMiddleware::class,
            \App\Http\Middleware\SetContentPermissions::class,
            BrandMiddleware::class,
        ],

        // Do not add more middleware to these 2 without good reason!
        'web_or_api_public' => [
            DynamicWebOrAppMiddlewareGroupsPublic::class,
        ],

        'web_or_api_authenticated' => [
            DynamicWebOrAppMiddlewareGroupsAuthenticated::class,
        ],

        'web_authenticated_admin' => [
            AuthenticatedAdmin::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'cors' => \App\Http\Middleware\Cors::class,
    ];
}
