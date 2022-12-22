<?php

namespace App\Modules\Reporting\Providers;

use App\Modules\Reporting\Console\Commands\RecentRequestStats;
use Illuminate\Support\ServiceProvider;

class ReportingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands(
            [
                RecentRequestStats::class,
            ]
        );
    }
}
