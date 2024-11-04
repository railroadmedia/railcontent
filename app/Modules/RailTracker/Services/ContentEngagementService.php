<?php

namespace App\Modules\RailTracker\Services;

use App\Modules\Tracker\Models\LastEngagedSeconds;

class ContentEngagementService
{
    public function update(int $userId, int $contentId, int $currentSecond)
    {
        try {
            if ($currentSecond == 0) {
                LastEngagedSeconds::query()->where('user_id', '=', $userId)
                    ->where('content_id', '=', $contentId)->delete();
            } else {
                $row = LastEngagedSeconds::query()->where('user_id', '=', $userId)
                    ->where('content_id', '=', $contentId)->first();
                if (!$row) {
                    $row = new LastEngagedSeconds();
                    $row->user_id = $userId;
                    $row->content_id = $contentId;
                }
                $row->resume_time_seconds = $currentSecond;
                $row->save();
            }
        } catch(\Throwable $e) {
            //Log::error($e);
        }
    }
}
