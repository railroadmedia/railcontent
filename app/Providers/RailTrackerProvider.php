<?php

namespace App\Providers;

use Railroad\MusoraApi\Contracts\RailTrackerProviderInterface;
use Railroad\Railtracker\Trackers\MediaPlaybackTracker;

class RailTrackerProvider implements RailTrackerProviderInterface
{
private MediaPlaybackTracker $mediaPlaybackTracker;

    /**
     * @param MediaPlaybackTracker $mediaPlaybackTracker
     */
    public function __construct(MediaPlaybackTracker $mediaPlaybackTracker)
    {
        $this->mediaPlaybackTracker = $mediaPlaybackTracker;
    }

    public function trackMediaType($type, $category)
    : string {
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
        $startedOn = null
    )
    : array {

        return $this->mediaPlaybackTracker->trackMediaPlaybackStart(
            $mediaId,
            $mediaLengthSeconds,
            $userId,
            $typeId,
            $currentSecond
        );
    }

    public function trackMediaPlaybackProgress($sessionId, $secondsPlayed, $currentSecond, $lastUpdatedOn = null)
    : ?array {
        return  $this->mediaPlaybackTracker->trackMediaPlaybackProgress(
            $sessionId,
            $secondsPlayed,
            $currentSecond
        );
    }
}
