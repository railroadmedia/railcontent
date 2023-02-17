<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
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
        URL::defaults(['brand' => 'musora']);

        $this->routes(function () {
        });

        $this->routes(function () {
            Route::group([], base_path('routes/routes.php')); // not actually needed
            Route::group([], base_path('routes/misc/manifest_files_routes.php'));
            Route::group([], base_path('routes/misc/mobile_app_store_api_keys_json_routes.php'));
            Route::group([], base_path('routes/misc/sitemap_routes.php'));
            Route::group([], base_path('routes/platform/platform_pages_routes.php'));

            Route::group([], base_path('routes/musora/marketing/homepage.php'));
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

            Route::group([], base_path('routes/singeo/shop.php'));
            Route::group([], base_path('routes/singeo/sales.php'));

            Route::group([], base_path('routes/misc/http_error_code_routes.php'));

            Route::group([], base_path('routes/misc/legacy_brand_members_redirects_to_up.php'));
        });
    }
}
