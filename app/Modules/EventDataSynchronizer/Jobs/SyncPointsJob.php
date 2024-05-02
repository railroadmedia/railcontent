<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App;
use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\EventDataSynchronizer\Providers\UserProviderInterface;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserManagementSystem\Models\User;
use Railroad\Points\Services\UserPointsService;

class SyncPointsJob extends BatchQueryJob
{
    private int $skip;
    private int $take;
    private UserProviderInterface $userProvider;
    private UserPointsService $userPointsService;

    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
        $this->userProvider = App::make(UserProviderInterface::class);
        $this->userPointsService = App::make(UserPointsService::class);
    }

    public function getSkip(): int
    {
        return $this->skip;
    }

    public function getTake(): int
    {
        return $this->take;
    }

    public function getQuery(): Builder
    {
        return User::query();
    }

    public function handleItem($item): void
    {
        $userId = $item->id;
        $this->userProvider->saveExperiencePoints(
            $userId,
            $this->userPointsService->countUserPointsPerBrand(
                $userId
            )
        );
        usleep(10000);
    }
}
