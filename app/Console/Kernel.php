<?php

namespace App\Console;

use App\Console\Commands\MigrateCoachesToInstructors;
use App\Console\Commands\MigrateGuitareoUserXP;
use App\Console\Commands\PopulateNewRolesAndPermissionsTables;
use App\Console\Commands\PopulateUserBrandLevel;
use App\Console\Commands\PopulateUserMinutesPracticedPerBrand;
use App\Console\Commands\PopulateUserRolesTable;
use App\Console\Commands\PopulateUserTotalXpPerBrand;
use App\Console\Commands\RepairUserProductsFromReferral;
use App\Console\Commands\RepairVimeoDurations;
use App\Console\Commands\RunMWPPhaseOneLaunchMigrations;
use App\Console\Commands\SeedLiveAndScheduledContent;
use App\Console\Commands\SeedUserContentData;
use App\Console\Commands\TestLessonsDescriptionUrls;
use App\Console\Commands\VaporEnvManager;
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
        SeedLiveAndScheduledContent::class,
        PopulateNewRolesAndPermissionsTables::class,
        PopulateUserRolesTable::class,
        RunMWPPhaseOneLaunchMigrations::class,
        MigrateCoachesToInstructors::class,
        PopulateUserBrandLevel::class,
        RepairVimeoDurations::class,
        PopulateUserTotalXpPerBrand::class,
        PopulateUserMinutesPracticedPerBrand::class,
        VaporEnvManager::class,
        TestLessonsDescriptionUrls::class,
        MigrateGuitareoUserXP::class,
        RepairUserProductsFromReferral::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('ProcessTrackings')->everyMinute();
        $schedule->command('content:rebuildSearchIndexes')->dailyAt('2:00');
        $schedule->command('forums:rebuildSearchIndexes')->hourly();
        $schedule->command('notifications:dailySummary')->dailyAt('12:00');
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
