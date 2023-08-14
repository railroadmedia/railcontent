<?php

namespace App\Console\Commands\Traits;

use App\Models\ShopifySync;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\REST\Resources\CustomerResource;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\REST\Resources\ProductResource;
use Signifly\Shopify\Shopify;

trait SyncsToShopify
{
    protected Shopify $shopify;
    protected ShopifySync $shopifySync;

    /**
     * Perform the sync action up to Shopify, with this class' type of resource
     *
     * @return int
     */
    protected function sync(): int
    {
        // ensure this trait is only used by a Command, so that we can leverage the Command functionality
        assert($this instanceof Command);

        $simulate = $this->getIsSimulation();
        $fresh = $this->getIsFresh();

        if ($simulate) {
            $this->info("Executing in simulation mode. No changes will be made to the database.  Use --execute to run for real.");
        }

        if ($fresh) {
            $this->info(
                sprintf("Performing a fresh sync. All ecommerce %s will be sent to Shopify.",
                Str::plural($this->getSyncResource()))
            );
        }

        $this->createSyncLog();

        try {
            $shopifyIds = $this->syncResource($simulate, $fresh);
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        }

        $this->finishSyncLog($shopifyIds);

        return self::SUCCESS;
    }

    /**
     * Create a log for this sync
     *
     * @return void
     */
    protected function createSyncLog(): void
    {
        if (!$this->getIsSimulation()) {
            $this->shopifySync = ShopifySync::create([
                "resource" => $this->getSyncResource(),
                "started_at" => Carbon::now()
            ]);
        }
    }

    /**
     * Finish the sync log and store the Shopify IDs
     *
     * @param Collection $shopifyIds
     * @return void
     */
    protected function finishSyncLog(Collection $shopifyIds): void
    {
        if (!$this->getIsSimulation()) {
            $this->shopifySync->update([
                "finished_at" => Carbon::now(),
                "shopify_ids" => $shopifyIds->toArray()
            ]);
        }
    }

    /**
     * Get the date and time that this resource was last synced up to Shopify
     *
     * @return Carbon
     */
    protected function getDateTimeOfLastSync(): Carbon
    {
        $sync = ShopifySync::where("resource", $this->getSyncResource())->latestFinished()->first();
        return $sync?->finished_at ?? Carbon::createFromTimestamp(0);
    }

    /**
     * Get all ecommerce entities of this resource that need to be synced
     *
     * @param bool $fresh
     * @return Collection
     */
    protected function getEcommerceEntities(bool $fresh) : Collection
    {
        $qb = $this->getEcommerceEntityRepository()->createQueryBuilder('entity');

        if (!$fresh) {
            $lastSyncAt = $this->getDateTimeOfLastSync();
            $this->info(
                sprintf("Retrieving all %s that have not been synced, or have been updated since %s ...",
                    Str::plural($this->getSyncResource()),
                    $lastSyncAt->toString())
            );
            $qb->where(
                $qb->expr()
                    ->isNull("entity.shopifyId")
            )
                ->orWhere(
                    $qb->expr()
                        ->gt("entity.updatedAt", ":lastSyncAt")
                )->setParameter("lastSyncAt", $lastSyncAt)
            ;
        }

        $q = $qb->getQuery();

        return collect($q->getResult());
    }

    /**
     * Get the function to use for this resource
     *
     * @return string
     * @throws Exception
     */
    private function getResourceFunction(): string
    {
        return match ($this->getShopifyResourceClass()) {
            ProductResource::class => "getProducts",
            CustomerResource::class => "getCustomers",
            OrderResource::class => "getOrders",
            default => throw new Exception("{$this->getShopifyResourceClass()} has not been configured in getResourceFunction()"),
        };
    }

    /**
     * Are we running in simulation mode?
     *
     * @return bool
     */
    abstract function getIsSimulation(): bool;

    /**
     * Are we doing a fresh sync of everything?
     *
     * @return bool
     */
    abstract function getIsFresh(): bool;

    /**
     * Get the name of type of Shopify Resource this class interacts with
     *
     * @return string
     */
    abstract protected function getShopifyResourceClass(): string;

    /**
     * Get the name of the type of resource being synced to Shopify
     *
     * @return string
     */
    abstract protected function getSyncResource(): string;

    /**
     * Sync the resources for this class and return the IDs from Shopify
     *
     * @param bool $simulate if this is a simulation, or a real execution
     * @param bool $fresh perform a fresh sync, or only new and updated
     * @return Collection
     */
    abstract protected function syncResource(bool $simulate, bool $fresh): Collection;

    /**
     * Get the Repository for this ecommerce entity
     *
     * @return RepositoryBase
     */
    abstract protected function getEcommerceEntityRepository(): RepositoryBase;
}
