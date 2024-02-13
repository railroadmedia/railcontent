<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Order;
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
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\Shopify;

class FulfillOrdersImportedIntoShopify implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use ExecutesShopifyGraphQlQuery;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use HandlesShopifyRateLimit;

    public const NOTE_STRING = "Imported from the old ecommerce system: order ID";
    protected const PAGE_SIZE = 250;

    protected const RESULTS_SHOPIFY_ORDER_NUMBER = "results_shopify_order_number";
    protected const RESULTS_SHOPIFY_ORDER_ID = "results_shopify_order_id";
    protected const RESULTS_RESULT = "results_result";
    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;
    protected Shopify $shopify;
    protected array $results = [];

    protected bool $hasNextPage = false;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected ?string $endCursor,
        protected ?int $customerId,
        protected string $startProcessedAt,
        protected string $endProcessedAt,
        protected bool $simulate,
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled];
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

        $importedOrderData = $this->getOrderData($this->endCursor);

        $importedOrderData->each(function (FulfillOrdersImportedIntoShopifyOrderData $shopifyOrderData) {
            $openOrderFulfillmentOrder = $this->getOpenOrderFulfillmentOrder($shopifyOrderData);
            if (!empty($openOrderFulfillmentOrder)) {
                $this->createShopifyFulfillmentForOrder(
                    $shopifyOrderData->getEcommerceOrder(),
                    $shopifyOrderData->name,
                    $openOrderFulfillmentOrder
                );
            }
        });


        $this->printResults();

        // if there are more results to get, add another job to the batch
        if ($this->hasNextPage) {
            // create another job to do the next batch
            $this->batch()->add(
                new FulfillOrdersImportedIntoShopify($this->endCursor, $this->customerId, $this->startProcessedAt, $this->endProcessedAt, $this->simulate)
            );
        }
    }


    /**
     * Get the applicable order data from Shopify
     *
     * @param  string|null  $endCursor
     * @return Collection
     * @throws Exception
     */
    private function getOrderData(?string $endCursor): Collection
    {
        $date = config('ecommerce.launch_date_times.shopify');
        $count = self::PAGE_SIZE;
        $cursor = empty($endCursor) ? "" : "after: \"$endCursor\",";
        $customerIdQuery = empty($this->customerId) ? "" : " AND customer_id:{$this->customerId}";

        $gql = <<<GQL
            query {
                orders(first: $count, $cursor query: "created_at:<=\"$date\" AND processed_at:>=\"$this->startProcessedAt\" AND processed_at:<=\"$this->endProcessedAt\"$customerIdQuery AND financial_status:paid AND -fulfillment_status:shipped", sortKey: PROCESSED_AT) {
                    nodes {
                        ... on Order {
                            id,
                            name,
                            fulfillable,
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
            fn($data) => new FulfillOrdersImportedIntoShopifyOrderData(
                $data->id,
                $data->name,
                $data->fulfillable,
                $data->note
            )
        );

        // get only the orders that have notes in our expected format, so we can match it to our own ecommerce_order
        $importedOrderData = $orderData->filter(function ($orderData) {
            return !empty($orderData->note) && str_contains(
                    $orderData->note,
                    self::NOTE_STRING
                );
        });


        $this->hasNextPage = $responseBody->data->orders->pageInfo->hasNextPage;
        $this->endCursor = $responseBody->data->orders->pageInfo->endCursor;

        return $importedOrderData->filter(function (FulfillOrdersImportedIntoShopifyOrderData $orderData) {
            // ensure we have a local order to match the one noted in Shopify
            return $this->filterShopifyOrdersWithEcommerceOrder($orderData);
        });
    }

    /**
     * Check that the given FulfillOrdersImportedIntoShopifyOrderData's noted ecommerce order exists, and log if not
     *
     * @param  FulfillOrdersImportedIntoShopifyOrderData  $orderData
     * @return bool
     */
    private function filterShopifyOrdersWithEcommerceOrder(FulfillOrdersImportedIntoShopifyOrderData $orderData): bool
    {
        $order = $orderData->getEcommerceOrder();

        if (is_null($order)) {
            $this->results[] = [
                self::RESULTS_SHOPIFY_ORDER_NUMBER => $orderData->name,
                self::RESULTS_SHOPIFY_ORDER_ID => $orderData->id,
                self::RESULTS_RESULT => "SKIPPED - No ecommerce_order found for id {$orderData->orderId}"
            ];
            return false;
        }
        return true;
    }

    /**
     * Get the open Order Fulfillment Order data for the given Shopify order.
     *
     * @param  FulfillOrdersImportedIntoShopifyOrderData  $orderData
     * @return ?array
     */
    private function getOpenOrderFulfillmentOrder(FulfillOrdersImportedIntoShopifyOrderData $orderData): ?array
    {
        $order = $orderData->getEcommerceOrder();

        // Safety check. Shouldn't be possible with our earlier filter, but ...
        if (is_null($order)) {
            Log::error(
                sprintf(
                    "%s: No order found for id %s. Shopify order %s cannot be fulfilled.",
                    get_class($this),
                    $orderData->orderId,
                    $orderData->id
                )
            );
            return null;
        }

        $fulfillmentOrders = $this->shopify->getOrderFulfillmentOrders($orderData->id);
        $this->handleRateLimit();

        // an order can have 1 or more (should never have 0, but ...)
        if ($fulfillmentOrders->isEmpty()) {
            $this->results[] = [
                self::RESULTS_SHOPIFY_ORDER_NUMBER => $orderData->name,
                self::RESULTS_SHOPIFY_ORDER_ID => $orderData->id,
                self::RESULTS_RESULT => "ERROR - No Order Fulfillment Orders"
            ];
            return null;
        }

        $fulfillmentOrders->transform(function (ApiResource $resource) {
            return $resource->getAttributes();
        });

        // get the OrderFulfillmentOrders that are still open
        $openFulFillmentOrders = $fulfillmentOrders->filter(function (array $attributes) {
            return $attributes['status'] == 'open' || $attributes['status'] == 'in_progress';
        });

        // realistically, we only expect one open fulfillment. If there are multiple, just flag it to be done manually
        if ($openFulFillmentOrders->count() > 1) {
            $this->results[] = [
                self::RESULTS_SHOPIFY_ORDER_NUMBER => $orderData->name,
                self::RESULTS_SHOPIFY_ORDER_ID => $orderData->id,
                self::RESULTS_RESULT => "SKIPPED - Multiple open Order Fulfillment Orders"
            ];
            return null;
        }

        return $openFulFillmentOrders->first();
    }

    /**
     * Get all applicable fulfillments for the given order, and send the data to Shopify to have it create
     * a fulfillment with the information for our own fulfillments.
     *
     * @param  Order  $order
     * @param  string  $shopifyOrderNumber
     * @param  array  $shopifyOrderFulfillmentOrderData
     * @return void
     */
    private function createShopifyFulfillmentForOrder(
        Order $order,
        string $shopifyOrderNumber,
        array $shopifyOrderFulfillmentOrderData
    ): void {
        $fulfillmentOrderId = $shopifyOrderFulfillmentOrderData['id'];
        $shopifyOrderId = $shopifyOrderFulfillmentOrderData['order_id'];

        // get the fulfillments for this order, that haven't been synced to Shopify
        $orderItemFulfillments = $order->orderItemFulfillments->whereNull('shopify_id');
        if ($orderItemFulfillments->isEmpty()) {
            $this->results[] = [
                self::RESULTS_SHOPIFY_ORDER_NUMBER => $shopifyOrderNumber,
                self::RESULTS_SHOPIFY_ORDER_ID => $shopifyOrderId,
                self::RESULTS_RESULT => "SKIPPED - No unsynced ecommerce_order_item_fulfillment found for order {$order->id}"
            ];
            return;
        }

        // our order item fulfillments for this order, that need to be synced.
        // Keep a collection of them all, so we can group them by the tracking information, instead of creating a new
        // Shopify fulfillment for each one.
        $orderItemFulfillmentsToSync = collect();

        // we recorded the shopify id of the line_item on our ecommerce_order_items, so we can match them here
        foreach ($shopifyOrderFulfillmentOrderData['line_items'] as $shopifyOrderFulfillmentLineItemData) {
            // the shopify id of the line item
            $lineItemId = $shopifyOrderFulfillmentLineItemData['line_item_id'];
            // the id of the fulfillment order line item (the fulfillment for the line item)
            $fulfillmentOrderLineItemId = $shopifyOrderFulfillmentLineItemData['id'];

            $orderItemFulfillmentsWithSyncedOrderItem = $orderItemFulfillments->where(
                'orderItem.shopify_id',
                $lineItemId
            );

            if ($orderItemFulfillmentsWithSyncedOrderItem->isEmpty()) {
                $this->results[] = [
                    self::RESULTS_SHOPIFY_ORDER_NUMBER => $shopifyOrderNumber,
                    self::RESULTS_SHOPIFY_ORDER_ID => $shopifyOrderId,
                    self::RESULTS_RESULT => "ERROR - No ecommerce_order_item found with shopify_id $lineItemId"
                ];
                continue;
            }

            // we'll need the fulfillmentOrderLineItemId when we build the payload, so add it to each order item fulfillment
            $orderItemFulfillmentsWithSyncedOrderItem->each(
                fn(OrderItemFulfillment $fulfillment
                ) => $fulfillment->fulfillmentOrderLineItemId = $fulfillmentOrderLineItemId
            );

            $orderItemFulfillmentsToSync = $orderItemFulfillmentsToSync->merge(
                $orderItemFulfillmentsWithSyncedOrderItem
            );
        }

        if ($orderItemFulfillmentsToSync->isEmpty()) {
            return;
        }

        // we have some order item fulfillments to sync, so group them by the tracking information,
        // and create fulfillment data for each grouping
        $grouped = $orderItemFulfillmentsToSync->groupBy(
            fn($fulfillment) => "$fulfillment->company-$fulfillment->tracking_number"
        );
        $grouped->each(
            function (Collection $fulfillments) use ($shopifyOrderNumber, $shopifyOrderId, $fulfillmentOrderId) {
                $shopifyFulfillmentData = [
                    "notify_customer" => false,
                    "status" => "success",
                    "tracking_info" => [
                        "company" => $fulfillments->first()->company,
                        "number" => $fulfillments->first()->tracking_number
                    ]
                ];

                // array for the line_items_by_fulfillment_order data
                $lineItemData = [];
                // keep track of the order item fulfillments, so we can apply the shopify id to it after creating the fulfillment
                $orderItemFulfillmentsToUpdate = [];

                $fulfillments->each(function (OrderItemFulfillment $orderItemFulfillment) use (
                    $shopifyOrderId,
                    $shopifyOrderNumber,
                    $fulfillmentOrderId,
                    &$lineItemData,
                    &$orderItemFulfillmentsToUpdate
                ) {
                    $lineItemData[] = [
                        "fulfillment_order_id" => $fulfillmentOrderId,
                        "fulfillment_order_line_items" => [
                            [
                                'id' => $orderItemFulfillment->fulfillmentOrderLineItemId,
                                'quantity' => $orderItemFulfillment->orderItem->quantity
                            ]
                        ]
                    ];

                    // remove the temp storage of fulfillmentOrderLineItemId
                    unset($orderItemFulfillment->fulfillmentOrderLineItemId);

                    $orderItemFulfillmentsToUpdate[] = $orderItemFulfillment;
                });
                $fulfilledItems = $fulfillments->pluck('orderItem.product.sku')->implode(', ');
                $this->results[] = [
                    self::RESULTS_SHOPIFY_ORDER_NUMBER => $shopifyOrderNumber,
                    self::RESULTS_SHOPIFY_ORDER_ID => $shopifyOrderId,
                    self::RESULTS_RESULT => sprintf(
                        'Fulfilled %s. %s: %s',
                        $fulfilledItems,
                        $fulfillments->first()->company,
                        $fulfillments->first()->tracking_number
                    )
                ];
                $shopifyFulfillmentData['line_items_by_fulfillment_order'] = $lineItemData;

                if (!$this->simulate) {
                    $fulfillmentResult = $this->shopify->createFulfillment($shopifyFulfillmentData);
                    $this->handleRateLimit();

                    $fulfillmentId = $fulfillmentResult->getAttributes()["id"];
                    // store the shopify id on our order item fulfillment
                    foreach ($orderItemFulfillmentsToUpdate as $orderItemFulfillment) {
                        $orderItemFulfillment->shopify_id = $fulfillmentId;
                        $orderItemFulfillment->saveWithoutUpdatedAt();
                    }

                    // mark the fulfillment as delivered
                    // DEV NOTE: there seems to be a bug with createOrderFulfillmentEvent, so we'll just work around it with a direct post
                    try {
                        $uriPrefix = ['orders', $shopifyOrderId, 'fulfillments', $fulfillmentId];
                        $url = implode('/', [...$uriPrefix, "events.json"]);
                        $data = ['event' => ['status' => 'delivered']];
                        $fulfillmentEventResponse = $this->shopify->post($url, $data);
                        $this->handleRateLimit();

                        if ($fulfillmentEventResponse->failed()) {
                            Log::error(
                                sprintf(
                                    "%s: Failed to mark fulfillment %s as delivered: %s.",
                                    get_class($this),
                                    $fulfillmentId,
                                    $fulfillmentEventResponse->reason()
                                )
                            );
                        }
                    } catch (ValidationException $validationException) {
                        Log::error(
                            sprintf(
                                "%s: Failed to mark fulfillment %s as delivered: %s.",
                                get_class($this),
                                $fulfillmentId,
                                $validationException->getMessage()
                            )
                        );
                    }
                }
            }
        );
    }

    /**
     * Print the results in a table.
     *
     * @return void
     */
    private function printResults(): void
    {
        if (empty($this->results)) {
            return;
        }

        $output = [];
        $output[] = "|".Str::padRight("", 132, "-")."|";
        $output[] = sprintf(
            "| %s | %s | %s |",
            $this->padForTable("Shopify Order Number"),
            $this->padForTable("Shopify Order ID"),
            $this->padForTable("Result", true),
        );
        $output[] = "|".Str::padRight("", 132, "-")."|";
        foreach ($this->results as $result) {
            $output[] = "| {$this->padForTable($result[self::RESULTS_SHOPIFY_ORDER_NUMBER])} | {$this->padForTable($result[self::RESULTS_SHOPIFY_ORDER_ID])} | {$this->padForTable($result[self::RESULTS_RESULT], true)} |";
        }
        $output[] = "|".Str::padRight("", 132, "-")."|";
        Log::info(PHP_EOL.implode(PHP_EOL, $output).PHP_EOL);
    }

    /**
     * Pad the given string so that it will fill a table column for our output
     *
     * @param  string  $string
     * @param  bool  $isLong
     * @return string
     */
    private function padForTable(string $string, bool $isLong = false): string
    {
        return Str::padRight($string, $isLong ? 80 : 22, " ");
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

class FulfillOrdersImportedIntoShopifyOrderData
{
    public int $id;
    public ?int $orderId = null;
    protected ?Order $order = null;

    public function __construct(
        public string $gid,
        public string $name,
        public bool $fulfillable,
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
        $this->order = Order::with('orderItemFulfillments', 'orderItemFulfillments.orderItem')->find($this->orderId);

        return $this->order;
    }
}
