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
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogsShopify;

    protected EcommerceEntityManager $entityManager;
    protected Shopify $shopify;

    /**
     * @param bool $execute are we executing this process, or simulating?
     */
    public function __construct(protected bool $execute)
    {
    }

    public function handle(EcommerceEntityManager $entityManager, Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->entityManager = $entityManager;
        $this->shopify = $shopify;

        $emails = $this->getEmailOfCustomersToCreate();

        $chunkSize = 500;
        $this->logInfo(sprintf("Found %s customers to be created in Shopify.", $emails->count()));
        $this->logInfo("Dispatching jobs to sync customers ...");

        $chunks = $emails->chunk($chunkSize);
        $chunks->each(function (Collection $emailAddresses) {
            BulkCustomerCreateFromCustomers::dispatchSync($emailAddresses, $this->execute);
        });
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
        // if ($this->getLimit()) {
        //     $qb->setMaxResults($this->getLimit());
        // }

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
