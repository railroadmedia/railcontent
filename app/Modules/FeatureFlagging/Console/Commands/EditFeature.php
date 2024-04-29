<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Feature;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class EditFeature extends Command
{



    protected $signature = 'featureFlag:editFeature
                            {name : name of feature to edit}
                            {--description= : new description value}
                            {--active_at= : datetime string eg: "2024-04-19 16:02:37"}
                            {--allow_filter= : comma separated list of filters,  will replace existing}
                            {--userid_list= : comma separated list of user ids, will replace existing} ';

    protected $description = "Edit FeatureFlag values";

    public function handle(FeatureFlagService $ffService): void
    {
        $name = $this->argument('name');
        $feature = Feature::whereName($name)->first();
        if (!$feature) {
            $this->error("Invalid feature name. run showExperiments to see all branches");
            return;
        }
        $valuesToUpdate = [];
        $allOptions = $this->options();
        $builtInOptions = $this->getApplication()->getDefinition()->getOptions();
        $onlyMyOptions = array_diff_key($allOptions,$builtInOptions);
        $this->info("Updating Feature $name");
        foreach($onlyMyOptions as $key=>$value) {
            if (!is_null($value)) {
                $valuesToUpdate[$key] = $value;
                $val = $feature[$key];
                $this->info("Updating $key: $val -> $value");
            }
        }
        $ffService->editFeature($feature->id, $valuesToUpdate);
        $this->info("Feature $name updated showing features");
        $this->info('--------------------------------------');
        $this->call("featureFlag:showFeatures $name");
    }
}
