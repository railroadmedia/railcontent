<?php

namespace App\Modules\Mentor\Providers;

use App\Modules\EventDataSynchronizer\Events\UserMembershipDateUpdated;
use App\Modules\Mentor\Console\Commands\AssignMentors;
use App\Modules\Mentor\Console\Commands\InitializeMentors;
use App\Modules\Mentor\Console\Commands\RecalculateMentorTotals;
use App\Modules\Mentor\Console\Commands\RegisterHelpScoutWebHook;
use App\Modules\Mentor\Console\Commands\ReassignStudents;
use App\Modules\Mentor\Console\Commands\SyncMentorsWithCustomerIO;
use App\Modules\Mentor\Console\Commands\UnregisterHelpScoutWebHook;
use App\Modules\Mentor\Console\Commands\VerifyMentors;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Mentor\Listeners\EnsureMentorState;

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
            ReassignStudents::class,
            AssignMentors::class,
            SyncMentorsWithCustomerIO::class,
        ]);


        $this->mergeConfigFrom(
            __DIR__ . '/../config/mentor.php',
            'mentor'
        );

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('mentors:recalculateTotals')->daily();

            //temporary measure to assign mentors until ecommerce is integrated with MWP
            $schedule->command('mentors:assign')->hourly();
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
