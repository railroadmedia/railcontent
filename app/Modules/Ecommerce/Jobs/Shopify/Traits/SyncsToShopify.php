<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use App\Models\ShopifySync;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\Shopify;

trait SyncsToShopify
{
    use LogsShopify;

    protected Shopify $shopify;
    protected ShopifySync $shopifySync;

    protected int $rateLimitThreshold;
    protected int $rateLimitSleepTime;

    /**
     * Perform the sync action up to Shopify, with this class' type of resource
     *
     * @return void
     * @throws Exception
     */
    protected function sync(): void
    {
        $this->notifyStartupStatus();

        $this->createSyncLogIfExecuting();

        $shopifyIds = $this->syncResource($this->getIsSimulation(), $this->getIsFresh());
        $this->finishSyncLogIfExecuting($shopifyIds);
    }

    /**
     * Print applicable info messages to the screen, set by the run's options
     *
     * @return void
     */
    protected function notifyStartupStatus(): void
    {
        if ($this->getIsSimulation()) {
            $this->logInfo(
                sprintf(
                    "%s: Executing in simulation mode. No changes will be made to the database. "
                    ."Use --execute to run for real.",
                    $this->getClassName()
                )
            );
        }

        if ($this->getIsFresh()) {
            $this->logInfo(
                sprintf(
                    "%s: Performing a fresh sync. All ecommerce %s will be sent to Shopify.",
                    $this->getClassName(),
                    Str::plural($this->getSyncResource())
                )
            );
        }
    }

    /**
     * Are we running in simulation mode?
     *
     * @return bool
     */
    abstract protected function getIsSimulation(): bool;

    /**
     * Are we doing a fresh sync of everything?
     *
     * @return bool
     */
    abstract protected function getIsFresh(): bool;

    /**
     * Get the name of the type of resource being synced to Shopify
     *
     * @return string
     */
    abstract protected function getSyncResource(): string;

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
     * Sync the resources for this class and return the IDs from Shopify
     *
     * @param  bool  $simulate  if this is a simulation, or a real execution
     * @param  bool  $fresh  perform a fresh sync, or only new and updated
     * @return Collection
     */
    abstract protected function syncResource(bool $simulate, bool $fresh): Collection;

    /**
     * Finish the sync log and store the Shopify IDs
     *
     * @param  Collection  $shopifyIds
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
     * Get all ecommerce entities of this resource that need to be synced
     *
     * @param  bool  $fresh
     * @param  int|null  $startAtId
     * @param  int|null  $endAtId
     * @return Collection
     */
    protected function getEcommerceEntities(
        bool $fresh,
        ?int $startAtId = null,
        ?int $endAtId = null,
    ): Collection {
        $entityRepository = $this->getEcommerceEntityRepository();
        $qb = $entityRepository->createQueryBuilder('entity');

        if (!$fresh) {
            $lastSyncAt = $this->getDateTimeOfLastSync();
            $this->logInfo(
                sprintf(
                    "%s: Retrieving all %s that have not been synced, or have been updated since %s ...",
                    $this->getClassName(),
                    Str::plural($this->getSyncResource()),
                    $lastSyncAt->toString()
                )
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

        if ($startAtId) {
            $qb->andWhere($qb->expr()->gte('entity.id', ':startingId'))
                ->setParameter("startingId", $startAtId);
        }

        if ($endAtId) {
            $qb->andWhere($qb->expr()->lte('entity.id', ':endingId'))
                ->setParameter("endingId", $endAtId);
        }

        if ($this->getLimit()) {
            $qb->setMaxResults($this->getLimit());
        }
        $q = $qb->getQuery();

        return collect($q->getResult());
    }

    /**
     * Get the Repository for this ecommerce entity
     *
     * @return RepositoryBase|EntityRepository
     */
    abstract protected function getEcommerceEntityRepository(): RepositoryBase|EntityRepository;

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
     * Get the optional limit to the number of entities to sync
     *
     * @return int|null
     */
    abstract protected function getLimit(): ?int;

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
        if ($this->getIsSimulation()) {
            return;
        }

        $limit = $this->shopify->getLastResponse()?->headers()["X-Shopify-Shop-Api-Call-Limit"][0] ?? null;
        if (is_null($limit)) {
            return;
        }

        // set up the configurable values once, sort of hacking around a constructor
        if (!isset($this->rateLimitThreshold)) {
            $this->rateLimitThreshold = $this->getRateLimitThreshold();
        }
        if (!isset($this->rateLimitSleepTime)) {
            $this->rateLimitSleepTime = $this->getRateLimitSleepTime();
        }

        Log::info(sprintf("%s: Shopify API Call Limit: %s", $this->getClassName(), $limit));
        $current = intval(Str::before($limit, "/"));
        $max = intval(Str::after($limit, "/"));

        if ($max - $current <= $this->rateLimitThreshold) {
            $this->logWarning(
                sprintf(
                    "%s: About to hit API rate limit. Sleeping for %s %s...",
                    $this->getClassName(),
                    $this->rateLimitSleepTime,
                    Str::plural("second", $this->rateLimitSleepTime)
                )
            );
            sleep($this->rateLimitSleepTime);
        }
    }

    /**
     * Get the threshold of what we'll allow the rate limit to get within
     *
     * @return int
     */
    protected function getRateLimitThreshold(): int
    {
        return config('shopify.rate_limit.threshold');
    }

    /**
     * Get the number of seconds that we'll sleep for when we hit the rate limit threshold
     *
     * @return int
     */
    protected function getRateLimitSleepTime(): int
    {
        return config('shopify.rate_limit.sleep_time');
    }
}
