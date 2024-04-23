<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class AddBranch extends Command
{



    protected $signature = 'featureFlag:addBranch
                            {name : name of Branch}
                            {experimentName : name of Parent Experiment}
                            {content : string - content value}
                            {--weight= : int - weight value}
                            {--priority= : int - priority value}
                            {--allow_filter= : comma separated filters}
                            {--userid_list= : comma separated userids}';
    protected $description = "Add new A/B Testing Branch";

    public function handle(FeatureFlagService $ffService): void
    {
        $experiment = Experiment::whereName($this->argument('experimentName'))->first();
        $ffService->addBranch(
            $this->argument('name'),
            $this->argument('content'),
            $experiment->id,
            priority: $this->option('priority'),
            allow_filter: $this->option('allow_filter'),
            weight: $this->option('weight'),
            userid_list: $this->option('userid_list')
        );
    }
}
