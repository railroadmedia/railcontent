<?php

namespace App\Providers;

use Railroad\MusoraApi\Contracts\RailTrackerProviderInterface;

class RailTrackerProvider implements RailTrackerProviderInterface
{

    public function trackMediaType($type, $category)
    : string {
        // TODO: Implement trackMediaType() method.
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
        // TODO: Implement trackMediaPlaybackStart() method.
    }

    public function trackMediaPlaybackProgress($sessionId, $secondsPlayed, $currentSecond, $lastUpdatedOn = null)
    : ?array {
        // TODO: Implement trackMediaPlaybackProgress() method.
    }
}
