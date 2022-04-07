<?php

namespace App\Modules\UserManagementSystem\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Routing\RouteRegistrar;

class UserManagementSystemServiceProvider extends ServiceProvider
{
    /**
     * @var RouteRegistrar
     */
    private $routeRegistrar;

    /**
     * UsoraServiceProvider constructor.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        parent::__construct($application);

        $this->routeRegistrar = $application->make(RouteRegistrar::class);
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
            __DIR__ . '/../config/user_management_system.php',
            'user_management_system'
        );

        // migrations: only run migrations if this is the master 'host' implementation
        if (config('user_management_system.run_migrations') === true) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        // routes
//        if (config('usora.autoload_all_routes') == true) {
//            $this->routeRegistrar->registerAll();
//        }

        // commands
        if ($this->app->runningInConsole()) {
            $this->commands(
                [
//                    MigrateUserFieldsToColumns::class,
                ]
            );
        }

        // views
//        $this->loadViewsFrom(__DIR__ . '/../../views', 'usora');
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
