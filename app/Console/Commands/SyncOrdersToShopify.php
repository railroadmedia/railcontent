<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\SyncsToShopify;
use App\Modules\Ecommerce\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\OrderRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class SyncOrdersToShopify extends Command
{
    use SyncsToShopify;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-orders
                            {--limit= : (Optional) The number of order to limit this run to}
                            {--fresh : Sync all orders, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our orders up to Shopify';

    protected Shopify $shopify;
    protected OrderRepository $orderRepository;
    protected EcommerceEntityManager $entityManager;

    /**
     * Execute the console command.
     *
     * @param Shopify $shopify
     * @param OrderRepository $orderRepository
     * @param EcommerceEntityManager $entityManager
     * @return int
     */
    public function handle(Shopify $shopify, OrderRepository $orderRepository, EcommerceEntityManager $entityManager): int
    {
        $this->shopify = $shopify;
        $this->orderRepository = $orderRepository;
        $this->entityManager = $entityManager;

        return $this->sync();
    }

    /**
     * @inheritDoc
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        $shopifyIds = collect();

        $orders = $this->getEcommerceEntities($fresh);

        $this->info("Found {$orders->count()} orders to be synced");

        $bar = $this->output->createProgressBar($orders->count());
        $bar->start();

        //TODO what else is useful to show?
        $tableHeaders = ["Order ID", "Shopify Order ID"];
        $tableRows = [];

        $orders->each(function (Order $order) use ($bar, $simulate, $shopifyIds, &$tableRows) {

            //TODO: build up the data structure

            if (!$simulate) {
                //TODO: send it to shopify
                $shopifyId = "todo";
            } else {
                $shopifyId = "";
            }

            $tableRows[] = [$order->getId(), $shopifyId];
            $bar->advance();
        })->chunk(100);

        $bar->finish();
        $this->newLine();

        $this->table($tableHeaders, $tableRows);

        return $shopifyIds;
    }

    /**
     * @inheritDoc
     */
    protected function getShopifyResourceClass(): string
    {
        return OrderResource::class;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return "order";
    }

    /**
     * @inheritDoc
     */
    function getIsSimulation(): bool
    {
        return $this->option("execute") == false;
    }

    /**
     * @inheritDoc
     */
    function getIsFresh(): bool
    {
        return $this->option("fresh");
    }

    /**
     * @inheritDoc
     */
    function getLimit(): ?int
    {
        return $this->option("limit");
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase
    {
        return $this->orderRepository;
    }
}
