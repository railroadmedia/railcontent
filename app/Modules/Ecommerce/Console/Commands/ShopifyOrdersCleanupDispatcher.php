<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\EvaluateOrderJobManager;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class ShopifyOrdersCleanupDispatcher extends Command
{
    protected $signature = 'shopify:orders-cleanup
                            {--startProcessedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the processed_at at or after. e.g. 2023-01-01T00:00:00+00:00}
                            {--endProcessedAt= : (Optional) The ISO 8601 date time for all Shopify orders to get where the processed_at at or before. e.g. 2023-01-31T23:59:59+00:00}';

    protected $description = 'Dispatch jobs to review orders that were imported into Shopify, and populate the shopify_order_fixes table';

    public function handle(): int
    {
        $launchDate = new CarbonImmutable(config('ecommerce.launch_date_times.shopify'));
        $startProcessedAt = new CarbonImmutable($this->option("startProcessedAt") ?: '1970-01-01T00:00:00Z');
        $endProcessedAt = new CarbonImmutable($this->option("endProcessedAt") ?: config('ecommerce.launch_date_times.shopify'));

        if ($launchDate->isBefore($endProcessedAt)) {
            $this->error('endProcessedAt cannot be before ' . $launchDate->toIso8601String());
            return self::FAILURE;
        }
        if ($startProcessedAt->isAfter($endProcessedAt)) {
            $this->error('startProcessedAt cannot be after endProcessedAt');
            return self::FAILURE;
        }

        $startAt = Carbon::now();
        $batch = Bus::batch(new EvaluateOrderJobManager(null, $startProcessedAt, $endProcessedAt))
            ->then(function (Batch $batch) use ($startAt) {
                Log::info(
                    sprintf("EvaluateOrder: completed in %s seconds", $startAt->diffInSeconds())
                );
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command-two')
            ->dispatch();

        $this->info(
            sprintf(
                "EvaluateOrder: Batch ID %s dispatched.",
                $batch->id
            )
        );

        return self::SUCCESS;
    }
}
