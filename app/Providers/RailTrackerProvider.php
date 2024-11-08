<?php

namespace App\Providers;

use App\Modules\RailTracker\Services\MediaPlaybackService;
use Railroad\MusoraApi\Contracts\RailTrackerProviderInterface;

class RailTrackerProvider implements RailTrackerProviderInterface
{
    private MediaPlaybackService $mediaPlaybackTracker;

    public function __construct(MediaPlaybackService $mediaPlaybackTracker)
    {
        $this->mediaPlaybackTracker = $mediaPlaybackTracker;
    }

    public function trackMediaType($type, $category): string
    {
        $mediaTypeId = $this->mediaPlaybackTracker->trackMediaType(
            $type,
            $category
        );

        return $mediaTypeId;
    }

    public function trackMediaPlaybackStart(
        $mediaId,
        $mediaLengthSeconds,
        $userId,
        $typeId,
        $currentSecond = 0,
        $secondsPlayed = 0,
        $startedOn = null,
        $contentId = null
    ): array {
        return $this->mediaPlaybackTracker->trackMediaPlaybackStart(
            $mediaId,
            $mediaLengthSeconds,
            $userId,
            $typeId,
            $currentSecond,
            $secondsPlayed,
            brand(),
            $startedOn,
            $contentId
        );
    }

    public function trackMediaPlaybackProgress(
        $sessionId,
        $secondsPlayed,
        $currentSecond,
        $lastUpdatedOn = null,
        $contentId = null
    ): bool|array|null {
        return $this->mediaPlaybackTracker->trackMediaPlaybackProgress(
            $sessionId,
            $secondsPlayed,
            $currentSecond,
            $lastUpdatedOn,
            brand(),
            $contentId
        );
    }
}
