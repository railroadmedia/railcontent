<?php

namespace App\Modules\MusoraCenter\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class MusoraCenterServiceProvider extends ServiceProvider
{
    /**
     * UsoraServiceProvider constructor.
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/musora_center_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../views', 'musora-center');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/musora-center'),
        ], 'public');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();
    }
}
