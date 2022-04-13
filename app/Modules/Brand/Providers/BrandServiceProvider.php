<?php

namespace App\Modules\Brand\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class BrandServiceProvider extends ServiceProvider
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
    public function boot()
    {
        // publish config file
        $this->mergeConfigFrom(
            __DIR__ . '/../config/brands.php',
            'brands'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
