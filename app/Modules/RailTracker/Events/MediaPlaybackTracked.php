<?php

namespace App\Modules\RailTracker\Events;

use App\Modules\RailTracker\Models\MediaPlaybackSession;

class MediaPlaybackTracked
{
    public function __construct(public MediaPlaybackSession $mediaPlaybackSession)
    {
    }
}
