<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\OrderItem;
use App\Modules\Ecommerce\Models\OrderItemFulfillment;
use App\Modules\Ecommerce\Traits\ExecutesShopifyGraphQlQuery;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\Shopify;

class SyncImportedOrderShopifyIds implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use ExecutesShopifyGraphQlQuery;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected const NOTE_STRING = "Imported from the old ecommerce system: order ID";
    protected const PAGE_SIZE = 250;
    protected const RESULTS_MODEL_TYPE = "results_model_type";
    protected const RESULTS_MODEL_ID = "results_model_id";
    protected const RESULTS_NEW_SHOPIFY_ID = "results_new_shopify_id";
    protected const RESULTS_OLD_SHOPIFY_ID = "results_old_shopify_id";

    protected const MODEL_TYPE_ORDER = "Order";
    protected const MODEL_TYPE_ORDER_ITEM = "Order Item";
    protected const MODEL_TYPE_ORDER_ITEM_FULFILLMENT = "Order Item Fulfillment";
    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;
    protected Shopify $shopify;
    protected array $results = [];

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected ?string $endCursor,
        protected ?int $limit,
        protected ?int $customerId,
        protected string $startProcessedAt,
        protected string $endProcessedAt,
        protected bool $simulate,
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     *
     * @param  Shopify  $shopify
     * @return void
     * @throws Exception
     */
    public function handle(
        Shopify $shopify,
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;

        $this->getOrderData($this->endCursor);
    }


    /**
     * Get the applicable order data from Shopify
     *
     * @param  string|null  $endCursor
     * @return void
     * @throws Exception
     */
    protected function getOrderData(?string $endCursor): void
    {
        $date = config('ecommerce.launch_date_times.shopify');
        $count = is_null($this->limit) ? self::PAGE_SIZE : min(self::PAGE_SIZE, $this->limit);
        $cursor = empty($endCursor) ? "" : "after: \"$endCursor\",";
        $customerIdQuery = empty($this->customerId) ? "" : " AND customer_id:{$this->customerId}";

        $gql = <<<GQL
            query {
                orders(first: $count, $cursor query: "created_at:<=\"$date\"$customerIdQuery AND processed_at:>=\"$this->startProcessedAt\" AND processed_at:<=\"$this->endProcessedAt\"", sortKey: PROCESSED_AT) {
                    nodes {
                        ... on Order {
                            id,
                            note
                        }
                    },
                    pageInfo {
                        hasNextPage,
                        endCursor
                    }
                }
            }
            GQL;
        $responseBody = $this->executeQuery($gql);

        $orderData = collect($responseBody->data->orders->nodes)->transform(
            fn ($data) => new SyncImportedOrderShopifyIdsOrderData($data->id, $data->note)
        );

        // get only the orders that have notes in our expected format
        $importedOrderData = $orderData->filter(function ($orderData) {
            return !empty($orderData->note) && str_contains(
                $orderData->note,
                self::NOTE_STRING
            );
        });

        $this->updateOrders($importedOrderData);
        $this->printResults();

        $hasNextPage = $responseBody->data->orders->pageInfo->hasNextPage;
        $endCursor = $responseBody->data->orders->pageInfo->endCursor;

        // if we have a limit set, calculate the remainder
        $limitRemaining = is_null($this->limit) ? 1 : max($this->limit - self::PAGE_SIZE, 0);

        // if there are more results to get, add another job to the batch
        if ($hasNextPage && $limitRemaining) {
            $newLimit = is_null($this->limit) ? null : $limitRemaining;
            // create another job to do the next batch
            $this->batch()->add(new SyncImportedOrderShopifyIds($endCursor, $newLimit, $this->customerId, $this->startProcessedAt, $this->endProcessedAt, $this->simulate));
        }
    }

    /**
     * Update our local order with the new shopify_id provided by the Shopify store
     *
     * @param  Collection<SyncImportedOrderShopifyIdsOrderData>  $orderData
     * @return void
     */
    protected function updateOrders(Collection $orderData): void
    {
        $orderData->each(function (SyncImportedOrderShopifyIdsOrderData $orderData) {
            $order = $orderData->getEcommerceOrder();

            if (is_null($order)) {
                Log::error(
                    sprintf(
                        "%s: No order found for id %s. Shopify order %s cannot be synced.",
                        get_class($this),
                        $orderData->orderId,
                        $orderData->id
                    )
                );
                return;
            }

            $oldShopifyId = $order->shopify_id;
            $order->shopify_id = $orderData->id;
            if (!$this->simulate) {
                $order->saveWithoutUpdatedAt();
            }

            $this->results[] = [
                self::RESULTS_MODEL_TYPE => self::MODEL_TYPE_ORDER,
                self::RESULTS_MODEL_ID => $orderData->orderId,
                self::RESULTS_OLD_SHOPIFY_ID => $oldShopifyId,
                self::RESULTS_NEW_SHOPIFY_ID => $orderData->id
            ];

            // update the order's order items
            $this->updateOrderItems($orderData, $order->orderItems);

            // update the order's order item fulfillments
            $this->updateOrderItemFulfillments($orderData, $order->orderItems);
        });
    }

    /**
     * Update our local order items with the new shopify_id provided by the Shopify store
     *
     * @param  SyncImportedOrderShopifyIdsOrderData  $orderData
     * @param  Collection<OrderItem>  $orderItems
     * @return void
     */
    protected function updateOrderItems(SyncImportedOrderShopifyIdsOrderData $orderData, Collection $orderItems): void
    {
        // get the order's line items from shopify
        $shopifyOrder = $this->shopify->getOrder($orderData->id)->getAttributes();
        $this->handleRateLimit(true);
        $shopifyLineItems = $shopifyOrder['line_items'];

        foreach ($shopifyLineItems as $shopifyLineItem) {
            // we don't have the id recorded, so we need to match on the sku and quantity
            /** @var OrderItem $orderItemToUpdate */
            $orderItemToUpdate = $orderItems
                ->where('quantity', $shopifyLineItem['quantity'])
                ->where('product.sku', $shopifyLineItem['sku'])
                ->first();

            if (is_null($orderItemToUpdate)) {
                Log::error(
                    sprintf(
                        "%s: No order item found for sku %s and quantity %s. Shopify line item %s cannot be synced.",
                        get_class($this),
                        $shopifyLineItem['sku'],
                        $shopifyLineItem['quantity'],
                        $shopifyLineItem['id']
                    )
                );
                continue;
            }

            $oldShopifyId = $orderItemToUpdate->shopify_id;
            $orderItemToUpdate->shopify_id = $shopifyLineItem['id'];
            if (!$this->simulate) {
                $orderItemToUpdate->saveWithoutUpdatedAt();
            }

            $this->results[] = [
                self::RESULTS_MODEL_TYPE => self::MODEL_TYPE_ORDER_ITEM,
                self::RESULTS_MODEL_ID => $orderItemToUpdate->id,
                self::RESULTS_OLD_SHOPIFY_ID => $oldShopifyId,
                self::RESULTS_NEW_SHOPIFY_ID => $shopifyLineItem['id']
            ];
        }
    }

    /**
     * Update our local order item fulfillments with the new shopify_id provided by the Shopify store
     *
     * @param  SyncImportedOrderShopifyIdsOrderData  $orderData
     * @param  Collection<OrderItem>  $orderItems
     * @return void
     */
    protected function updateOrderItemFulfillments(
        SyncImportedOrderShopifyIdsOrderData $orderData,
        Collection $orderItems
    ): void {
        // get the fulfillment data from Shopify
        $shopifyOrderFulfillments = $this->shopify->getOrderFulfillments($orderData->id);
        $this->handleRateLimit(true);
        $shopifyOrderFulfillments->transform(fn (ApiResource $apiResource) => $apiResource->getAttributes());

        // there can be multiple fulfillments on an order, so check each one
        $shopifyOrderFulfillments->each(function (array $fulfillmentData) use ($orderItems) {
            // there can be multiple items in a fulfillment, so check each line item

            foreach ($fulfillmentData['line_items'] as $shopifyLineItem) {
                // we don't have the id recorded, so we need to match on the sku and quantity
                /** @var OrderItem $orderItem */
                $orderItem = $orderItems
                    ->where('quantity', $shopifyLineItem['quantity'])
                    ->where('product.sku', $shopifyLineItem['sku'])
                    ->first();

                // we had to fake fulfillments for digital products, so just ignore it if the product is digital
                if ($orderItem->product->isDigital()) {
                    continue;
                }

                // safety check to only update those entries that already had a shopify_id
                $orderItemFulfillments = $orderItem->orderItemFulfillments->filter(
                    fn (OrderItemFulfillment $fulfillment) => !empty($fulfillment->shopify_id)
                );

                // update the order item's fulfillment(s)
                $orderItemFulfillments->each(
                    function (OrderItemFulfillment $orderItemFulfillment) use ($fulfillmentData) {
                        $oldShopifyId = $orderItemFulfillment->shopify_id;
                        $orderItemFulfillment->shopify_id = $fulfillmentData['id'];
                        if (!$this->simulate) {
                            $orderItemFulfillment->saveWithoutUpdatedAt();
                        }

                        $this->results[] = [
                            self::RESULTS_MODEL_TYPE => self::MODEL_TYPE_ORDER_ITEM_FULFILLMENT,
                            self::RESULTS_MODEL_ID => $orderItemFulfillment->id,
                            self::RESULTS_OLD_SHOPIFY_ID => $oldShopifyId,
                            self::RESULTS_NEW_SHOPIFY_ID => $fulfillmentData['id']
                        ];
                    }
                );
            }
        });
    }

    /**
     * Print the results in a table.
     *
     * @return void
     */
    protected function printResults(): void
    {
        if (empty($this->results)) {
            return;
        }

        $output = [];
        $output[] = "|".Str::padRight("", 111, "-")."|";
        $output[] = sprintf(
            "| %s | %s | %s | %s |",
            $this->padForTable("Type"),
            $this->padForTable("ID"),
            $this->padForTable("Original Shopify ID"),
            $this->padForTable("Updated Shopify ID"),
        );
        $output[] = "|".Str::padRight("", 111, "-")."|";
        foreach ($this->results as $result) {
            $output[] = "| {$this->padForTable($result[self::RESULTS_MODEL_TYPE])} | {$this->padForTable($result[self::RESULTS_MODEL_ID])} | {$this->padForTable($result[self::RESULTS_OLD_SHOPIFY_ID])} | {$this->padForTable($result[self::RESULTS_NEW_SHOPIFY_ID])} |";
        }
        $output[] = "|".Str::padRight("", 111, "-")."|";
        Log::info(PHP_EOL.implode(PHP_EOL, $output).PHP_EOL);
    }

    /**
     * Pad the given string so that it will fill a table column for our output
     *
     * @param  string  $string
     * @return string
     */
    protected function padForTable(string $string): string
    {
        return Str::padRight($string, 25, " ");
    }

    /**
     * @inheritDoc
     */
    protected function getShopifyConnection(): Shopify
    {
        return $this->shopify;
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->simulate;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return get_class($this);
    }
}

class SyncImportedOrderShopifyIdsOrderData
{
    public int $id;
    public ?int $orderId = null;
    protected ?Order $order = null;

    public function __construct(
        public string $gid,
        public ?string $note
    ) {
        $this->id = intval(Str::after($gid, "gid://shopify/Order/"));
    }

    /**
     * Get the local ecommerce order for this Shopify order data
     *
     * @return Order|null
     */
    public function getEcommerceOrder(): ?Order
    {
        if (!is_null($this->order)) {
            return $this->order;
        }

        if (empty($this->note)) {
            return null;
        }
        $this->orderId = intval(Str::between($this->note, FulfillOrdersImportedIntoShopify::NOTE_STRING, '.'));
        $this->order = Order::with(
            'orderItemFulfillments',
            'orderItemFulfillments.orderItem',
            'orderItemFulfillments.orderItem.product'
        )->find($this->orderId);

        return $this->order;
    }
}
