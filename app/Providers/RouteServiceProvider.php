<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
    public const HOME = '/home';

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
            Route::group([], base_path('routes/routes.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/marketing/login.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/marketing/homepage.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/musora/routes.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/drumeo/routes.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/pianote/routes.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/singeo/routes.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/guitareo/routes.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/platform/search.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/platform/home.php'));
        });

        $this->routes(function () {
            Route::group([], base_path('routes/platform/platform_pages_routes.php'));
        });
    }
}
