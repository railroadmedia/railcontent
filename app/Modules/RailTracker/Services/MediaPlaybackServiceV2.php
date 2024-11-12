<?php

namespace App\Modules\RailTracker\Services;

use App\Modules\Content\Models\Content;
use App\Modules\RailTracker\Enums\MediaTypeEnum;
use App\Modules\RailTracker\Events\MediaPlaybackTracked;
use App\Modules\RailTracker\Models\MediaPlaybackSession;
use App\Modules\RailTracker\Trackers\TrackerBase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MediaPlaybackServiceV2 extends TrackerBase
{
    public function trackMediaPlaybackStart(
        string $sessionId,
        int $contentId,
        MediaTypeEnum $mediaType,
        int $mediaLengthSeconds,
        int $currentSecond,
        int $secondsPlayed,
        int $userId,
    ): void {
        $content = Content::find($contentId);
        if (!$content) {
            Log::warning("Content $contentId not found");
            return;
        }
        $mediaPlaybackSession = MediaPlaybackSession::query()->find($sessionId);

        if (!$mediaPlaybackSession) {
            $mediaPlaybackSession = new MediaPlaybackSession();
            $mediaPlaybackSession->uuid = $sessionId;
            $mediaPlaybackSession->started_on = Carbon::now();
        }
        $mediaPlaybackSession->media_id = $contentId;
        $mediaPlaybackSession->type_id = $mediaType->value;
        $mediaPlaybackSession->media_length_seconds = $mediaLengthSeconds;
        $mediaPlaybackSession->user_id = $userId;
        $mediaPlaybackSession->seconds_played = $secondsPlayed;
        $mediaPlaybackSession->current_second = $currentSecond;
        $mediaPlaybackSession->last_updated_on = Carbon::now();
        $mediaPlaybackSession->save();

        event(new MediaPlaybackTracked($mediaPlaybackSession));
    }

}
