<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Models\Feature;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class DeleteExperiment extends Command
{



    protected $signature = 'featureFlag:deleteExperiment {name}';

    public function handle(FeatureFlagService $ffService): void
    {
        $branch = Experiment::whereName($this->argument('name'))->first();
        $ffService->deleteExperiment($branch->id);
    }
}
