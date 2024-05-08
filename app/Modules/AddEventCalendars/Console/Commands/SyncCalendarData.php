<?php

namespace App\Modules\AddEventCalendars\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\AddEventCalendars\Services\CalendarSyncService;

class SyncCalendarData extends Command
{
    protected $signature = 'addevent:syncCalendarData';

    public function handle(CalendarSyncService $calendarSyncService)
    {
        $this->withExecutionTime(function () use ($calendarSyncService) {
            $calendarSyncService->syncCalendarData();
        });
    }


}
