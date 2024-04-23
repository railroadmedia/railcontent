<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Feature;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;


class EnableFeature extends Command
{
    protected $signature = 'featureFlag:enableFeature
                            {name : name of feature to enable}';

    protected $description = "Enable Feature Flag";

    public function handle(FeatureFlagService $ffService): void
    {
        $name = $this->argument('name');
        $feature = Feature::whereName($name)->first();
        if (!$feature) {
            $this->error("Invalid feature name. run showExperiments to see all branches");
            return;
        }
        $ffService->editFeature($feature->id, ['active_at' => Carbon::now()]);
        $this->info("Feature $name updated showing features");
        $this->call('featureFlag:showFeatures');
    }
}
