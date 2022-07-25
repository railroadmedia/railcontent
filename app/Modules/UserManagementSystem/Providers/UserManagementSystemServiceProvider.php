<?php

namespace Modules\UserManagementSystem\Providers;

use App\Modules\UserManagementSystem\Policies\UserPolicy;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Modules\UserManagementSystem\Models\User;

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
            Route::middleware('web_or_api_authenticated')
                ->group(__DIR__ . '/../routes/user_management_system_authenticated_routes.php');
            Route::middleware('web_or_api_public')
                ->group(__DIR__ . '/../routes/user_management_system_public_routes.php');
        }

        // commands
        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                ]
            );
        }

        // views
        $this->loadViewsFrom(__DIR__ . '/../views', 'user-management-system');

        // model policies
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            if ($modelClass === User::class) {
                return UserPolicy::class;
            }

            return null;
        });
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
