<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Branch;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Models\Feature;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class AddRemoveUsersToBranch extends Command
{



    protected $signature = 'featureFlag:addRemoveUsersToBranch
                            {name : The name of the branch to add or remove users to/from}
                            {userids : comma-separated list of user IDs to add or remove}
                            {--add : Add Users to branch}
                            {--remove : Remove Users from branch}';

    protected $description = 'Add or Remove users to a A/B Testing Branch';

    public function handle(FeatureFlagService $ffService): void
    {
        $name = $this->argument('name');
        $userIds = $this->argument('userids');
        $add = $this->option('add');
        $remove = $this->option('remove');
        if (!($add XOR $remove)) {
            $this->error("Only one of --add or --remove must be included");
            return;
        }
        $branch = Branch::whereName($name)->first();
        if (!$branch) {
            $this->error("Invalid branch name. Run showExperiments to see all branches");
            return;
        }
        $userIds = explode(',', $userIds);
        $existingIds = $branch->userid_list ? explode(',', $branch->userid_list) : [];
        if ($add) {
            $userid_list = array_merge($existingIds, $userIds);
            $userid_list = array_unique($userid_list);
        } else {
            $userid_list = array_diff($existingIds, $userIds);
        }
        $ffService->editBranch($branch->id, ['userid_list' => $userid_list]);
    }
}
