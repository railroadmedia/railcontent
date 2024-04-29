<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Branch;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class DeleteBranch extends Command
{
    protected $signature = 'featureFlag:deleteBranch
                            {name : name of Branch to delete}';

    protected $description = "Delete A/B Testing Branch. This will also delete any database references for existing users, who will be reassigned next time then engage with the Test";

    public function handle(FeatureFlagService $ffService): void
    {
        $branch = Branch::whereName($this->argument('name'))->first();
        $ffService->deleteBranch($branch->id);
    }
}
