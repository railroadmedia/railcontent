<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class AddFeature extends Command
{



    protected $signature = 'featureFlag:addFeature {name} {--description=} {--active_at=} {--allowFilter=} {--userid_list=} ';

    public function handle(FeatureFlagService $ffService): void
    {
        $ffService->addFeature(
            $this->argument('name'),
            active_at: $this->option('active_at'),
            description: $this->option('description'),
            allow_filter: $this->option('allowFilter'),
            userid_list: $this->option('userid_list')
        );
    }
}
