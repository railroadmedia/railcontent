<?php

namespace App\Modules\MusoraApi\Providers;

use App\Modules\MusoraApi\Middleware\ApiVersionMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\UserManagementSystem\Providers\AuthenticationServiceProvider;

class MusoraApiServiceProvider extends ServiceProvider
{
    /**
     * ApiServiceProvider constructor.
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
        // publish config file
        $this->mergeConfigFrom(
            __DIR__ . '/../config/journey.php',
            'journeys'
        );

        $this->loadRoutesFrom(__DIR__ . '/../routes/onboarding.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/referral.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/learning.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/journey.php');
        $router = $this->app['router'];
        $router->aliasMiddleware('api_version', ApiVersionMiddleware::class);
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
