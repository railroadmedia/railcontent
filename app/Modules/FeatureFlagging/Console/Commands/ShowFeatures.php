<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Feature;

class ShowFeatures extends Command
{
    protected $signature = 'featureFlag:showFeatures';
    protected $description = 'Show FeatureFlags';

    public function handle(): void
    {
        $features = Feature::all();
        $rows = [];
        foreach($features as $feature) {
            $userFilterExists = empty($feature->userid_list) ? "N" : "Y";
            $rows[] = [$feature->name, $feature->active_at, $userFilterExists, $feature->allow_filter];

        }
        $this->table(["Name", "Active At", "Has User Filter", "Allow Filter"], $rows);
    }
}
