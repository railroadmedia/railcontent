<?php

namespace App\Modules\AddEventCalendars\Providers;

use App\Modules\AddEventCalendars\Console\Commands\MusoraSync;
use App\Modules\AddEventCalendars\Console\Commands\SyncCalendarData;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AddEventCalendarsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            MusoraSync::class,
            SyncCalendarData::class,
        ]);

        // publish config file
        $this->mergeConfigFrom(
            __DIR__ . '/../config/addevent.php',
            'addevent'
        );
    }
}
