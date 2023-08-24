<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\SyncsToShopify;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Railroad\Usora\Repositories\UserRepository;
use Signifly\Shopify\REST\Resources\CustomerResource;
use Signifly\Shopify\Shopify;

class SyncCustomersToShopify extends Command
{
    use SyncsToShopify;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-customers {--fresh} {--execute}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our users and customers up to Shopify';

    protected Shopify $shopify;
    protected CustomerRepository $customerRepository;
    protected UserRepository $userRepository;
    protected EcommerceEntityManager $entityManager;

    /**
     * Execute the console command.
     *
     * @param Shopify $shopify
     * @param CustomerRepository $customerRepository
     * @param UserRepository $userRepository
     * @param EcommerceEntityManager $entityManager
     * @return int
     */
    public function handle(Shopify $shopify,
                           CustomerRepository $customerRepository,
                           UserRepository $userRepository,
                           EcommerceEntityManager $entityManager): int
    {
        $this->shopify = $shopify;
        $this->customerRepository = $customerRepository;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;

        return $this->sync();
    }

    /**
     * @inheritDoc
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        $shopifyIds = collect();

        $customers = $this->getEcommerceEntities($fresh);
        //TODO also get users and merge them, or do ... something?

        $this->info("Found {$customers->count()} customers to be synced");

        $bar = $this->output->createProgressBar($customers->count());
        $bar->start();

        //TODO what else is useful to show?
        $tableHeaders = ["User or Customer ID", "Class", "Shopify Customer ID"];
        $tableRows = [];

        //TODO: need to have the customer model from the module...
        $customers->each(function ($customer) use ($bar, $simulate, $shopifyIds, &$tableRows) {

            //TODO: build up the data structure

            if (!$simulate) {
                //TODO: send it to shopify
                $shopifyId = "todo";
            } else {
                $shopifyId = "";
            }

            $tableRows[] = [$customer->getId(), "todo", $shopifyId];
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
        return CustomerResource::class;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return "customer";
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
    protected function getEcommerceEntityRepository(): RepositoryBase
    {
        return $this->customerRepository;
    }
}
