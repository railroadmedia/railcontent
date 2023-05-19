<?php

namespace App\Modules\AddEventCalendars\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\AddEventCalendars\Services\CalendarSyncService;

class SyncCalendarData extends Command
{

    protected $signature = 'addevent:syncCalendarData';
    private CalendarSyncService $calendarSyncService;

    public function __construct(CalendarSyncService $calendarSyncService)
    {
        parent::__construct();
        $this->calendarSyncService = $calendarSyncService;
    }

    public function handle()
    {
        $this->withExecutionTime(function () {
            $this->calendarSyncService->syncCalendarData();
        });
    }


}
