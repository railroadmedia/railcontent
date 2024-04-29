<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Branch;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Models\Feature;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class AddRemoveUsersToFeature extends Command
{



    protected $signature = 'featureFlag:addRemoveUsersToFeature
                            {name : The name of the Feature to add or remove users to/from}
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
        $feature = Feature::whereName($name)->first();
        if (!$feature) {
            $this->error("Invalid feature name. Run showFeatures to see all features");
            return;
        }
        $userIds = explode(',', $userIds);
        $existingIds = $feature->userid_list ? explode(',', $feature->userid_list) : [];
        if ($add) {
            $userid_list = array_merge($existingIds, $userIds);
            $userid_list = array_unique($userid_list);
        } else {
            $userid_list = array_diff($existingIds, $userIds);
        }
        $ffService->editFeature($feature->id, ['userid_list' => $userid_list]);
    }
}
