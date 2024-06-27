<?php

namespace Modules\FeatureFlagging\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use App\Modules\FeatureFlagging\Models\Experiment;
use App\Modules\FeatureFlagging\Models\Tracking;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;

class AssignBranchForAllUsersBatchJob extends BatchQueryJob
{
    private Experiment $experiment;

    public function __construct(string $name, private int $skip, private int $take)
    {
        $this->experiment = Experiment::whereName($name)->first();
    }

    public function getSkip(): int
    {
        return $this->skip;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    /**
     * @throws Exception
     */
    public function getQuery(): Builder
    {
        return User::query();
    }

    public function handleItem($item): void
    {
        FeatureFlagging::branch($this->experiment->name, $item, handleFirstTouch: false);
    }

    public function handleAllItems($users): bool
    {
        return false;
    }
}
