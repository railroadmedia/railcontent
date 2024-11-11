<?php

namespace App\Modules\DataVersion\ServiceProviders;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DataVersionServiceProvider extends ServiceProvider
{

    public function __construct(Application $application)
    {
        parent::__construct($application);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        // publish config file
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dataVersioning.php',
            'dataVersioning'
        );
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();
    }
}
