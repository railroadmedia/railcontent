<?php

namespace Modules\FeatureFlagging\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\FeatureFlagging\Services\FeatureFlagService;

class AddFeature extends Command
{
    protected $signature = 'featureFlag:addFeature
                            {name : name of new Feature}
                            {--description= : description value}
                            {--active_at= : datetime string eg: "2024-04-19 16:02:37"}
                            {--allow_filter= : comma separated list of filters}
                            {--block_filter= : comma separated list of filters}
                            {--userid_list= : comma separated list of user ids} ';
    protected $description = "Add New Feature Flag";

    public function handle(FeatureFlagService $ffService): void
    {
        $ffService->addFeature(
            $this->argument('name'),
            active_at: $this->option('active_at'),
            description: $this->option('description'),
            allow_filter: $this->option('allow_filter'),
            block_filter: $this->option('block_filter'),
            userid_list: $this->option('userid_list')
        );
    }
}
