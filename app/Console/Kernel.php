<?php

namespace App\Console;

use App\Console\Commands\AddTimeToUsersAccountsJan2023;
use App\Console\Commands\AssignSongsPermissionsToAllUsers;
use App\Console\Commands\AssignSongsPermissionsToContent;
use App\Console\Commands\AssignSongsPermissionsToProducts;
use App\Console\Commands\CreateSongs24Jan2023;
use App\Console\Commands\CreateSongsDecember2022;
use App\Console\Commands\FixSongsTemp;
use App\Console\Commands\MigratePianoteSongTutorial;
use App\Console\Commands\SoftDeleteOldGuitareoSongs;
use App\Console\Commands\SoftDeleteOldSingeoSongs;
use App\Console\Commands\PopulateNewRolesAndPermissionsTables;
use App\Console\Commands\PopulateUserBrandLevel;
use App\Console\Commands\PopulateUserMinutesPracticedPerBrand;
use App\Console\Commands\PopulateUserRolesTable;
use App\Console\Commands\PopulateUserTotalXpPerBrand;
use App\Console\Commands\RepairGuitareoPDFs;
use App\Console\Commands\RepairUserProgressStartedOn;
use App\Console\Commands\RepairVimeoDurations;
use App\Console\Commands\SeedLiveAndScheduledContent;
use App\Console\Commands\SeedUserContentData;
use App\Console\Commands\TestLessonsDescriptionUrls;
use App\Console\Commands\VaporEnvManager;
use App\Console\Commands\UpdateRoutines;
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
        PopulateUserBrandLevel::class,
        RepairVimeoDurations::class,
        PopulateUserTotalXpPerBrand::class,
        PopulateUserMinutesPracticedPerBrand::class,
        VaporEnvManager::class,
        TestLessonsDescriptionUrls::class,
        MigratePianoteSongTutorial::class,
        CreateSongsDecember2022::class,
        RepairUserProgressStartedOn::class,
        RepairGuitareoPDFs::class,
        AssignSongsPermissionsToContent::class,
        AssignSongsPermissionsToProducts::class,
        AssignSongsPermissionsToAllUsers::class,
        FixSongsTemp::class,
        SoftDeleteOldSingeoSongs::class,
        SoftDeleteOldGuitareoSongs::class,
        AddTimeToUsersAccountsJan2023::class,
        UpdateRoutines::class,
        CreateSongs24Jan2023::class,
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

        $schedule->command('forums:rebuildSearchIndexes')->hourly();

        $schedule->command('notifications:dailySummary')->dailyAt('12:00');

        $schedule->command('content:rebuildSearchIndexes')->dailyAt('2:00');
        $schedule->command('content:updatePopularity')->cron('0 */8 * * *'); //every 8 hours
        $schedule->command('content:CreateVimeoVideoContentRecords', [50])->everyThirtyMinutes();
        $schedule->command('content:CreateYoutubeVideoContentRecordsViaClientAPI', [1])->cron("0 */6 * * *");

        $schedule->command('ecommerce:renewalDueSubscriptions')->cron("15 */8 * * *"); // every 8 hours
        $schedule->command('ecommerce:ProcessAppleExpiredSubscriptionsQueued')->cron("30 */8 * * *"); // every 8 hours

        $schedule->command('mentors:verify')->daily();
        //temporary measure to assign mentors until ecommerce is integrated with MWP
        $schedule->command('mentors:assign')->hourly();
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
