<?php

namespace App\Modules\RailTracker\Repositories;

use App\Modules\RailTracker\Models\MediaPlaybackSessions;
use App\Modules\RailTracker\Models\MediaPlaybackTypes;

class MediaPlaybackRepository extends TrackerRepositoryBase
{

    public function sumTotalPlayed(int $userId, string $mediaId, int $mediaTypeId) : int
    {
        return MediaPlaybackSessions::query()->where('user_id', $userId)
            ->where('media_id', $mediaId)
            ->where('type_id', $mediaTypeId)
            ->sum('seconds_played');
    }

    public function getAssignmentTypeIds()
    {
        $assignmentTypeIds = MediaPlaybackTypes::query()->where('type', 'assignment')->get('id');
        return $assignmentTypeIds->pluck('id')->toArray();
    }
}
