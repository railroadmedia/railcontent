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
        for ($i = 0; $i < 20; $i++) {
            $requests = Requests::query()->select(['id'])->where('url_path', 'like', '/musora-api/v1/media/%')
                 ->limit(
                     1000
                 )->get();
            foreach ($requests as $request) {
                $request->delete();
            }
        }
    }
}
