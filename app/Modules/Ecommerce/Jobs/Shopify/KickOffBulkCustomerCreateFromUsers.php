<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Repositories\AddressRepository;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Signifly\Shopify\Shopify;

/**
 * KickOffBulkCustomerCreateFromUsers kicks off the process to perform a bulk operation in Shopify to create new
 * customers, using data from our users that have not yet been synced. This is done through a job so that we can offload
 * the process and free up the calling command.
 */
class KickOffBulkCustomerCreateFromUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogsShopify;

    protected CustomerRepository $customerRepository;
    protected AddressRepository $addressRepository;
    protected Shopify $shopify;

    // we don't want retries
    public $tries = 1;

    /**
     * @param bool $execute are we executing this process, or simulating?
     * @param int|null $limit an optional limit of the number of users to sync
     */
    public function __construct(protected bool $execute, protected ?int $limit)
    {
    }

    public function handle(CustomerRepository $customerRepository, AddressRepository $addressRepository, Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->shopify = $shopify;

        $usersToCreate = $this->getUsersToCreateQuery();
        $batchSize = 500;
        $totalCount = $usersToCreate->count();
        $infoString = sprintf("Found %s users to be created in Shopify.", $totalCount);
        if ($this->limit) {
            if ($this->limit % $batchSize) {
                $oldLimit = $this->limit;
                $this->limit = $batchSize * ceil($this->limit / $batchSize);
                $infoString .= sprintf(" Limit %s selected, but increased to %s for batching.", $oldLimit, $this->limit);
            }
            $infoString .= sprintf(" Limiting to %s.", $this->limit);
        }
        $infoString .= sprintf(" Performing in batches of %s.", $batchSize);
        $this->logInfo($infoString);
        $this->logInfo("Dispatching jobs to sync users ...");

        //DEV NOTE: we can't just chunk the collection and dispatch the job within it, because this kickoff job
        // will time out, so pass the information into the next job to perform the query within itself
        $jobs = [];
        $totalCountForRun = is_null($this->limit) ? $totalCount : min($totalCount, $this->limit);
        $runningTotal = 0;
        $this->getUserIdRangesToCreate($batchSize)->each(function (int $userId) use ($totalCountForRun, $batchSize, &$runningTotal, &$jobs){
            $jobs[] = new BulkCustomerCreateFromUsers($userId, $batchSize, $this->execute);

            if ($this->limit) {
                $runningTotal += $batchSize;
                if ($runningTotal >= $totalCountForRun) {
                    return false;
                }
            }
        });
        Bus::chain($jobs)->dispatch();
    }

    /**
     * Get the query builder that we'll use to get all users to create in Shopify
     *
     * @return Builder
     */
    private function getUsersToCreateQuery(): Builder
    {
        return User::query()
            ->whereNull("shopify_id");
    }

    /**
     * Get a collection of User IDs to start each batch of users in the BulkCustomerCreateFromUsers job
     *
     * @param int $batchSize
     * @return Collection
     */
    private function getUserIdRangesToCreate(int $batchSize): Collection
    {
        $firstIds = collect();
        User::query()
            ->whereNull("shopify_id")
            ->select("id")
            ->orderBy("id")
            ->chunkById($batchSize, function(Collection $users) use ($firstIds) {
                $firstIds->push($users->first()->id);
            });
        return $firstIds;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncBulkUsersToShopify";
    }
}
