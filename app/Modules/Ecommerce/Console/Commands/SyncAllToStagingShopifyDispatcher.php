<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Shopify\FulfillOrdersImportedIntoShopify;
use App\Modules\Ecommerce\Jobs\Shopify\SyncOrdersToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\SyncProductsToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\SyncSubscriptionPaymentsToShopifyOrders;
use App\Modules\Ecommerce\Jobs\Shopify\SyncUsersToShopify;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\REST\Resources\ProductResource;
use Signifly\Shopify\Shopify;
use Throwable;

class SyncAllToStagingShopifyDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-all-staging
                            {startCreatedAt : The ISO 8601 date time for all ecommerce_orders and ecommerce_subscription_payments to get where the created_at is at or after. e.g. 2023-01-01T00:00:00+00:00}
                            {endCreatedAt : The ISO 8601 date time for all ecommerce_orders and ecommerce_subscription_payments to get where the created_at is at or before. e.g. 2023-01-31T23:59:59+00:00}
                            {--include-products : (Optional) Include the sync of the required products before anything else. Not recommended if your store already has products.}
                            {--all-products : (Optional) Include the sync of all products before anything else. Not recommended if your store already has products.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all required users, addresses, orders, and subscription payments within the given date range, up to a staging Shopify store';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle(Shopify $shopify): int
    {
        // ensure valid dates
        $launchDate = new Carbon(config('ecommerce.launch_date_times.shopify'));
        $startCreatedAt = new Carbon($this->argument("startCreatedAt") ?: '1970-01-01T00:00:00Z');
        $endCreatedAt = new Carbon($this->argument("endCreatedAt") ?: config('ecommerce.launch_date_times.shopify'));
        if ($launchDate->isBefore($endCreatedAt)) {
            $this->error('endCreatedAt cannot be before ' . $launchDate->toIso8601String());
            return self::INVALID;
        }
        if ($startCreatedAt->isAfter($endCreatedAt)) {
            $this->error('startCreatedAt cannot be after endCreatedAt');
            return self::INVALID;
        }
        // don't allow this to be run against the production store
        if (config('shopify.credentials.domain') === 'musora.myshopify.com') {
            $this->error('Cannot run on production store. Check your .env file for SHOPIFY_DOMAIN.');
            return self::FAILURE;
        }

        $syncProducts = $this->option("include-products");
        $syncAllProducts = $this->option("all-products");

        $dateRangeDays = $endCreatedAt->diffInDays($startCreatedAt);
        if ($dateRangeDays > 30) {
            if (!$this->confirm("Using all orders and subscription payments for a $dateRangeDays day period. Do you wish to continue?")) {
                $this->warn('cancelled');
                return self::INVALID;
            }
        }

        // find the orders and subscription payments within the date range
        // DEV NOTE: we don't have a job for syncing customers (only a command), so just ignore any orders/subscriptions without a user
        $orders = Order::toSyncWithShopify(
            fresh: true,
            startCreatedAt: $startCreatedAt,
            endCreatedAt: $endCreatedAt
        )->whereNotNull('user_id')
            ->get();
        $subscriptionPayments = SubscriptionPayment::toSyncWithShopify(
            fresh: true,
            startCreatedAt: $startCreatedAt,
            endCreatedAt: $endCreatedAt
        )->whereHas('subscription', function ($query) {
            $query->whereNotNull('user_id');
        })->get();

        if ($syncAllProducts) {
            $productIds = Product::select('id')->get()->pluck('id')->values();
        } elseif ($syncProducts) {
            // get the unique products
            $orderProductIds = $orders->flatMap(function (Order $order) {
                return $order->orderItems->pluck('product_id');
            })->values();
            $spProductIds = $subscriptionPayments->flatMap(function (SubscriptionPayment $subscriptionPayment) {
                return $subscriptionPayment->product_id;
            })->values();
            $productIds = $orderProductIds->merge($spProductIds)->unique()->sort()->values();
        } else {
            $productIds = collect();
        }

        // get the unique users
        $orderUserIds = $orders->pluck('user_id')->unique();
        $spUserIds = $subscriptionPayments->pluck('subscription.user_id')->unique();
        $userIds = $orderUserIds->merge($spUserIds)->unique()->sort()->values();

        // confirm before proceeding
        if (!$this->confirm(sprintf(
            'This will sync %s products, %s users, %s orders, and %s subscription payments. Do you wish to continue?',
            $productIds->count(),
            $userIds->count(),
            $orders->count(),
            $subscriptionPayments->count()
        ))) {
            $this->warn('cancelled');
            return self::INVALID;
        }

        // add a job for each sync that needs to be done
        $jobs = [];
        // DEV NOTE: this is not the most optimized way to do it, but it's the lowest impact to existing code

        if ($syncAllProducts) {
            // remove the shopify_id from all products, so we have a clean insertion
            $allProducts = Product::all();
            DB::transaction(function () use ($allProducts) {
                $allProducts->each(function (Product $product) {
                    $product->shopify_id = null;
                    $product->saveWithoutUpdatedAt();
                });
            });
            $syncProducts = true;
        }
        if ($syncProducts) {
            // first ensure there is a location set up with Shopify, so we don't attempt anything else in case there isn't
            /** @var ApiResource $location */
            $location = $shopify->getLocations()?->first() ?: null;
            if (empty($location)) {
                $this->error("No location found! Please set up a location inside the Shopify store to proceed.");
                return self::FAILURE;
            }
            $locationId = $location->getAttributes()["id"];

            // the SyncProductsToShopify will create a new product if it already exists,
            // so remove any from the list that are already there (we can't just check against sku because our variant
            // products don't have the matching full sku, nor do direct queries against product variants, so get all
            // products and parse the results)
            $existingProducts = $shopify->getProducts();
            $existingVariantIds = $existingProducts->map(function (ProductResource $productResource) {
                return collect($productResource->variants)->pluck('id');
            })->flatten();
            $productIds = $productIds->diff($existingVariantIds)->values();

            $productIds->each(function (int $productId, int $index) use (&$jobs, $locationId) {
                $jobs[] = new SyncProductsToShopify(
                    $productId,
                    $productId,
                    $locationId,
                    now(),
                    false,
                    true,
                    $index
                );
            });
        }
        $userIds->each(function (int $userId) use (&$jobs) {
            $jobs[] = new SyncUsersToShopify(
                $userId,
                $userId,
                now(),
                false,
                true
            );
        });

        $orders->each(function (Order $order) use (&$jobs) {
            $jobs[] = new SyncOrdersToShopify(
                $order->id,
                $order->id,
                false,
                true
            );
        });

        $subscriptionPayments->each(function (SubscriptionPayment $subscriptionPayment) use (&$jobs) {
            $jobs[] = new SyncSubscriptionPaymentsToShopifyOrders(
                $subscriptionPayment->id,
                $subscriptionPayment->id,
                false,
                true
            );
        });

        // add the FulfillOrdersImportedIntoShopify afterwards, to be safe
        $jobs[] = new FulfillOrdersImportedIntoShopify(
            null,
            null,
            $startCreatedAt->toIso8601String(),
            $endCreatedAt->toIso8601String(),
            false
        );

        $startAt = Carbon::now();
        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startAt, $startCreatedAt, $endCreatedAt) {
                Log::info(
                    sprintf(
                        "SyncAllToStagingShopifyDispatcher: Completed in %s seconds",
                        $startAt->diffInSeconds()
                    )
                );
                Log::info(
                    sprintf(
                        "SyncAllToStagingShopifyDispatcher: If you would like to add the order tags, you can run 'artisan shopify:add-order-tags --startProcessedAt=%s --endProcessedAt=%s --execute'",
                        $startCreatedAt->toIso8601String(),
                        $endCreatedAt->toIso8601String(),
                    )
                );
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error($e->getMessage());
            })
            ->onQueue('command')
            ->dispatch();
        $this->info(
            sprintf(
                "SyncAllToStagingShopifyDispatcher: Batch ID %s dispatched with %s %s.",
                $batch->id,
                $batch->totalJobs,
                Str::plural("job", $batch->totalJobs),
            )
        );

        return self::SUCCESS;
    }

}
