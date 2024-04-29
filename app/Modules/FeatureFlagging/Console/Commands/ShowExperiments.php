<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;

class ShowExperiments extends Command
{
    protected $signature = 'featureFlag:showExperiments
                            {--name= : Experiment to output; if missing, output all experiments and branches.}';
    protected $description = 'Show All A/B Testing Experiments and their Children Branches.';

    public function handle(): void
    {
        $name = $this->option('name');
        $experiments = $name ? Experiment::whereName($name)->get() : Experiment::all();
        foreach($experiments as $experiment) {
            $rows = [];
            $this->info("Experiment $experiment->name enabled:$experiment->enabled default value:$experiment->default_value");
            $this->info("Branches:");
            $branches = $experiment->branches()->get();
            foreach ($branches as $branch) {
                $userFilterExists = empty($branch->userid_list) ? "N" : "Y";
                $rows[] =  [$branch->name, $branch->content, $branch->priority, $userFilterExists, $branch->allow_filter, $branch->weight];
            }
            $this->table(['Branch Name', 'Content', 'Priority', 'Has User Filter', 'Filter', 'Weight'], $rows);
        }
    }
}
