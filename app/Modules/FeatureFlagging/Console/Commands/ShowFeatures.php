<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Feature;

class ShowFeatures extends Command
{

    protected $signature = 'featureFlag:showFeatures ';

    public function handle(): void
    {
        $features = Feature::all();
        foreach($features as $feature) {
            $userFilterExists = empty($feature->userid_list);
            $this->info("$feature->name active:$feature->active_at hasUserFilter:$userFilterExists filter:$feature->allow_filter");
        }
    }
}
