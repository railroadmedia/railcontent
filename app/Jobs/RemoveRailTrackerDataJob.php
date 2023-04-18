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

        for ($i = 0; $i < 100; $i++) {
            Requests::query()->where('url_path', 'like', '')->orWhereIn('url_path', $paths)
                ->limit(
                    1000
                )->delete();
            usleep(100000);
        }
    }
}
