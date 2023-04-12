<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Console\Commands\Infrastructure\Job;
use App\Modules\Points\Models\ExperiencePoints;
use Carbon\Carbon;

class MigrateMinutesWatchedPointsJob extends Job
{
    public function handleJob()
    {
        $points = ExperiencePoints::query()->where('trigger_name', '=', 'minutes_of_content_watched')
            ->limit(
                10000
            )->get();
        foreach ($points as $point) {
            /** @var ExperiencePoints $point */
            $unserialized = unserialize($point->trigger_hash_data);
            $contentId = $unserialized["content_id"];
            $data = serialize([
                'content_id' => $contentId,
                'minutes_watched' => 'all',
            ]);
            $hash = md5($data);

            /** @var ExperiencePoints $existingPoint */
            $existingPoint = ExperiencePoints::query()
                ->where('user_id', '=', $point->user_id)
                ->where('trigger_name', '=', 'minutes_of_content_watched2')
                ->where('trigger_hash', '=', $hash)->first();

            if ($existingPoint == null) {
                $point->trigger_name = 'minutes_of_content_watched2';
                $point->trigger_hash = $hash;
                $point->trigger_hash_data = $data;
                $point->points_description = null;
                $point->save();
            } else {
                $existingPoint->points += $point->points;
                $existingPoint->updated_at = Carbon::now();
                $existingPoint->save();
                $point->delete();
            }
        }
    }
}
