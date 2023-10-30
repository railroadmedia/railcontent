<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Models\ShopifySync;
use App\Modules\Ecommerce\Jobs\Shopify\SyncUsersToShopifyJobManager;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class SyncUsersToShopifyDispatcher extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-users
                            {--startingId= : (Optional) The user Id to start processing at}
                            {--limit= : (Optional) The number of users to limit this run to.}
                            {--since= : (Optional) The ISO 8601 date time to sync all changes since. e.g. 2023-10-13T17:03:25+00:00}
                            {--fresh : Sync all users, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our users and any related customers up to Shopify';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Throwable
     */
    public function handle(): int
    {
        $simulate = $this->option("execute") == false;
        $fresh = $this->option("fresh");
        $startingId = $this->option("startingId");
        $limit = $this->option("limit");
        $lastSyncAt = $this->getDateTimeOfLastSync();

        // find all users that need to be synced
        $users = User::query()
            ->when(!is_null($startingId), function (Builder $q) use ($startingId) {
                return $q->where("id", ">=", $startingId);
            })
            ->where(function (Builder $q) use ($lastSyncAt, $fresh) {
                $q->when(!$fresh, function (Builder $q) use ($lastSyncAt) {
                    return $q->whereNull("shopify_id")
                        ->orWhereDate("updated_at", ">", $lastSyncAt);
                });
            })
            ->select("id");
        $userCount = $users->count();
        $batchSize = 500;
        $jobs = [];

        $this->info(
            "SyncUsersToShopify: Preparing to chunk users into jobs for SyncUsersToShopifyJobManager. Please wait..."
        );
        $startAt = Carbon::now();
        if ($limit) {
            $userCount = min($limit, $userCount);
            // chunk doesn't use a limit set in the query, so we'll work around that by keeping track of the count internally
            $isAtLimit = false;
            $tally = 0;
            $users->chunk(
                $batchSize,
                function ($userIds) use (
                    $lastSyncAt,
                    $limit,
                    &$isAtLimit,
                    $batchSize,
                    $simulate,
                    $fresh,
                    &$jobs,
                    &$tally
                ) {
                    if ($isAtLimit) {
                        return false;
                    }

                    $tally += $batchSize;
                    $remaining = $limit - $tally;
                    if ($remaining <= 0) {
                        $isAtLimit = true;
                        $toGet = $tally + $remaining;
                        $userIds = $userIds->take($toGet);
                    }

                    $firstUserId = $userIds->first()->id;
                    $lastUserId = $userIds->last()->id;
                    $jobs[] = new SyncUsersToShopifyJobManager(
                        $firstUserId,
                        $lastUserId,
                        $lastSyncAt,
                        $simulate,
                        $fresh
                    );
                }
            );
        } else {
            // step through the chunks of user ids to sync, and add a job to process each chunk
            $users->chunk($batchSize, function ($userIds) use ($lastSyncAt, $simulate, $fresh, &$jobs) {
                $firstUserId = $userIds->first()->id;
                $lastUserId = $userIds->last()->id;
                $jobs[] = new SyncUsersToShopifyJobManager(
                    $firstUserId,
                    $lastUserId,
                    $lastSyncAt,
                    $simulate,
                    $fresh
                );
            });
        }
        $this->info(
            sprintf(
                "SyncUsersToShopify: Completed chunking users into jobs for SyncUsersToShopifyJobManager in %s seconds.",
                $startAt->diffInSeconds()
            )
        );

        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(sprintf("SyncUsersToShopify: Completed in %s seconds", $startAt->diffInSeconds()));
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();
        $this->info(
            sprintf(
                "SyncUsersToShopify: Batch ID %s dispatched with %s %s to sync %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
                $userCount,
                Str::plural("user", $userCount)
            )
        );

        return self::SUCCESS;
    }

    /**
     * Get the date and time that this resource was last synced up to Shopify
     *
     * @return Carbon
     */
    protected function getDateTimeOfLastSync(): Carbon
    {
        $override = $this->getLastSyncAtOverride();
        if (!is_null($override)) {
            return $override;
        }

        $sync = ShopifySync::where("resource", ShopifySync::RESOURCE_CUSTOMER)->latestFinished()->first();
        return $sync?->finished_at ?? Carbon::createFromTimestamp(0);
    }

    /**
     * Get the optional override of when this entity was last synced to Shopify
     *
     * @return Carbon|null
     */
    protected function getLastSyncAtOverride(): null|Carbon
    {
        $override = $this->option("since");
        if (!is_null($override)) {
            return new Carbon($override);
        }
        return null;
    }
}
