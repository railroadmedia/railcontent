<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;


class ToggleExperiment extends Command
{
    protected $signature = 'featureFlag:toggleExperiment {name} {enabled}';

    public function handle(FeatureFlagService $ffService): void
    {
        $experiment = Experiment::whereName($this->argument('name'))->first();
        if (!$experiment) {
            $this->error("Invalid experiment name. run showExperiments to see all branches");
            return;
        }
        $ffService->setExperimentEnabled($experiment->id,$this->argument('enabled'));
    }
}
