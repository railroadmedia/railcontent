<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Branch;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class DeleteBranch extends Command
{



    protected $signature = 'featureFlag:deleteBranch {name}';

    public function handle(FeatureFlagService $ffService): void
    {
        $branch = Branch::whereName($this->argument('name'))->first();
        $ffService->deleteBranch($branch->id);
    }
}
