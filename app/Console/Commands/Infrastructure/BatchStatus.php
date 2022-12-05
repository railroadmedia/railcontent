<?php

namespace App\Console\Commands\Infrastructure;

use Illuminate\Support\Facades\Bus;

class BatchStatus extends Command
{
    protected $name = 'BatchStatus';
    protected $signature = 'batch:status {batchID}';
    protected $description = 'Get status of batched jobs';

    public function handle()
    {
        $batchId = $this->argument('batchID');
        $batch = Bus::findBatch($batchId);
        $completedJobs = $batch->totalJobs - $batch->pendingJobs;
        $this->info("Processed $completedJobs/$batch->totalJobs {$batch->progress()}%");
    }

}
