<?php

namespace App\Modules\Notifications\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Notifications\Jobs\DailySummaryNotificationsJob;
use Carbon\Carbon;
use Railroad\Railnotifications\Services\NotificationService;

class DailySummaryNotifications extends Command
{
    protected $signature = 'notifications:dailySummary';
    protected $description = 'DailySummaryNotifications';

    public function handle(NotificationService $service): bool
    {
        $startDate = Carbon::now()->subDay();
        $success = $this->runChainQuery(function (int $skip, int $take) use ($startDate) {
            return new DailySummaryNotificationsJob($skip, $take, $startDate);
        }, chunks: 100);
        return $success;
    }
}
