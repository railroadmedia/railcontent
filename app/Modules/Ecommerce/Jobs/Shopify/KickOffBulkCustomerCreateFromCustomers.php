<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use Doctrine\ORM\QueryBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Railroad\Ecommerce\Entities\Customer;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Signifly\Shopify\Shopify;

/**
 * KickOffBulkCustomerCreateFromCustomers kicks off the process to perform a bulk operation in Shopify to create new
 * customers, using data from our customers that have not yet been synced. This is done through a job so that we can
 * offload the process and free up the calling command.
 */
class KickOffBulkCustomerCreateFromCustomers implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use LogsShopify;
    use Queueable;
    use SerializesModels;

    protected EcommerceEntityManager $entityManager;
    protected Shopify $shopify;

    // we don't want retries
    public $tries = 1;

    /**
     * @param bool $execute are we executing this process, or simulating?
     * @param int|null $limit an optional limit of the number of customers to sync
     */
    public function __construct(protected bool $execute, protected ?int $limit)
    {
    }

    public function handle(EcommerceEntityManager $entityManager, Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->entityManager = $entityManager;
        $this->shopify = $shopify;

        $emails = $this->getEmailOfCustomersToCreate();

        $batchSize = 500;
        $totalCount = $emails->count();
        $infoString = sprintf("Found %s customer accounts to be created in Shopify.", $totalCount);
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
        $this->logInfo("Dispatching jobs to sync customers ...");

        $chunks = $emails->chunk($batchSize);
        //DEV NOTE: we can't just chunk the collection and dispatch the job within it, because this kick off job will time out
        $jobs = [];
        $totalCountForRun = is_null($this->limit) ? $totalCount : min($totalCount, $this->limit);
        $runningTotal = 0;
        $chunks->each(function (Collection $emailAddresses) use ($totalCountForRun, $batchSize, &$runningTotal, &$jobs) {
            $jobs[] = new BulkCustomerCreateFromCustomers($emailAddresses, $this->execute);

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
     * Get the email addresses of all customers to create in Shopify
     * DEV NOTE: we start by getting the emails so that we can group the customers and use all entities to create
     * the singular customer in Shopify
     *
     * @return Collection
     */
    private function getEmailOfCustomersToCreate(): Collection
    {
        $qb = new QueryBuilder($this->entityManager);
        $qb->select("c.email")
            ->from(Customer::class, "c", null)
            ->where(
                $qb->expr()
                    ->isNull("c.shopifyId")
            )
            ->distinct();

        // if we add in limits, use this
        if ($this->limit) {
            $qb->setMaxResults($this->limit);
        }

        $q = $qb->getQuery();

        // DEV NOTE: We have about 35,000 unique customer email addresses in the DB, so it should be safe to simply
        // wrap the results in the collection and work with that, to simplify things
        return collect($q->getSingleColumnResult());
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncBulkCustomersToShopify";
    }
}
