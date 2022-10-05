<?php

namespace App\Console\Commands\Infrastructure;

use Illuminate\Console\Command as CommandBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Laravel\SerializableClosure\SerializableClosure;

class BatchStatus extends CommandBase
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'BatchStatus';

    protected $signature = 'batch:status {batchID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get status of batched jobs';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $batchId = $this->argument('batchID');
        $batch = Bus::findBatch($batchId);
        $completedJobs = $batch->totalJobs - $batch->pendingJobs;
        Log::info("Processed $completedJobs/$batch->totalJobs {$batch->progress()}%");
    }

}
