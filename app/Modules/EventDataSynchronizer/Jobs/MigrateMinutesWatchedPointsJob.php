<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\Job;
use App\Modules\Points\Models\ExperiencePoints;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MigrateMinutesWatchedPointsJob extends Job
{
    public function handleJob()
    {
        $points = ExperiencePoints::query()->where('trigger_name', '=', 'minutes_of_content_watched')
            ->limit(
                10000
            )->get();

        $pointCache = [];
        foreach ($points as $point) {
            try {
                /** @var ExperiencePoints $point */
                $unserialized = unserialize($point->trigger_hash_data);
                $contentId = $unserialized["content_id"];
                $data = serialize([
                    'content_id' => $contentId,
                    'minutes_watched' => 'all'
                ]);
                $hash = md5($data);

                $existingPoint = $pointCache[$point->user_id . $hash] ?? null;
                if (!$existingPoint) {
                    /** @var ExperiencePoints $existingPoint */
                    $existingPoint = ExperiencePoints::query()
                        ->where('user_id', '=', $point->user_id)
                        ->where('trigger_name', '=', 'minutes_of_content_watched_v2')
                        ->where('trigger_hash', '=', $hash)->first();
                }

                if ($existingPoint == null) {
                    $point->trigger_name = 'minutes_of_content_watched_v2';
                    $point->trigger_hash = $hash;
                    $point->trigger_hash_data = $data;
                    $point->points_description = null;
                    $point->save();
                    $pointCache[$point->user_id . $hash] = $point;
                } else {
                    if ($point->trigger_name != 'minutes_of_content_watched2') {
                        $existingPoint->points += $point->points;
                        $existingPoint->updated_at = Carbon::now();
                        $existingPoint->save();
                    }
                    $point->delete();
                }
            } catch (\Throwable $e) {
                Log::error("Error migrating point $point->id $hash");
            }
        }
    }
}
