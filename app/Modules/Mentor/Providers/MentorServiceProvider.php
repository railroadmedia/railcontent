<?php

namespace App\Modules\Mentor\Providers;

use App\Modules\Mentor\Listeners\EnsureMentorAssigned;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Railroad\Ecommerce\Events\GiveContentAccess;

class MentorServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        GiveContentAccess::class =>[
            EnsureMentorAssigned::class,
        ]
    ];

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
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php',
            'mentor'
        );

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // commands
        if ($this->app->runningInConsole()) {
            $this->commands([
            ]);
        }

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
//        Route::middleware('web_or_api_authenticated')
//            ->group(__DIR__ . '/../routes/routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }
}
