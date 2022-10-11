<?php

namespace App\Modules\Content\Providers;

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

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        $this->callAfterResolving(Schedule::class, function (Schedule $schedule){
            $schedule->command('CreateVimeoVideoContentRecords', [50])->everyThirtyMinutes();
        });
    }
}
