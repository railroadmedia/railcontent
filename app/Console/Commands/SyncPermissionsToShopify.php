<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\SyncsToShopify;
use App\Modules\Content\Models\Permission;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\Shopify;

class SyncPermissionsToShopify extends Command
{
    use SyncsToShopify;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-permissions
                            {--limit= : (Optional) The number of permissions to limit this run to}
                            {--fresh : Sync all permissions, not just those that need it}
                            {--execute : Execute this sync to Shopify. Without this flag, it will be simulated. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our railcontent permissions up to Shopify as Content Permission metaobjects';

    protected Shopify $shopify;

    /**
     * Execute the console command.
     *
     * @param Shopify $shopify
     * @return int
     */
    public function handle(Shopify $shopify): int
    {
        $this->shopify = $shopify;
        return $this->sync();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        $shopifyIds = collect();

        $permissions = $this->getEcommerceEntities($fresh);

        $this->info("Found {$permissions->count()} permissions to be synced");

        $bar = $this->output->createProgressBar($permissions->count());
        $bar->start();

        $tableHeaders = ["ID", "Name", "Brand", "Shopify ID"];
        $tableRows = [];

        $gqlUrl = $this->shopify->getBaseUrl() . "/graphql.json";

        $permissions->each(function (Permission $permission, int $index) use ($gqlUrl, $bar, $simulate, $shopifyIds, &$tableRows) {
            $createData = $this->buildCreateData($permission);

            if (!$simulate) {
                // send the data to Shopify
                $response = $this->shopify->graphQl()->post($gqlUrl, $createData);
                if ($response->successful()) {
                    $responseData = json_decode($response->body())->data;
                    $responseErrors = $responseData?->metaobjectCreate?->userErrors ?? null;
                    if (!is_null($responseErrors)) {
                        foreach($responseErrors as $responseError) {
                        $this->error(sprintf("Error creating Permission %s in Shopify: %s",
                            $permission->id, $responseError->message));
                        }
                        return;
                    }

                    $responseCostData = $responseData?->extensions?->cost ?? null;
                    $shopifyId = $responseData?->metaobjectCreate?->metaobject?->id ?? null;

                    if (is_null($shopifyId)) {
                        $this->error(sprintf("Unexpected response format for sending Permission %s to Shopify: %s",
                            $permission->id, $response->body()));
                        return;
                    }
                } else {
                    $this->error(sprintf("Failed to send Permission %s to Shopify: %s",
                        $permission->id, $response->body()));
                    return;
                }

                // and record the shopify id on our permission
                $permission->shopify_id = $shopifyId;
                $permission->update();

                $shopifyIds->push($shopifyId);

                // check the response cost, and handle any throttling
                if ($responseCostData) {
                    $queryCost = $responseCostData->requestedQueryCost;
                    // make sure our next request won't go over the limit
                    $minAvailable = $queryCost * 2;
                    // check the remaining availability
                    $currentlyAvailable = $responseCostData->currentlyAvailable;
                    if ($currentlyAvailable < $minAvailable) {
                        // if we don't have enough available, sleep until we'll have enough of a limit restored
                        $restoreRate = $responseCostData->restoreRate;
                        $sleepTime = 1;
                        $nextAvailable = $currentlyAvailable + ($restoreRate * $sleepTime);

                        while ($nextAvailable < $minAvailable) {
                            $nextAvailable = $currentlyAvailable + ($restoreRate * ++$sleepTime);
                        }
                        sleep($sleepTime);
                    }
                }
            } else {
                $shopifyId = "gid://shopify/Metaobject/$index";
            }

            $tableRows[] = [$permission->id, $permission->name, $permission->brand, $shopifyId];
            $bar->advance();
        })->chunk(100);

        $bar->finish();
        $this->newLine();

        $this->table($tableHeaders, $tableRows);

        return $shopifyIds;
    }

    /**
     * Build up the graphql payload to create the permission in Shopify
     *
     * @param Permission $permission
     * @return string[]
     */
    private function buildCreateData(Permission $permission): array
    {
        $gql = <<<GQL
            mutation {
                metaobjectCreate(
                    metaobject: {
                        type: "content_permission"
                        fields: [
                            { key: "permission_id", value: "{$permission->id}" }
                            { key: "name", value: "{$permission->name}" }
                            { key: "brand", value: "{$permission->brand}" }
                        ]
                    }
                ) {
                    metaobject {
                        id
                    }
                    userErrors {
                      message
                    }
                }
            }
            GQL;
        return ["query" => $gql];
    }

    /**
     * @inheritDoc
     */
    protected function getShopifyResourceClass(): string
    {
        return Permission::class;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return "permission";
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
        return $this->productRepository;
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntities(bool $fresh) : Collection
    {
        // we don't have timestamps on Permissions, so filter on the shopify_id being set or not
        return Permission::query()
            ->when(!$fresh, function ($q) {
                return $q->whereNull("shopify_id");
            })
            ->when($this->getLimit(), function ($q) {
                return $q->limit($this->getLimit());
            })
            ->get();
    }
}
