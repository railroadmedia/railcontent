<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Timer;
use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Jobs\Shopify\FulfillOrdersImportedIntoShopify;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class FindOrdersInShopify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:find-orders
                            {startCreatedAt : The ISO 8601 date time for all Shopify orders to get where the created_at at or after. e.g. 2024-01-12T17:00:25+00:00}
                            {endCreatedAt : The ISO 8601 date time for all Shopify orders to get where the created_at at or before. e.g. 2024-01-13T17:30:14+00:00}
                            {--startProcessedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the processed_at at or after. e.g. 2023-10-13T17:00:25+00:00}
                            {--endProcessedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the processed_at at or before. e.g. 2023-10-13T17:30:14+00:00}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find Shopify orders that were created and processed during the given date ranges';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(ShopifyGateway $shopifyGateway): int
    {
        $startCreatedAt = $this->argument("startCreatedAt");
        $endCreatedAt = $this->argument("endCreatedAt");
        $startProcessedAt = new Carbon($this->option("startProcessedAt") ?: '1970-01-01T00:00:00Z');
        $endProcessedAt = new Carbon($this->option("endProcessedAt") ?: config('ecommerce.launch_date_times.shopify'));
        $endCursor = "";
        $break = false;
        $count = 0;
        $amount = 0.0;
        $queryCount = 0;
        do {
            Timer::afterSeconds(120, function () use (&$break) {
                $break = true;
            });
            if ($break) {
                break;
            }
            $orderData = $shopifyGateway->getOrdersBetween(
                $startProcessedAt,
                $endProcessedAt,
                250,
                sprintf(' AND created_at:>=\"%s\" AND created_at:<=\"%s\" AND financial_status:paid', $startCreatedAt, $endCreatedAt),
                ',note,totalPriceSet{shopMoney{amount}}',
                $endCursor
            );
            $queryCount++;
            $this->info("completed query $queryCount");
            $orderData->each(function (\stdClass $order) use (&$amount, &$count) {
                if (Str::contains($order->note, 'Imported from the old ecommerce system')) {
                    $count++;
                    $amount += floatval($order->totalPriceSet->shopMoney->amount);
                }
            });
        } while ($endCursor);

        $this->info('Shopify Orders');
        $this->info(sprintf('   created %s to %s', $startCreatedAt, $endCreatedAt));
        $this->info(sprintf('   processed %s to %s', $startProcessedAt->toIso8601String(), $endProcessedAt->toIso8601String()));
        $this->newLine();
        $this->info("$count Orders");
        $this->info(sprintf('$%s', $amount));

        return self::SUCCESS;
    }
}
