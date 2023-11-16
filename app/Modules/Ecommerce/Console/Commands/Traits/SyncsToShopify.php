<?php

namespace App\Modules\Ecommerce\Console\Commands\Traits;

use App\Models\ShopifySync;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Railroad\Ecommerce\Repositories\RepositoryBase;
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
            $this->info(
                "Executing in simulation mode. No changes will be made to the database.  Use --execute to run for real."
            );
        }

        if ($this->getIsFresh()) {
            $this->info(
                sprintf(
                    "Performing a fresh sync. All ecommerce %s will be sent to Shopify.",
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
     * @param  RepositoryBase|EntityRepository|null  $repository  - optional override of the repository to query
     * @return Collection
     */
    protected function getEcommerceEntities(
        bool $fresh,
        ?int $startAtId = null,
        ?int $endAtId = null,
        RepositoryBase|EntityRepository|null $repository = null,
    ): Collection {
        $entityRepository = $repository ?? $this->getEcommerceEntityRepository();
        $qb = $entityRepository->createQueryBuilder('entity');

        if (!$fresh) {
            $lastSyncAt = $this->getDateTimeOfLastSync();
            $this->logInfo(
                sprintf(
                    "Retrieving all %s that have not been synced, or have been updated since %s ...",
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

        $this->addAdditionalScope($qb);

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
        $override = $this->getLastSyncAtOverride();
        if (!is_null($override)) {
            return $override;
        }

        $sync = ShopifySync::where("resource", $this->getSyncResource())->latestFinished()->first();
        return $sync?->finished_at ?? Carbon::createFromTimestamp(0);
    }

    /**
     * Get the optional override of when this entity was last synced to Shopify
     *
     * @return Carbon|null
     */
    abstract protected function getLastSyncAtOverride(): null|Carbon;

    /**
     * Add any additional query scopes
     *
     * @param  QueryBuilder  $queryBuilder
     * @return void
     */
    abstract protected function addAdditionalScope(QueryBuilder &$queryBuilder): void;

    /**
     * Get the optional limit to the number of entities to sync
     *
     * @return int|null
     */
    abstract protected function getLimit(): ?int;
}
