<?php

namespace App\Modules\EventDataSynchronizer\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\EventDataSynchronizer\Jobs\MigrateMinutesWatchedPointsJob;
use App\Modules\Points\Models\ExperiencePoints;
use Carbon\Carbon;

class MigrateMinutesWatchedPoints extends Command
{
    protected $signature = 'MigrateMinutesWatchedPoints {n}';

    public function handle(): void
    {
        $n = $this->argument("n");
        $jobs = [];
        for (
            $i = 0; $i < $n; $i++
        ) {
            $jobs[] = new MigrateMinutesWatchedPointsJob($this, $i + 1);
        }

        $this->dispatchChainedJobs($jobs);
        $this->info("$this->name Queued $n Jobs");
    }
}
