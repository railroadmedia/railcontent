<?php

namespace App\Modules\Ecommerce\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class UnifySubscriptionsJob extends BatchQueryJob
{
    private int $skip;
    private int $take;

    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
    }

    function getSkip(): int
    {
        return $this->skip;
    }

    function getTake(): int
    {
        return $this->take;
    }

    function getQuery(): Builder
    {
        return User::query()->limit(200)->where('id', '<', 600000);
    }

    /**
     * @param User $item
     * @return void
     */
    function handleItem($item): void
    {
        //Log::debug("handleItem $item->id");
    }

}
