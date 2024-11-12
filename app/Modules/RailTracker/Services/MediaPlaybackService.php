<?php

namespace App\Modules\RailTracker\Services;

use App\Modules\RailTracker\Events\MediaPlaybackTracked;
use App\Modules\RailTracker\Models\MediaPlaybackSession;
use App\Modules\RailTracker\Models\MediaPlaybackTypes;
use App\Modules\RailTracker\Trackers\TrackerBase;
use Cache;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class MediaPlaybackService extends TrackerBase
{
    public function trackMediaPlaybackStart(
        string $mediaId,
        int $mediaLengthSeconds,
        ?int $userId,
        int $typeId,
        int $currentSecond = 0,
        int $secondsPlayed = 0,
        ?string $brand = null,
        ?string $startedOnDatetimeString = null,
    ): array {
        if (empty($startedOnDatetimeString)) {
            $startedOnDatetimeString = Carbon::now()->toDateTimeString();
        }

        $data = [
            'uuid' => Uuid::uuid4(),
            'media_id' => $mediaId,
            'media_length_seconds' => $mediaLengthSeconds,
            'user_id' => $userId,
            'type_id' => $typeId,
            'seconds_played' => max($secondsPlayed, 0),
            'current_second' => max($currentSecond, 0),
            'started_on' => $startedOnDatetimeString,
            'last_updated_on' => $startedOnDatetimeString,
        ];

        $mediaPlaybackSession = new MediaPlaybackSession();
        $mediaPlaybackSession->uuid = Uuid::uuid4();
        $mediaPlaybackSession->media_id = $mediaId;
        $mediaPlaybackSession->media_length_seconds = $mediaLengthSeconds;
        $mediaPlaybackSession->user_id = $userId;
        $mediaPlaybackSession->type_id = $typeId;
        $mediaPlaybackSession->seconds_played = $secondsPlayed;
        $mediaPlaybackSession->current_second = $currentSecond;
        $mediaPlaybackSession->started_on = $startedOnDatetimeString;
        $mediaPlaybackSession->last_updated_on = $startedOnDatetimeString;
        $mediaPlaybackSession->save();
        $data['id'] = $mediaPlaybackSession->id;

        event(new MediaPlaybackTracked($mediaPlaybackSession));
        $data['brand'] = $brand;
        return $data;
    }

    public function trackMediaPlaybackProgress(
        int $sessionId,
        int $secondsPlayed,
        int $currentSecond,
        ?string $lastUpdatedOnDatetimeString = null,
        ?string $brand = null,
        ?int $contentId = null
    ): bool|array {
        if (empty($lastUpdatedOn)) {
            $lastUpdatedOn = Carbon::now()->toDateTimeString();
        }

        $data = [
            'seconds_played' => $secondsPlayed,
            'current_second' => max($currentSecond, 0),
            'last_updated_on' => $lastUpdatedOn,
        ];

        $session = MediaPlaybackSession::query()->find($sessionId);

        if (empty($session)) {
            return false;
        }
        $session->seconds_played = $secondsPlayed;
        $session->current_second = max($currentSecond, 0);
        $session->last_updated_on = $lastUpdatedOn;
        $session->save();

        if (!$session->wasChanged()) {
            return false;
        }

        event(new MediaPlaybackTracked($session));

        return array_merge($session->toArray(), $data);
    }

    public function trackMediaType(string $type, string $category): int
    {
        $data = [
            'type' => substr($type, 0, 128),
            'category' => substr($category, 0, 128),
        ];
        $cacheKey = 'railtracker_' . md5(
                'railtracker_media_playback_types_id_' . serialize($data) . '_brand_' . config('railtracker.brand')
            );

        return Cache::remember(
            $cacheKey,
            now()->addSeconds(config('railtracker.cache_duration')),
            function () use ($data) {
                $mediaPlaybackType = MediaPlaybackTypes::query()->firstOrCreate($data);
                return $mediaPlaybackType->id;
            }
        );
    }
}
