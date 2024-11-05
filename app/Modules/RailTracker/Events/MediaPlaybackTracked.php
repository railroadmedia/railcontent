<?php

namespace App\Modules\RailTracker\Events;

class MediaPlaybackTracked
{
    public function __construct(
        public int $id,
        public string $mediaId,
        public int $mediaLengthInSeconds,
        public ?int $userId,
        public int $typeId,
        public int $secondsPlayed,
        public int $currentSecond,
        public string $startedOn,
        public string $lastUpdatedOn,
        public ?string $brand = null,
        public ?int $contentId = null
    ) {
    }
}
