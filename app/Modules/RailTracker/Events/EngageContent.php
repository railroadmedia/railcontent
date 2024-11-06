<?php

namespace App\Modules\RailTracker\Events;

class EngageContent
{
    public function __construct(
        public int $contentId,
        public int $userId,
        public ?int $parentContentId = null,
        public ?int $parentPlaylistId = null
    ) {
    }
}
