<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;

class ShowExperiments extends Command
{



    protected $signature = 'featureFlag:showExperiments {--name=}';

    public function handle(): void
    {
        $name = $this->option('name');
        $experiments = $name ? Experiment::whereName($name)->get() : Experiment::all();
        foreach($experiments as $experiment) {
            $this->info("$experiment->name on:$experiment->enabled default:$experiment->default_value");
            $branches = $experiment->branches()->get();
            foreach ($branches as $branch) {
                $userFilterExists = empty($branch->userid_list);
                $this->info("    $branch->name:$branch->content prio: $branch->priority hasUserFilter:$userFilterExists filter:$branch->allow_filter weight:$branch->weight");
            }
        }
    }
}
