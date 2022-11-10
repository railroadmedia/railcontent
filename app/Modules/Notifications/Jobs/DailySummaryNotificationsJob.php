<?php

namespace App\Modules\Notifications\Jobs;

use App;
use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Notifications\Models\Notification;
use App\Modules\Notifications\Services\BroadcastService;
use App\Modules\Notifications\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DailySummaryNotificationsJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    private Carbon $startDate;

    public function __construct(int $skip, int $take, $startDate)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->startDate = $startDate;
    }

    function getSkip(): int
    {
        return $this->skip;
    }

    function getTake(): int
    {
        return $this->take;
    }

    function getQuery(): Builder
    {
        /** @var NotificationService $notificationService */
        $notificationService = App::make(NotificationService::class);
        return $notificationService->getRecipientIdsWithUnreadNotifications($this->startDate);
    }

    function handleAllItems($items): bool
    {
        $recipientIds = $items->pluck('recipient_id')->all();
        /** @var BroadcastService $broadcastService */
        $broadcastService = App::make(BroadcastService::class);
        /** @var NotificationService $notificationService */
        $notificationService = App::make(NotificationService::class);

        $allNotifications = $notificationService->getUnreadNotifications($recipientIds, $this->startDate);

        $grouped = $allNotifications->groupBy(function (Notification $item) {
            return $item->recipient_id;
        });

        foreach ($grouped as $recipient_id => $notifications) {
            $broadcastService->broadcastUnreadAggregated(
                $notifications,
                'email',
            );
            $broadcastService->broadcastUnreadAggregated(
                $notifications,
                'fcm',
            );
        }

        return true;
    }

    function handleItem($item): void
    {
    }
}
