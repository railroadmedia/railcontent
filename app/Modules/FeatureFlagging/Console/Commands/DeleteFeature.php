<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Feature;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class DeleteFeature extends Command
{
    protected $signature = 'featureFlag:deleteFeature {name}';

    public function handle(FeatureFlagService $ffService): void
    {
        $branch = Feature::whereName($this->argument('name'))->first();
        $ffService->deleteFeature($branch->id);
    }
}
