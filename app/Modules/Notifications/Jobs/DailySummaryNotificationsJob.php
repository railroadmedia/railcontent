<?php

namespace App\Modules\Notifications\Jobs;

use App;
use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Notifications\Models\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Log;
use Railroad\Railnotifications\Services\NotificationBroadcastService;

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
        return Notification::query()
            ->distinct('recipient_id')
            ->select('recipient_id')
            ->where('created_at', '>=', $this->startDate)
            ->whereNull('read_on');
    }

    /**
     * @param Notification $item
     */
    function handleItem($item): void
    {
        Log::info("Processing user $item->recipient_id");
        /** @var NotificationBroadcastService $notificationBroadcastService */
        $notificationBroadcastService = App::make(NotificationBroadcastService::class);

        $notificationBroadcastService->broadcastUnreadAggregated(
            $item->recipient_id,
            'email',
            $this->startDate
        );

        $notificationBroadcastService->broadcastUnreadAggregated(
            $item->recipient_id,
            'fcm',
            $this->startDate
        );
        usleep(250000); //delay 250 ms to reduce load
    }
}
