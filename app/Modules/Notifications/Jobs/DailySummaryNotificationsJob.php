<?php

namespace App\Modules\Notifications\Jobs;

use App;
use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Notifications\Models\Notification;
use App\Modules\Notifications\Models\NotificationSetting;
use App\Modules\Notifications\Services\BroadcastService;
use App\Modules\Notifications\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\UserManagementSystem\Models\User;

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

    public function getSkip(): int
    {
        return $this->skip;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    public function getQuery(): Builder
    {
        /** @var NotificationService $notificationService */
        $notificationService = App::make(NotificationService::class);
        return $notificationService->getRecipientIdsWithUnreadNotificationsQuery($this->startDate);
    }

    public function handleAllItems($items): bool
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

        foreach ($grouped as $notifications) {
            /** @var Collection $notifications */
            /** @var User $user */
            $user = $notifications->first()->user;
            $isDailySummaryEnabled = $user && $user->notifications_summary_frequency_minutes && $user->notifications_summary_frequency_minutes > 0;
            if (!$isDailySummaryEnabled) {
                continue;
            }
            $emailNotifications = $notifications->filter(function (Notification $notification) {
                return $notification->isNotificationSettingEnabled()
                    && $notification->getNotificationSetting(NotificationSetting::SEND_EMAIL_NOTIF);
            });

            $mobileNotifications = $notifications->filter(function (Notification $notification) {
                return $notification->isNotificationSettingEnabled()
                    && $notification->getNotificationSetting(NotificationSetting::SEND_PUSH_NOTIF);
            });

            if ($emailNotifications->count() > 0) {
                $broadcastService->broadcastUnreadAggregated(
                    $emailNotifications,
                    'email',
                );
            }
            if ($mobileNotifications->count() > 0) {
                $broadcastService->broadcastUnreadAggregated(
                    $mobileNotifications,
                    'fcm',
                );
            }
        }

        return true;
    }

    public function handleItem($item): void
    {
    }
}
