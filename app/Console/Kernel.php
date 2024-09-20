<?php

namespace App\Console;

use App\Console\Commands\AssignSongsPermissionsToAllUsers;
use App\Console\Commands\AssignSongsPermissionsToContent;
use App\Console\Commands\AssignSongsPermissionsToProducts;
use App\Console\Commands\AssignUnassignedHelpScoutCustomersToMentors;
use App\Console\Commands\CheckCommentsUrl;
use App\Console\Commands\CreateSongs24Jan2023;
use App\Console\Commands\CreateSongsDecember2022;
use App\Console\Commands\DelistStudentReviewAndFocus;
use App\Console\Commands\FixSongsTemp;
use App\Console\Commands\GenerateWeeklyMembershipStats;
use App\Console\Commands\MembershipFieldsSync;
use App\Console\Commands\MigrateOldGuitareoDeletedSongs;
use App\Console\Commands\MigratePianoteSongTutorial;
use App\Console\Commands\PopulateNewRolesAndPermissionsTables;
use App\Console\Commands\PopulateUserBrandLevel;
use App\Console\Commands\PopulateUserMinutesPracticedPerBrand;
use App\Console\Commands\PopulateUserRolesTable;
use App\Console\Commands\PopulateUserTotalXpPerBrand;
use App\Console\Commands\QuarterlyUpdateContent;
use App\Console\Commands\RemoveRailTrackerData;
use App\Console\Commands\RemoveTemporarySongsAccessForLifetimeMembersJanuary2023;
use App\Console\Commands\RepairGuitareoPDFs;
use App\Console\Commands\RepairUserProgressOn30DD;
use App\Console\Commands\RepairUserProgressOnNPPSH;
use App\Console\Commands\RepairUserProgressStartedOn;
use App\Console\Commands\RepairVimeoDurations;
use App\Console\Commands\SeedLiveAndScheduledContent;
use App\Console\Commands\SeedUserContentData;
use App\Console\Commands\SeedUserProgress;
use App\Console\Commands\SoftDeleteOldGuitareoSongs;
use App\Console\Commands\SoftDeleteOldSingeoSongs;
use App\Console\Commands\SyncShopifyProductInventoryToProductsTable;
use App\Console\Commands\SyncUsersToCIO;
use App\Console\Commands\TestLessonsDescriptionUrls;
use App\Console\Commands\UpdatePermissionsForCopyright;
use App\Console\Commands\UpdateRoutines;
use App\Console\Commands\UpdateRoutinesFebruary2023;
use App\Console\Commands\UpdateStatusForCopyRightContent;
use App\Console\Commands\VaporEnvManager;
use App\Modules\UserManagementSystem\Console\Commands\SendAccountSetupEmail;
use App\Modules\UserManagementSystem\Console\Commands\SetUserNeedsLogout;
use App\Modules\UserManagementSystem\Console\Commands\SyncPrimaryBrand;
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
        DelistStudentReviewAndFocus::class,
        UpdateStatusForCopyRightContent::class,
        UpdatePermissionsForCopyright::class,
        AssignSongsPermissionsToContent::class,
        AssignSongsPermissionsToProducts::class,
        AssignSongsPermissionsToAllUsers::class,
        FixSongsTemp::class,
        SoftDeleteOldSingeoSongs::class,
        SoftDeleteOldGuitareoSongs::class,
        UpdateRoutines::class,
        CreateSongs24Jan2023::class,
        RemoveTemporarySongsAccessForLifetimeMembersJanuary2023::class,
        MembershipFieldsSync::class,
        UpdateRoutinesFebruary2023::class,
        RepairUserProgressOn30DD::class,
        RepairUserProgressOnNPPSH::class,
        MigrateOldGuitareoDeletedSongs::class,
        RemoveRailTrackerData::class,
        SyncUsersToCIO::class,
        SeedUserProgress::class,
        AssignUnassignedHelpScoutCustomersToMentors::class,
        SyncShopifyProductInventoryToProductsTable::class,
        SetUserNeedsLogout::class,
        CheckCommentsUrl::class,
        SendAccountSetupEmail::class,
        GenerateWeeklyMembershipStats::class,
        SyncPrimaryBrand::class,
        QuarterlyUpdateContent::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //All times are in UTC
        $schedule->command('ProcessTrackings')->everyMinute();

        $schedule->command('forums:rebuildSearchIndexes')->hourly();

        $schedule->command('notifications:dailySummary')->dailyAt('12:00'); //4am PST

        $schedule->command('content:rebuildSearchIndexes')->dailyAt('2:00'); //6am PST
        $schedule->command('content:updatePopularityMWP')->cron('0 */8 * * *'); //every 8 hours
        $schedule->command('content:CreateVimeoVideoContentRecords', [50])->everyThirtyMinutes();
        $schedule->command('content:CreateYoutubeVideoContentRecordsViaClientAPI', [1])->cron(
            "0 */6 * * *"
        ); //4am, 10am, 4pm, 10pm PST

        $schedule->command('ecommerce:renewalDueSubscriptions 200')->dailyAt('10:00'); //2am PST

        $schedule->command('mentors:verify')->daily(); //4pm
        //temporary measure to assign mentors until ecommerce is integrated with MWP
        $schedule->command('mentors:assign')->hourly();

        $schedule->command('user:resyncExpiredProducts')->dailyAt('10:00'); //2am PST

        $schedule->command('addevent:syncMusora')->hourlyAt(50);

        $schedule->command('addevent:syncMusora --live')->hourlyAt(30);

        $schedule->command('SyncShopifyProductInventoryToProductsTable')->everyFiveMinutes();

        $schedule->command('ecommerce:report-cancelled-subscriptions celina@drumeo.com --cc=karissa@musora.com')
            ->mondays()->when(function () {
                return now()->weekOfYear % 2 == 0;
            })->at('08:01'); // every other Monday at 12:01am PST

        $schedule->command('ecommerce:CheckSongMembershipAccess')->dailyAt('11:00'); //3am PST

        $schedule->command('user:sendAccountSetupEmail')->dailyAt('21:00'); //1pm PST

        $schedule->command('content:QuarterlyUpdateContent')->quarterly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        //        $scan = scandir(app_path('Modules'));
        //        foreach ($scan as $file) {
        //            if (is_dir(app_path("Modules/$file"))) {
        //                $this->load(app_path("Modules/$file/Console/Commands"));
        //            }
        //        }
        $this->load(app_path('Modules/Ecommerce/Console/Commands'));
        $this->load(app_path('Modules/UserManagementSystem/Console/Commands'));
        $this->load(app_path('Modules/Content/Console/Commands'));
        $this->load(app_path('Modules/EventTracking/Console/Commands'));

        // TODO: uncomment when the console route file exists
        //require base_path('routes/console.php');
    }
}
