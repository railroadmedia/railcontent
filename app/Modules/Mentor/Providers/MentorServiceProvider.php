<?php

namespace App\Modules\Mentor\Providers;

use App\Modules\Mentor\Commands\AssignMentors;
use App\Modules\Mentor\Commands\InitializeMentors;
use App\Modules\Mentor\Commands\UnassignMentors;
use App\Modules\Mentor\Listeners\EnsureMentorAssigned;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\Assign;
use Railroad\Ecommerce\Events\GiveContentAccess;

class MentorServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        GiveContentAccess::class => [
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
            __DIR__ . '/../config/mentor.php',
            'mentor'
        );

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->commands([
            InitializeMentors::class,
            UnassignMentors::class
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
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
