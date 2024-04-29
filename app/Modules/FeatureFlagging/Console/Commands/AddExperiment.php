<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class AddExperiment extends Command
{
    protected $signature = 'featureFlag:addExperiment
                            {name : name of new Experiment}
                            {--default_value= : string - Default value, used when no branches exist or the Experiment is disabled}
                            {--enabled : truthsy values will set the enabled flag to true. Default true}';
    protected $description = "Add new A/B Testing Experiment";

    public function handle(FeatureFlagService $ffService): void
    {
        $ffService->addExperiment(
            $this->argument('name'),
            default_value: $this->option('default_value'),
            enabled: $this->option('enabled')
        );
    }
}
