<?php

namespace App\Jobs;

use App\Console\Commands\Infrastructure\Job;
use App\Modules\Points\Models\ExperiencePoints;
use App\Modules\RailTracker\Models\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RemoveRailTrackerDataJob extends Job
{
    public function handleJob()
    {
        $paths = ['/railtracker/media-playback-session', '/musora-api/v1/media'];
        //Requests::query()->where('url_path', 'like', '/musora-api/v1/media/%')->orWhereIn('url_path', $paths)

        for ($i = 0; $i < 200; $i++) {
            Requests::query()->where('url_path', '=', '/railtracker/media-playback-session')
                ->limit(
                    100
                )->delete();
            usleep(200000);
        }
    }
}
