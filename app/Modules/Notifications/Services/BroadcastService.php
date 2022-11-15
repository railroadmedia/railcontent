<?php

namespace App\Modules\Notifications\Services;


use App\Modules\Notifications\Models\Broadcast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Railroad\Railnotifications\Jobs\BroadcastNotificationsAggregated;

class BroadcastService
{


    public function broadcastUnreadAggregated(
        Collection $notifications,
        string $channelName,
    ) {
        $notificationBroadcasts = [];
        $groupId = bin2hex(openssl_random_pseudo_bytes(32));

        foreach ($notifications as $notification) {
            // ensure this channel and notification type is enabled in the global config
            // and that is not read already
            if ($notification->read_on ||
                (config('railnotifications.channel_notification_type_broadcast_toggles', []
                )[$channelName][$notification->type] ?? true) === false) {
                continue;
            }

            $broadcast = new Broadcast();
            $broadcast->channel = $channelName;
            $broadcast->type = Broadcast::TYPE_AGGREGATED;
            $broadcast->aggregation_group_id = $groupId;
            $broadcast->status = Broadcast::STATUS_IN_TRANSIT;
            $broadcast->notification_id = $notification->id;
            $broadcast->save();

            $notificationBroadcasts[] = $broadcast->id;
        }

        if (empty($notificationBroadcasts)) {
            return;
        }

        // note: railmap still does not have mass insert implemented, this will persist 1 at a time
        $job = new BroadcastNotificationsAggregated(
            $notificationBroadcasts
        );

        dispatch_sync($job);
    }
}
