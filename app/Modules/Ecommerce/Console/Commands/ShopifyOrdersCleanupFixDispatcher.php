<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldOwnerTypeEnum;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\CreateMissingMetafieldDefinition;
use App\Modules\Ecommerce\Jobs\Shopify\FixEvaluatedOrders;
use App\Modules\Ecommerce\Models\Shopify\MetaFieldDefinition;
use Carbon\Carbon;
use Illuminate\Support\Facades\Bus;
use Throwable;

class ShopifyOrdersCleanupFixDispatcher extends Command
{
    protected $signature = 'shopify:orders-cleanup-fix
                            {--startProcessedAt= : (Optional) The ISO 8601 date time for all shopify_order_fixes to get where the processed_at at or after. e.g. 2023-01-01T00:00:00+00:00}
                            {--endProcessedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the processed_at at or before. e.g. 2023-01-31T23:59:59+00:00}
                            {--set-up-metafields : Optional flag to create missing address metafield definitions.}
                            {--execute : Execute this operation to Shopify. Without this flag, it will be simulated.}';

    protected $description = 'Dispatch jobs to fix Shopify orders that were evaluated as shopify_order_fixes entries';

    /**
     * @throws Throwable
     */
    public function handle(): int
    {
        $startProcessedAt = new Carbon($this->option("startProcessedAt") ?: '1970-01-01T00:00:00Z');
        $endProcessedAt = new Carbon($this->option("endProcessedAt") ?: config('ecommerce.launch_date_times.shopify'));
        $simulate = $this->option("execute") == false;

        if ($startProcessedAt->isAfter($endProcessedAt)) {
            $this->error('startProcessedAt cannot be after endProcessedAt');
            return self::FAILURE;
        }

        if ($this->option("set-up-metafields")) {
            // first, add the jobs to ensure the metafields exist in Shopify
            $jobs = [
                new CreateMissingMetafieldDefinition(
                    new MetaFieldDefinition(
                        "Region",
                        null,
                        ShopifyMetafieldKey::AddressRegion,
                        ShopifyMetafieldTypes::single_line_text_field,
                        ShopifyMetafieldNamespace::Musora,
                        ShopifyMetafieldOwnerTypeEnum::Order
                    ),
                    $simulate
                ),
                new CreateMissingMetafieldDefinition(
                    new MetaFieldDefinition(
                        "Country",
                        null,
                        ShopifyMetafieldKey::AddressCountry,
                        ShopifyMetafieldTypes::single_line_text_field,
                        ShopifyMetafieldNamespace::Musora,
                        ShopifyMetafieldOwnerTypeEnum::Order
                    ),
                    $simulate
                )
            ];
            Bus::batch($jobs)
                ->onQueue('command-two')
                ->dispatch();
        }

        $this->runBatchQuery(
            function (int $skip, int $take) use ($startProcessedAt, $endProcessedAt, $simulate) {
                return new FixEvaluatedOrders(
                    $skip,
                    $take,
                    $startProcessedAt,
                    $endProcessedAt,
                    $simulate
                );
            },
            chunks: 100,
            queue: 'command-two'
        );

        return self::SUCCESS;
    }
}
