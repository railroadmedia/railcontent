<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class ToggleExperiment extends Command
{
    protected $signature = 'featureFlag:toggleExperiment
                            {name : name of experiment to toggle }
                            {enabled : a truthsy value will set the experiment enabled}';
    protected $description = "Enable or Disable A/B Testing Experiment";

    public function handle(FeatureFlagService $ffService): void
    {
        $experiment = Experiment::whereName($this->argument('name'))->first();
        if (!$experiment) {
            $this->error("Invalid experiment name. run showExperiments to see all branches");
            return;
        }
        $ffService->setExperimentEnabled($experiment->id, $this->argument('enabled'));
    }
}
