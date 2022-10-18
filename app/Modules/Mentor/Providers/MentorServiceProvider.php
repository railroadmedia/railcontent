<?php

namespace App\Modules\Mentor\Providers;

use App\Modules\EventDataSynchronizer\Events\UserMembershipDateUpdated;
use App\Modules\Mentor\Console\Commands\InitializeMentors;
use App\Modules\Mentor\Console\Commands\RecalculateMentorTotals;
use App\Modules\Mentor\Console\Commands\RegisterHelpScoutWebHook;
use App\Modules\Mentor\Console\Commands\UnassignMentors;
use App\Modules\Mentor\Console\Commands\UnregisterHelpScoutWebHook;
use App\Modules\Mentor\Console\Commands\VerifyMentors;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Mentor\Listeners\EnsureMentorState;
use Modules\UserManagementSystem\Events\OnboardingInstrumentUpdated;

class MentorServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserMembershipDateUpdated::class => [
            EnsureMentorState::class,
        ],
        OnboardingInstrumentUpdated::class =>[
            EnsureMentorState::class . '@handleOnboardingInstrumentUpdated'
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
    public function boot(): void
    {
        $this->commands([
            InitializeMentors::class,
            VerifyMentors::class,
            RecalculateMentorTotals::class,
            RegisterHelpScoutWebHook::class,
            UnregisterHelpScoutWebHook::class,
            UnassignMentors::class, //used for debugging can be removed after initial launch
        ]);


        $this->mergeConfigFrom(
            __DIR__ . '/../config/mentor.php',
            'mentor'
        );

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        $this->callAfterResolving(Schedule::class, function (Schedule $schedule){
            $schedule->command('mentors:recalculateTotals')->daily();
        });
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
