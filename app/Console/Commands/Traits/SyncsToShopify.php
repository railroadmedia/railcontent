<?php

namespace App\Console\Commands\Traits;

use App\Models\ShopifySync;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
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

        $this->notifyStartupStatus();

        $this->createSyncLogIfExecuting();

        try {
            $shopifyIds = $this->syncResource($this->getIsSimulation(), $this->getIsFresh());
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        }

        $this->finishSyncLogIfExecuting($shopifyIds);

        return self::SUCCESS;
    }

    /**
     * Print applicable info messages to the screen, set by the run's options
     *
     * @return void
     */
    protected function notifyStartupStatus(): void
    {
        if ($this->getIsSimulation()) {
            $this->info("Executing in simulation mode. No changes will be made to the database.  Use --execute to run for real.");
        }

        if ($this->getIsFresh()) {
            $this->info(
                sprintf("Performing a fresh sync. All ecommerce %s will be sent to Shopify.",
                    Str::plural($this->getSyncResource()))
            );
        }
    }

    /**
     * Create a log for this sync
     *
     * @return void
     */
    protected function createSyncLogIfExecuting(): void
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
    protected function finishSyncLogIfExecuting(Collection $shopifyIds): void
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
     * @param RepositoryBase|EntityRepository|null $repository - optional override of the repository to query
     * @return Collection
     */
    protected function getEcommerceEntities(bool $fresh, RepositoryBase|EntityRepository|null $repository = null) : Collection
    {
        $entityRepository = $repository ?? $this->getEcommerceEntityRepository();
        $qb = $entityRepository->createQueryBuilder('entity');

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
                )->setParameter("lastSyncAt", $lastSyncAt);
        }

        if ($this->getLimit()) {
            $qb->setMaxResults($this->getLimit());
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
     * Get the optional limit to the number of entities to sync
     *
     * @return int|null
     */
    abstract function getLimit(): ?int;

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
     * @return RepositoryBase|EntityRepository
     */
    abstract protected function getEcommerceEntityRepository(): RepositoryBase|EntityRepository;

    /**
     * WARNING: Do NOT call this before the first `$this->>shopify->___` call, because there will not yet be
     * an existing last response.
     *
     * Check the API call rate limit based on the last response, to see if we're approaching our limit, and
     * to sleep if so, to recover our calls.
     * This needs to be called before any `$this->>shopify->___` calls that you want to protect.
     *
     * @return void
     */
    protected function handleRateLimit(): void
    {
        $limit = $this->shopify->getLastResponse()?->headers()["X-Shopify-Shop-Api-Call-Limit"][0] ?? "0/40";
        $current = intval(Str::before($limit, "/"));
        $max = intval(Str::after($limit, "/"));

        if ($max - $current <= $this->RATE_LIMIT_THRESHOLD) {
            $this->warn("About to hit API rate limit. Sleeping for 1 second...");
            sleep(1);
        }
    }

    // the closest difference of the current call and limit that we'll allow before sleeping
    protected int $RATE_LIMIT_THRESHOLD = 5;
}
