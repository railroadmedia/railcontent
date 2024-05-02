<?php

namespace App\Modules\Notifications\Providers;

use App\Modules\Notifications\Console\Commands\DailySummaryNotifications;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            DailySummaryNotifications::class,
        ]);
    }
}
