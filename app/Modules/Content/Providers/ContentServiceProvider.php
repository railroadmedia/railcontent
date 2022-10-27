<?php

namespace App\Modules\Content\Providers;

use App\Modules\Content\Console\Commands\CoachBulkDataUpdate;
use App\Modules\Content\Console\Commands\CoachBulkImageUpdate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->commands([
            CoachBulkDataUpdate::class,
            CoachBulkImageUpdate::class,
        ]);

        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('CreateVimeoVideoContentRecords', [50])->everyThirtyMinutes();
        });
    }
}
