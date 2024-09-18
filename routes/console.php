<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

$this->load(app_path('Modules/Content/Console/Commands'));


//All times are in UTC
Schedule::command('ProcessTrackings')->everyMinute();

Schedule::command('forums:rebuildSearchIndexes')->hourly();

Schedule::command('notifications:dailySummary')->dailyAt('12:00'); //4am PST

Schedule::command('content:rebuildSearchIndexes')->dailyAt('2:00'); //6am PST
Schedule::command('content:updatePopularityMWP')->cron('0 */8 * * *'); //every 8 hours
Schedule::command('content:CreateVimeoVideoContentRecords', [50])->everyThirtyMinutes();
Schedule::command('content:CreateYoutubeVideoContentRecordsViaClientAPI', [1])->cron(
    "0 */6 * * *"
); //4am, 10am, 4pm, 10pm PST

Schedule::command('ecommerce:renewalDueSubscriptions 200')->dailyAt('10:00'); //2am PST

Schedule::command('mentors:verify')->daily(); //4pm
//temporary measure to assign mentors until ecommerce is integrated with MWP
Schedule::command('mentors:assign')->hourly();

Schedule::command('user:resyncExpiredProducts')->dailyAt('10:00'); //2am PST

Schedule::command('addevent:syncMusora')->hourlyAt(50);

Schedule::command('addevent:syncMusora --live')->hourlyAt(30);

Schedule::command('SyncShopifyProductInventoryToProductsTable')->everyFiveMinutes();

Schedule::command('ecommerce:report-cancelled-subscriptions celina@drumeo.com --cc=karissa@musora.com')
    ->mondays()->when(function () {
        return now()->weekOfYear % 2 == 0;
    })->at('08:01'); // every other Monday at 12:01am PST

Schedule::command('ecommerce:CheckSongMembershipAccess')->dailyAt('11:00'); //3am PST

Schedule::command('user:sendAccountSetupEmail')->dailyAt('21:00'); //1pm PST
