<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Models\Branch;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;
use Illuminate\Database\Eloquent\Builder;

class EditBranch extends Command
{
    protected $signature = 'featureFlag:editBranch
                            {name : name of branch to edit}
                            {experiment : name of the experiment}
                            {--content= : new content value}
                            {--weight= : new weight value}
                            {--priority= : new priority value}
                            {--allow_filter= : comma separated filters, will replace existing}
                            {--userid_list= : comma separated userids, will replace exsiting}';
    protected $description = "Edit A/B Testing Branch values";

    public function handle(FeatureFlagService $ffService): void
    {
        $name = $this->argument('name');
        $experiment = $this->argument('experiment');
        $branch = Branch::whereName($name)
            ->whereHas('experiment', fn (Builder $query) => $query->where('name', $experiment))
            ->first();
        if (!$branch) {
            $this->error("Invalid branch name. run showExperiments to see all branches");
            return;
        }
        $valuesToUpdate = [];
        $allOptions = $this->options();
        $builtInOptions = $this->getApplication()->getDefinition()->getOptions();
        $onlyMyOptions = array_diff_key($allOptions, $builtInOptions);
        $this->info("Updating Branch: $name");
        foreach($onlyMyOptions as $key => $value) {
            if (!is_null($value)) {
                $valuesToUpdate[$key] = $value;
                $val = $branch[$key];
                $this->info("$key: $val -> $value");
            }
        }
        $ffService->editBranch($branch->id, $valuesToUpdate);
        $this->info("Branch updated showing all Experiments");
        $this->info('--------------------------------------');
        $this->call('featureFlag:showExperiments');
    }
}
