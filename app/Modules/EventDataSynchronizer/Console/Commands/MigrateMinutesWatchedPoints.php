<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Points\Models\ExperiencePoints;
use Carbon\Carbon;

class MigrateMinutesWatchedPoints extends Command
{
    protected $signature = 'MigrateMinutesWatchedPoints';

    public function handle()
    {
        $timeStart = microtime(true);
        $this->info("$this->name Processing");
        $rowsProcessed = 0;
        do {
            $points = ExperiencePoints::query()->where('trigger_name', '=', 'minutes_of_content_watched')->limit(
                1000
            )->get();
            foreach ($points as $point) {
                /** @var ExperiencePoints $point */
                $unserialized = unserialize($point->trigger_hash_data);
                $contentId = $unserialized["content_id"];
                $data = serialize([
                    'content_id' => $contentId,
                    'minutes_watched' => 'total',
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
                    $point->points_description = 'Awarded points for every minute of video watched.';
                    $point->save();
                } else {
                    $existingPoint->points += $point->points;
                    $existingPoint->updated_at = Carbon::now();
                    $existingPoint->save();
                    $point->delete();
                }
                $rowsProcessed += 1;
            }

            $diff = microtime(true) - $timeStart;
            $sec = intval($diff);
            $this->info("$rowsProcessed Rows Processed ($sec s)");
        } while ($points->count() > 0);

        $this->info("$rowsProcessed Rows Processed");

        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $this->info("$this->name Finished ($sec s)");
    }
}
