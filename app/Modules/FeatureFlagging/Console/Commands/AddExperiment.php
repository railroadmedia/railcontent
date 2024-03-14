<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class AddExperiment extends Command
{



    protected $signature = 'featureFlag:addExperiment {name} {--default_value=} {--enabled}';

    public function handle(FeatureFlagService $ffService): void
    {
        $ffService->addExperiment(
            $this->argument('name'),
            default_value: $this->argument('default_value'),
            enabled: $this->argument('enabled')
        );
    }
}
