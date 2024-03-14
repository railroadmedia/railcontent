<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class AddBranch extends Command
{



    protected $signature = 'featureFlag:addBranch {branchName} {experimentName} {content} {--weight=} {--priority=} {--allow_filter=} {--userid_list=} ';

    public function handle(FeatureFlagService $ffService): void
    {
        $this->argument('experimentName');
        $experiment = Experiment::whereName($this->argument('experimentName'))->first();
        $ffService->addBranch(
            $this->argument('branchName'),
            $this->argument('content'),
            $experiment->id,
            priority: $this->option('priority'),
            allow_filter: $this->option('allow_filter'),
            weight: $this->option('weight'),
            userid_list: $this->option('userid_list')
        );
    }
}
