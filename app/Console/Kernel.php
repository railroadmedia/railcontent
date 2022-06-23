<?php

namespace App\Console;

use App\Console\Commands\MigrateCoachesToInstructors;
use App\Console\Commands\PopulateNewRolesAndPermissionsTables;
use App\Console\Commands\PopulateUserRolesTable;
use App\Console\Commands\RunMWPPhaseOneLaunchMigrations;
use App\Console\Commands\SeedUserContentData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SeedUserContentData::class,
        PopulateNewRolesAndPermissionsTables::class,
        PopulateUserRolesTable::class,
        RunMWPPhaseOneLaunchMigrations::class,
        MigrateCoachesToInstructors::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        // TODO: uncomment when the console route file exists
        //require base_path('routes/console.php');
    }
}
