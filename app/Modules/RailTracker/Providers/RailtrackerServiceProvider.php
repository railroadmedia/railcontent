<?php

namespace App\Modules\RailTracker\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Modules\RailTracker\Console\Commands\EmptyLocalCache;
use App\Modules\RailTracker\Console\Commands\PrintKeyCount;
use App\Modules\RailTracker\Console\Commands\ProcessTrackings;

class RailtrackerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        try {
            $this->setupConfig();
        } catch (\Exception $exception) {
            error_log($exception);
        }

        $this->loadRoutesFrom(__DIR__ . '/../Routes/routes.php');
    }

    private function setupConfig(): void
    {
        $this->commands([
            ProcessTrackings::class,
            PrintKeyCount::class,
        ]);
    }
}
