<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Feature;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class DeleteFeature extends Command
{
    protected $signature = 'featureFlag:deleteFeature
                            {name : name of Feature to delete}';
    protected $description = 'Delete FeatureFlag. This will effectively enable the feature for all users.';

    public function handle(FeatureFlagService $ffService): void
    {
        $branch = Feature::whereName($this->argument('name'))->first();
        $ffService->deleteFeature($branch->id);
    }
}
