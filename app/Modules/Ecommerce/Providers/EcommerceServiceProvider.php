<?php

namespace App\Modules\Ecommerce\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class EcommerceServiceProvider extends ServiceProvider
{
    /**
     * UsoraServiceProvider constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Route::middleware('web_or_api_public')
            ->group(__DIR__ . '/../routes/routes.php')
            ->group(__DIR__ . '/../routes/shopify.php');


        $this->mergeConfigFrom(
            __DIR__ . '/../config/shopify.php',
            'shopify'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        parent::register();
    }
}
