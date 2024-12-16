<?php

namespace App\Modules\Ecommerce\Jobs\Shopify\Traits;

use App\Models\ShopifySync;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\Shopify;

trait SyncsToShopify
{
    use LogsShopify;

    protected Shopify $shopify;
    protected ShopifySync $shopifySync;

    /**
     * Perform the sync action up to Shopify, with this class' type of resource
     *
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
     */
    abstract protected function getIsSimulation(): bool;

    /**
     * Are we doing a fresh sync of everything?
     */
    abstract protected function getIsFresh(): bool;

    /**
     * Get the name of the type of resource being synced to Shopify
     */
    abstract protected function getSyncResource(): string;

    /**
     * Create a log for this sync
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
     */
    abstract protected function syncResource(bool $simulate, bool $fresh): Collection;

    /**
     * Finish the sync log and store the Shopify IDs
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
     * Get the optional limit to the number of entities to sync
     */
    abstract protected function getLimit(): ?int;

    /**
     * Get the optional override of when this entity was last synced to Shopify
     */
    abstract protected function getLastSyncAtOverride(): null|Carbon;
}
