<?php

use App\Modules\DataVersion\ServiceProviders\DataVersionServiceProvider;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Railroad\MusoraApi\Exceptions\MusoraAPIException;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        \Railroad\Railcontent\Providers\RailcontentServiceProvider::class,
        \Railroad\Response\Providers\ResponseServiceProvider::class,
        \Railroad\Ecommerce\Providers\EcommerceServiceProvider::class,
        \Railroad\Usora\Providers\UsoraServiceProvider::class,
        \Railroad\Railforums\Providers\ForumServiceProvider::class,
        \Railroad\Permissions\Providers\PermissionsServiceProvider::class,
        \Railroad\MusoraApi\Providers\MusoraApiServiceProvider::class,
        \Railroad\Railnotifications\NotificationsServiceProvider::class,
        \Railroad\Points\Providers\PointsServiceProvider::class,
        \Railroad\Railtracker\Providers\RailtrackerServiceProvider::class,
        \Railroad\Railanalytics\AnalyticsServiceProvider::class,
        \Railroad\Location\Providers\LocationServiceProvider::class,
        \Railroad\RemoteStorage\Providers\RemoteStorageServiceProvider::class,
        \Railroad\LeadTracker\Providers\LeadTrackerServiceProvider::class,
        \Jenssegers\Agent\AgentServiceProvider::class,
        \Modules\UserManagementSystem\Providers\UserManagementSystemServiceProvider::class,
        \Venturecraft\Revisionable\RevisionableServiceProvider::class,
    ])
    ->withRouting(
        using: function () {
            Route::pattern('musoraDomain', '(.*musora\.com)');
            Route::pattern('drumeoDomain', '(.*drumeo\.com)');
            Route::pattern('pianoteDomain', '(.*pianote\.com)');
            Route::pattern('guitareoDomain', '(.*guitareo\.com)');
            Route::pattern('singeoDomain', '(.*singeo\.com)');

            Route::group([], base_path('routes/misc/legacy_brand_members_redirects_to_up.php'));
            Route::group([], base_path('routes/routes.php')); // not actually needed
            Route::group([], base_path('routes/misc/manifest_files_routes.php'));
            Route::group([], base_path('routes/misc/mobile_app_store_api_keys_json_routes.php'));
            Route::group([], base_path('routes/misc/sitemap_routes.php'));
            Route::group([], base_path('routes/platform/platform_pages_routes.php'));
            Route::group([], base_path('routes/misc/admin_routes.php'));

            Route::group([], base_path('routes/musora/marketing/order-form.php'));
            Route::group([], base_path('routes/musora/marketing/login.php'));
            Route::group([], base_path('routes/musora/marketing/product.php'));
            Route::group([], base_path('routes/musora/marketing/other.php'));
            Route::group([], base_path('routes/musora/marketing/cohort-packs.php'));
            Route::group([], base_path('routes/musora/platform/home.php'));
            Route::group([], base_path('routes/musora/platform/search.php'));


            Route::group([], base_path('routes/drumeo/sales.php'));
            Route::group([], base_path('routes/drumeo/shop.php'));
            Route::group([], base_path('routes/drumeo/lead-gen.php'));

            Route::group([], base_path('routes/guitareo/sales.php'));
            Route::group([], base_path('routes/guitareo/shop.php'));
            Route::group([], base_path('routes/guitareo/lead-gen.php'));

            Route::group([], base_path('routes/pianote/sales.php'));
            Route::group([], base_path('routes/pianote/shop.php'));
            Route::group([], base_path('routes/pianote/lead-gen.php'));

            Route::group([], base_path('routes/singeo/sales.php'));
            Route::group([], base_path('routes/singeo/shop.php'));
            Route::group([], base_path('routes/singeo/lead-gen.php'));

            Route::group([], base_path('routes/misc/http_error_code_routes.php'));
        },
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up'
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
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
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
            \App\Http\Middleware\ValidateRedirectUrl::class,
        ]);

        $middleware->group('web_authenticated', [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
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
            \App\Http\Middleware\ValidateRedirectUrl::class,
        ]);

        $middleware->group('web_member_only', [
            \App\Http\Middleware\ExpiredMemberRedirect::class,
        ]);

        $middleware->group('api_public', [
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
            \App\Http\Middleware\ValidateRedirectUrl::class,
        ]);

        $middleware->group('api_authenticated', [
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
            \App\Http\Middleware\ValidateRedirectUrl::class,
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
        $exceptions->renderable(function (Throwable $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'trace' => ' File::' . $e->getFile() . ' Line::' . $e->getLine(),
                ], 500);
            }
        });

        $exceptions->reportable(function (Throwable $e) {
            if ($e instanceof MusoraAPIException) {
                return false;
            }
            Log::info(request()->url());
        });
    })->create();
