<?php

use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        // channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo(AppServiceProvider::HOME);

        $middleware->encryptCookies(except: [
        ]);
        $middleware->validateCsrfTokens(except: [
            '/user-management-system/login/token',
            '/user-management-system/login/cookie',
            '/railtracker/media-playback-session',
            '/customer-io/*',
            '*/songs',
            '/ecommerce/access-codes*',
            '/ecommerce/user-access-permission*',
            '/ecommerce/revenuecat/webhook/notification',
            '/ecommerce/shopify/webhook/*',
            '/ecommerce/recharge/webhook/*',
        ]);

        $middleware->append(\App\Http\Middleware\SessionDomains::class);

        $middleware->group('web_public', [
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
            \App\Http\Middleware\RedirectIfMobileRequest::class,
            \Railroad\LeadTracker\Middleware\LeadTrackerMiddleware::class,
            \App\Modules\Ecommerce\Middleware\RedirectLegacyCartRequestsToShopifyControllers::class,
            \App\Http\Middleware\LoggingContextMiddleware::class,
        ]);

        $middleware->group('web_authenticated', [
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
            \App\Http\Middleware\RedirectIfMobileRequest::class,
            \Railroad\LeadTracker\Middleware\LeadTrackerMiddleware::class,
            \App\Modules\EventDataSynchronizer\Middleware\UserActivitySyncMiddleware::class,
            \App\Modules\Ecommerce\Middleware\RedirectLegacyCartRequestsToShopifyControllers::class,
            \App\Http\Middleware\LoggingContextMiddleware::class,
            \Modules\UserManagementSystem\Middleware\LogOutWhenNeeded::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
        ]);

        $middleware->group('web_member_only', [
            \App\Http\Middleware\ExpiredMemberRedirect::class,
        ]);

        $middleware->group('api_public', [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class,
            \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
            \Railroad\Railtracker\Middleware\RailtrackerMiddleware::class,
            \App\Http\Middleware\SetContentPermissions::class,
            \App\Modules\Ecommerce\Middleware\RedirectLegacyCartRequestsToShopifyControllers::class,
            \App\Http\Middleware\LoggingContextMiddleware::class,
        ]);

        $middleware->group('api_authenticated', [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Modules\UserManagementSystem\Middleware\AuthenticatedOnly::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
            \Railroad\Railtracker\Middleware\RailtrackerMiddleware::class,
            \App\Http\Middleware\SetContentPermissions::class,
            \Railroad\MusoraApi\Middleware\BrandMiddleware::class,
            \App\Modules\Ecommerce\Middleware\RedirectLegacyCartRequestsToShopifyControllers::class,
            \App\Http\Middleware\LoggingContextMiddleware::class,
            \Modules\UserManagementSystem\Middleware\LogOutWhenNeeded::class,
        ]);

        $middleware->group('web_or_api_public', [
            \App\Http\Middleware\DynamicWebOrAppMiddlewareGroupsPublic::class,
        ]);

        $middleware->group('web_or_api_authenticated', [
            \App\Http\Middleware\DynamicWebOrAppMiddlewareGroupsAuthenticated::class,
        ]);

        $middleware->group('web_authenticated_admin', [
            \App\Modules\UserManagementSystem\Middleware\AuthenticatedAdmin::class,
        ]);

        $middleware->replace(\Illuminate\Http\Middleware\TrustProxies::class, \App\Http\Middleware\TrustProxies::class);

        $middleware->alias([
            'cors' => \App\Http\Middleware\Cors::class,
            'deprecated' => \App\Modules\MusoraApi\Middleware\DeprecationMiddleware::class,
            'musora-center-admin' => \App\Modules\MusoraCenter\Middleware\MusoraCenterAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
