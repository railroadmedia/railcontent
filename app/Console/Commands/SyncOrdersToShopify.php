<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\SyncsToShopify;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Railroad\Ecommerce\Entities\Order;
use Railroad\Ecommerce\Entities\OrderDiscount;
use Railroad\Ecommerce\Entities\OrderItem;
use Railroad\Ecommerce\Entities\OrderItemFulfillment;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\CustomerRepository;
use Railroad\Ecommerce\Repositories\OrderRepository;
use Railroad\Ecommerce\Repositories\OrderItemRepository;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Railroad\Ecommerce\Repositories\UserRepository;
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
    protected $signature = 'shopify:sync-orders {--fresh} {--execute}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our orders up to Shopify';

    protected Shopify $shopify;
    protected CustomerRepository $customerRepository;
    protected OrderRepository $orderRepository;
    protected OrderItemRepository $orderItemRepository;
    protected ProductRepository $productRepository;
    protected UserRepository $userRepository;
    protected EcommerceEntityManager $entityManager;

    // constants for tracking results of creating fulfillments
    const ORDER_ITEM_FULFILLMENT_ID = "order_item_fulfillment_id";
    const SHOPIFY_FULFILLMENT_ID = "shopify_fulfillment_id";

    /**
     * Execute the console command.
     *
     * @param Shopify $shopify
     * @param CustomerRepository $customerRepository
     * @param OrderRepository $orderRepository
     * @param OrderItemRepository $orderItemRepository
     * @param ProductRepository $productRepository
     * @param UserRepository $userRepository
     * @param EcommerceEntityManager $entityManager
     * @return int
     */
    public function handle(Shopify $shopify,
                           CustomerRepository $customerRepository,
                           OrderRepository $orderRepository,
                           OrderItemRepository $orderItemRepository,
                           ProductRepository $productRepository,
                           UserRepository $userRepository,
                           EcommerceEntityManager $entityManager): int
    {
        $this->shopify = $shopify;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;

        return $this->sync();
    }

    protected function getEcommerceEntities(bool $fresh) : Collection
    {
        /*
         TODO: delete this!
          this is just for a simple test case
          people who bought product 129 - Drumeo for Teachers - 1 year, 163 - Bass Drum Technique
            order id: 59526,59715,68775,60643,60895,61019,71344
        (60643 also has 74 - Drum Rudiment System (Online Edition), and 165 - Maximize Your Groove )
         */
        $qb = $this->getEcommerceEntityRepository()->createQueryBuilder('entity');

        if (!$fresh) {
            $lastSyncAt = $this->getDateTimeOfLastSync();
            $this->info(
                sprintf("Retrieving all orders that have not been synced, or have been updated since %s, and are in our test pool of IDs ...",
                    $lastSyncAt->toString())
            );
            // TODO test for specific order
            // $qb->where(
            //     $qb->expr()
            //         ->in("entity.id", ":ids")
            // )->setParameter("ids", [60643]);
            $qb->where(
                $qb->expr()
                    ->isNull("entity.shopifyId")
            )
                ->orWhere(
                    $qb->expr()
                        ->gt("entity.updatedAt", ":lastSyncAt")
                )->setParameter("lastSyncAt", $lastSyncAt)
                ->andWhere(
                    $qb->expr()
                        ->in("entity.id", ":ids")
                )->setParameter("ids", [59526,59715,68775,60643,60895,61019,71344]);
        }

        $q = $qb->getQuery();

        return collect($q->getResult());
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        $shopifyIds = collect();

        // STEP 1: get all the Orders that we're going to sync
        $orders = $this->getEcommerceEntities($fresh);

        $this->info("Found {$orders->count()} orders to be synced");

        $bar = $this->output->createProgressBar($orders->count());
        $bar->start();

        $tableHeaders = ["Order ID", "Order Item ID", "Order Item Fulfillment ID", "Refund ID", "Shopify ID"];
        $tableRows = [];

        // STEP 2: sync Orders
        $simulatedShopifyId = 0;
        $orders->each(function (Order $order) use ($fresh, $bar, $simulate, $shopifyIds, &$tableRows, &$simulatedShopifyId) {

            // STEP 3: determine if updating or creating
            $isCreating = $fresh || is_null($order->getShopifyId());

            // STEP 4: build up the data structure
            //TODO probably going to need to separate things out for update, because this is already complicated enough
            if (!$isCreating) {
                $this->error(sprintf("Updates are not currently supported. Skipping Order %s", $order->getId()));
                return;
            }
            // $postData = $isCreating ? $this->createOrderData($order)
            //     : $this->updateOrderData($order);
            $postData = $this->createOrderData($order);

            // STEP 5: send the data to Shopify
            if (!$simulate) {

                // STEP 5a: create the Order in Shopify
                // $orderResource = $isCreating ? $this->shopify->createOrder($postData)
                //     : $this->shopify->updateOrder($order->getShopifyId(), $postData);
                $orderResource = $this->shopify->createOrder($postData);

                // record the shopify ID on the Order
                $orderShopifyId = $orderResource->id;
                if ($order->getShopifyId() !== $orderShopifyId) {
                    $order->setShopifyId($orderShopifyId);
                    $this->entityManager->persist($order);
                    $this->entityManager->flush();
                }
                $shopifyIds->push($orderShopifyId);
                $tableRows[] = [$order->getId(), "--", "--", "--", $orderShopifyId];

                // STEP 5b: record the Shopify Order's Line Items as our Order Items
                $resourceLineItems = $orderResource->getAttributes()["line_items"];
                $sentLineItems = $postData["line_items"];
                foreach ($resourceLineItems as $idx => $resourceLineItem) {
                    // grab the shopify id
                    $lineItemShopifyId = $resourceLineItem["id"];
                    // get our corresponding line item data
                    $sentLineItem = $sentLineItems[$idx];
                    // and get our Order Item for it
                    $lineItem = $this->orderItemRepository->find($sentLineItem["ecommerce_order_item_id"]);
                    // and finally, save the shopify id on it
                    if ($lineItem->getShopifyId() !== $lineItemShopifyId) {
                        $lineItem->setShopifyId($lineItemShopifyId);
                        $this->entityManager->persist($lineItem);
                        $this->entityManager->flush();
                    }

                    $tableRows[] = [$order->getId(), $sentLineItem["ecommerce_order_item_id"], "--", "--", $lineItemShopifyId];
                }

                // STEP 6: add the Fulfillments and tracking
                // Shopify created an Order Fulfillment for our Order when they created it, so we need to grab that from them
                $fulfillmentOrders = $this->shopify->getOrderFulfillmentOrders($orderShopifyId);
                // there can be multiple fulfillment orders (but realistically, there will most likely only be one), so grab the last entry
                $fulfillmentOrder = $fulfillmentOrders->last();

                // get each line item from the fulfillment order
                $lineItems = $fulfillmentOrder->getAttributes()["line_items"];
                // and for each line item...
                foreach ($lineItems as $lineItemData) {
                    // get its fulfillment_order_id (so we can create a fulfillment for it)
                    $fulfillmentOrderId = $lineItemData["fulfillment_order_id"];
                    // get its id (so we can tell which fulfillment item it's for)
                    // ** this is the fulfillment order line item, not the actual line item
                    $fulfillmentOrderLineItemId = $lineItemData["id"];
                    // use the line item ID to get our order item (matching the shopify_id)
                    $orderItemShopifyId = $lineItemData["line_item_id"];
                    // and use those IDs to create fulfillments for the order item
                    $fulfillmentRecords = $this->createFulfillmentsForOrderItem($fulfillmentOrderId, $orderItemShopifyId, $fulfillmentOrderLineItemId, $simulate);
                    foreach ($fulfillmentRecords as $fulfillmentRecord) {
                        $tableRows[] = [
                            $order->getId(),
                            "--",
                            $fulfillmentRecord[self::ORDER_ITEM_FULFILLMENT_ID],
                            "--",
                            $fulfillmentRecord[self::SHOPIFY_FULFILLMENT_ID]
                        ];
                    }
                }
                //END STEP 6

                // STEP 7: add any refunds
                //TODO SRR-41: get any of our refunds and send those to shopify

            } else {
                // simulation mode
                $orderItemShopifyId = ++$simulatedShopifyId;
                $tableRows[] = [$order->getId(), "--", "--", "--", $orderItemShopifyId];
                collect($postData["line_items"])->each(function (array $item, int $idx) use ($simulate, $orderItemShopifyId, $order, &$tableRows) {
                    $tableRows[] = [$order->getId(), $item["ecommerce_order_item_id"], "--", "--", $orderItemShopifyId . "-line" . $idx];

                    $fulfillmentRecords = $this->createFulfillmentsForOrderItem($item["ecommerce_order_item_id"], $orderItemShopifyId, $orderItemShopifyId+10, $simulate);
                    foreach ($fulfillmentRecords as $fulfillmentRecord) {
                        $tableRows[] = [
                            $order->getId(),
                            "--",
                            $fulfillmentRecord[self::ORDER_ITEM_FULFILLMENT_ID],
                            "--",
                            $fulfillmentRecord[self::SHOPIFY_FULFILLMENT_ID]
                        ];
                    }
                });
            }

            $bar->advance();
        })->chunk(100);

        $bar->finish();
        $this->newLine();

        $this->table($tableHeaders, $tableRows);

        return $shopifyIds;
    }

    /**
     * Create the data to post to Shopify to create an Order
     *
     * @param Order $order
     * @return array
     */
    private function createOrderData(Order $order): array
    {
        // the user or customer is returned with only their id and email, so get the id and get a fresh copy
        if ($order->getUser()) {
            $purchaser = $this->userRepository->find($order->getUser()->getId());
        } else {
            $purchaser = $this->customerRepository->find($order->getCustomer()->getId());
        }

        $orderData = [
            "customer" => ["id" => $purchaser->getShopifyId()],
            "email" => $purchaser->getEmail(),

            "payment_gateway_names" => collect($order->getPayments())
                ->map(function($payment) {
                    return $payment->getExternalProvider() . " - " . $payment->getGatewayName();
                })->toArray(),

            "note" => $order->getNote(),
            "processed_at" => $order->getCreatedAt()->toIso8601String(),
            "source_name" => $order->getBrand(),
            "subtotal_price" => $order->getProductDue() ?? ($order->getTotalDue() - $order->getTaxesDue() - $order->getShippingDue()),
            "total_outstanding" => $order->getTotalDue() - $order->getTotalPaid(),
            "total_price" => $order->getTotalDue(),
            "total_tax" => $order->getTaxesDue(),
            //TODO?
            // "tags" => "",

            // TODO?
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our order id, etc
            "metafields" => [
                [
                    "key" => "_id",
                    "value" => $order->getId(),
                    "type" => "number_integer",
                    "namespace" => "orders"
                ]
            ]
        ];

        if ($order->getTaxesDue()) {
            $orderData["tax_lines"] = [ "price" => $order->getTaxesDue()];
        }

        // the proper addresses should already have been synced by the user/customer, so only use it if Shopify has it
        if ($order->getBillingAddress()?->getShopifyId()) {
            $orderData["billing_address"] = [ "id" => $order->getBillingAddress()->getShopifyId()];
        }
        if ($order->getShippingAddress()?->getShopifyId()) {
            $orderData["shipping_address"] = [ "id" => $order->getShippingAddress()->getShopifyId()];
        }

        $orderData["line_items"] = $this->createOrderItems($order);

        return $orderData;
    }

    /**
     * Create the data required for all Order Items of the Order
     *
     * @param Order $order
     * @return array
     */
    private function createOrderItems(Order $order): array
    {
        $orderItemsData = [];
        collect($order->getOrderItems())->each(function (OrderItem $orderItem) use ($order, &$orderItemsData) {
            $data = [
               // include our internal id, so we can reference it to update - shopify will just ignore this
               "ecommerce_order_item_id" => $orderItem->getId(),
               "fulfillable_quantity" => $orderItem->getQuantity(),
               "fulfillment_service" => "manual",
               "price" => $orderItem->getInitialPrice(),
               "quantity" => $orderItem->getQuantity(),
               "requires_shipping" => $orderItem->getWeight() > 0,
               "sku" => $orderItem->getProduct()?->getSku(),
               "title" => $orderItem->getProduct()?->getName(),
               "variant_id" => $orderItem->getProduct()?->getShopifyId(),
               "variant_inventory_management" => "shopify",
               "vendor" => $order->getBrand(),
           ];

           if ($orderItem->getOrderItemDiscounts()) {
               // clean up bad data (there are some with discount id 0)
               $orderDiscounts = collect($orderItem->getOrderItemDiscounts())
                   ->filter(function (OrderDiscount $orderDiscount) {
                       return $orderDiscount->getDiscount()->getId();
                   }
                );

               $discountsData = [];
               $orderDiscounts->each(function (OrderDiscount $orderDiscount) use (&$discountsData) {
                       $discountsData[] = [ "amount" => $orderDiscount->getDiscount()?->getAmount()];
                   });
                $data["discount_allocations"] = $discountsData;
           }

            $orderItemsData[] = $data;
        });

        return $orderItemsData;
    }

    /**
     * Using the Shopify Order Line Item's ID, get our related Order Item and create a fulfillment record for it in
     * Shopify for each of our fulfillments for it, and provide the status and tracking information, if available.
     * Returning a formatted array of the Order Item Fulfillment ID and the corresponding Shopify ID.
     *
     * @param int $fulfillmentOrderId - the Shopify ID of the Fulfillment Order we're fulfilling
     * @param int $orderItemShopifyId - the Shopify ID of the line item being filled (used to find our corresponding OrderItem)
     * @param int $fulfillmentOrderLineItemId - the Shopify ID of the fulfillment's line item, needed to tell Shopify which item we're fulfilling
     * @param bool $simulate - is this being simulated?
     *
     * @return array|null
     * @throws Exception
     */
    private function createFulfillmentsForOrderItem(int $fulfillmentOrderId, int $orderItemShopifyId, int $fulfillmentOrderLineItemId, bool $simulate): ?array
    {
        $fulfillmentRecords = [];
        if ($simulate) {
            // if we're simulating, we passed in the order item's ID as the $orderItemShopifyId
            $orderItem = $this->orderItemRepository->find($orderItemShopifyId);
        } else {
            $orderItem = $this->orderItemRepository->getByShopifyId($orderItemShopifyId);
        }

        if (is_null($orderItem)) {
            $this->error(sprintf("No ecommerce Order Item found for shopify_id %s. Skipping fulfillment process with Shopify.", $orderItemShopifyId));
            return null;
        }

        // get the product, so we can see how to handle its fulfillment
        if ($productEntity = $orderItem->getProduct()) {
            // the product might be inactive, so use the id to get a fresh copy with all its data
            $product = $this->productRepository->findProduct($productEntity->getId(), [0,1]);

            if ($product->getType() === Product::TYPE_DIGITAL_SUBSCRIPTION || $product->getType() === Product::TYPE_DIGITAL_ONE_TIME) {
                // digital products don't have fulfillments in Musora, so just create an empty one in Shopify to mark it as fulfilled
                $fulfillmentData = [
                    "fulfillment" => [
                        "notify_customer" => false
                    ],
                    "line_items_by_fulfillment_order" => [
                        [
                            "fulfillment_order_id" => $fulfillmentOrderId,
                            "fulfillment_order_line_items" => [
                                [
                                    "id" => $fulfillmentOrderLineItemId,
                                    "quantity" => $orderItem->getQuantity()
                                ]
                            ]
                        ]
                    ]
                ];
                if ($simulate) {
                    $resultRecord = [
                        self::ORDER_ITEM_FULFILLMENT_ID => "N/A",
                        self::SHOPIFY_FULFILLMENT_ID => $fulfillmentOrderLineItemId
                    ];
                } else {
                    $fulfillmentResult = $this->shopify->createFulfillment($fulfillmentData);
                    $resultRecord = [
                        self::ORDER_ITEM_FULFILLMENT_ID => "N/A",
                        self::SHOPIFY_FULFILLMENT_ID => $fulfillmentResult->getAttributes()["id"]
                    ];
                }

                $fulfillmentRecords[] = $resultRecord;
            } elseif($product->getType() === Product::TYPE_PHYSICAL_ONE_TIME) {

                //TODO: DEV NOTE - this is untested, because we don't have any physical products yet. TEST THIS!!

                // physical products might have fulfillments, so check for any
                $fulfillments = collect($orderItem->getOrderItemFulfillments());

                // and create a fulfillment in Shopify for each one
                $fulfillments->each(function (OrderItemFulfillment $fulfillment, int $idx)
                use (
                    $orderItem,
                    $fulfillmentOrderLineItemId,
                    $orderItemShopifyId,
                    $simulate,
                    $fulfillmentOrderId,
                    &$fulfillmentRecords
                ) {
                    $fulfillmentData = [
                        "fulfillment" => [
                            "notify_customer" => false,
                            "status" => $fulfillment->getStatus() == "fulfilled" ? "success" : "open"
                        ],
                        "line_items_by_fulfillment_order" => [
                            [
                                "fulfillment_order_id" => $fulfillmentOrderId,
                                "fulfillment_order_line_items" => [
                                    [
                                        "id" => $fulfillmentOrderLineItemId,
                                        "quantity" => $orderItem->getQuantity()
                                    ]
                                ]
                            ]
                        ]
                    ];
                    if ($simulate) {
                        $resultRecord = [
                            self::ORDER_ITEM_FULFILLMENT_ID => $fulfillment->getId(),
                            self::SHOPIFY_FULFILLMENT_ID => $orderItemShopifyId . "-fulfil" . $idx
                        ];
                    } else {
                        $fulfillmentResult = $this->shopify->createFulfillment($fulfillmentData);
                        $fulfillmentShopifyId = $fulfillmentResult->getAttributes()["id"];
                        $resultRecord = [
                            self::ORDER_ITEM_FULFILLMENT_ID => $fulfillment->getId(),
                            self::SHOPIFY_FULFILLMENT_ID => $fulfillmentShopifyId
                        ];
                        $fulfillmentRecords[] = $resultRecord;
                        // record the result's id as the shopify_id on our fulfillment
                        if ($fulfillment->getShopifyId() !== $fulfillmentShopifyId) {
                            $fulfillment->setShopifyId($fulfillmentShopifyId);
                            $this->entityManager->persist($fulfillment);
                            $this->entityManager->flush();
                        }
                        // and update it with tracking info, if we have some
                        $trackingData = [
                            "fulfillment" => [
                                "notify_customer" => false,
                                "tracking_info" => [
                                    "company" => $fulfillment->getCompany(),
                                    "number" => $fulfillment->getTrackingNumber()
                                ]
                            ],
                        ];
                        $trackingInfoResult = $this->shopify->updateTrackingForFulfillment($fulfillmentShopifyId, $trackingData);
                        // dd($trackingInfoResult);
                    }
                    $fulfillmentRecords[] = $resultRecord;
                });

            } else {
                throw new Exception(sprintf("Unknown product type %s. Cannot create Shopify Fulfillment.",
                    $product->getType()));
            }

        }
        return $fulfillmentRecords;
    }

    /**
     * Build up the payload data to update an Order
     *
     * @param Order $order
     * @return array
     */
    private function updateOrderData(Order $order): array
    {
    //    TODO
        return [];
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
    protected function getEcommerceEntityRepository(): RepositoryBase
    {
        return $this->orderRepository;
    }
}
