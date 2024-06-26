<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;
use Modules\FeatureFlagging\Jobs\AssignBranchForAllUsersBatchJob;

class ProcessAllUsersForExperiment extends Command
{
    protected $signature = 'featureFlag:processAllUsersForExperiment
                            {name : The name of the experiment to process}';

    protected $description = 'Process all users for a given experiment.';

    public function handle(): void
    {

        $name = $this->argument('name');
        $experiment = Experiment::whereName($name)->first();
        if (!$experiment) {
            $this->error("Invalid experiment name. Run showExperiments to see all experiments");
            return;
        }
        $this->runBatchQuery(
            function (int $skip, int $take) use ($name) {
                return new AssignBranchForAllUsersBatchJob(
                    $name,
                    $skip,
                    $take,
                );
            },
            queue: 'command'
        );
    }
}
