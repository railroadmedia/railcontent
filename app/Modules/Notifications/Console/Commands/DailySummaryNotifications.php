<?php

namespace App\Modules\Notifications\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Railroad\Railnotifications\Services\NotificationBroadcastService;
use Railroad\Railnotifications\Services\NotificationService;

class DailySummaryNotifications extends Command
{
    protected $signature = 'notifications:dailySummary';
    protected $description = 'DailySummaryNotifications';

    public function handle(
        NotificationService $notificationService,
        NotificationBroadcastService $notificationBroadcastService
    ): bool {
        $dateCutoff = Carbon::now()->subDay()->toDateTimeString();
        $recipientIds = $notificationService->getAllRecipientIdsWithUnreadNotifications(
            $dateCutoff
        );

        foreach ($recipientIds as $recipientId) {
            if ($recipientId['id']) {
                // send aggregated broadcast
                $notificationBroadcastService->broadcastUnreadAggregated(
                    $recipientId['id'],
                    'email',
                    $dateCutoff
                );

                $notificationBroadcastService->broadcastUnreadAggregated(
                    $recipientId['id'],
                    'fcm',
                    $dateCutoff
                );
                usleep(250000); //delay 250 ms to reduce load
            }
        }

        return true;
    }
}
