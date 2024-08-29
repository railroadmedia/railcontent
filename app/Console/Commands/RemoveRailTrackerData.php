<?php

namespace App\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Jobs\RemoveRailTrackerDataJob;

class RemoveRailTrackerData extends Command
{
    protected $signature = 'RemoveRailTrackerData {n}';

    public function handle(): void
    {
        $n = $this->argument("n");
        $jobs = [];
        for (
            $i = 0; $i < $n; $i++
        ) {
            $jobs[] = new RemoveRailTrackerDataJob($this, $i + 1);
        }

        $this->dispatchChainedJobs($jobs);
        $this->info("$this->name Queued $n Jobs");
    }
}
