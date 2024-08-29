<?php

namespace App\Modules\Reporting\Providers;

use App\Modules\Reporting\Console\Commands\RecentRequestStats;
use Illuminate\Support\ServiceProvider;

class ReportingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands(
            [
                RecentRequestStats::class,
            ]
        );

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
    }
}
