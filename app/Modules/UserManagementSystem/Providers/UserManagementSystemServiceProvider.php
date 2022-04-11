<?php

namespace Modules\UserManagementSystem\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class UserManagementSystemServiceProvider extends ServiceProvider
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
            __DIR__ . '/../config/user_management_system.php',
            'user_management_system'
        );

        // migrations: only run migrations if this is the master 'host' implementation
        if (config('user_management_system.run_migrations') === true) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        // routes
        if (config('user_management_system.autoload_all_routes') == true) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/user_management_system_routes.php');
        }

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
        // Laravel auth integration
        $this->app->register(AuthenticationServiceProvider::class);
    }
}
