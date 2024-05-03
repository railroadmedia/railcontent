<?php

namespace App\Modules\Notifications\Services;

use App\Modules\Notifications\Models\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class NotificationService
{
    public function getRecipientIdsWithUnreadNotificationsQuery(Carbon $startDate): Builder
    {
        return Notification::query()
            ->distinct('recipient_id')
            ->select('recipient_id')
            ->where('created_at', '>=', $startDate)
            ->whereNull('read_on');
    }

    public function getUnreadNotifications(array $recipientIds, Carbon $startDate): Collection
    {
        return Notification::query()
            ->with('user.notificationSettings')
            ->where('created_at', '>=', $startDate)
            ->whereIn('recipient_id', $recipientIds)
            ->whereNull('read_on')
            ->orderByDesc('created_at')
            ->get();
    }
}
