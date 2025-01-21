<?php

namespace App\Console\Commands\Infrastructure;

use Illuminate\Support\Facades\Bus;

class BatchCancel extends Command
{
    protected $name = 'BatchCancel';
    protected $signature = 'batch:cancel {batchID}';
    protected $description = 'Cancel batched jobs';

    public function handle(): void
    {
        $batchId = $this->argument('batchID');
        $this->info("Cancelling batch '$batchId'");
        $batch = Bus::findBatch($batchId);
        $batch->cancel();
    }

}
