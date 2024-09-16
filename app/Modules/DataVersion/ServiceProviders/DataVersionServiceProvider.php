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
        Route::middleware([])
            ->group(__DIR__ . '/../routes/routes.php');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();
    }
}
