<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
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
use Illuminate\Support\Str;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class AddOrderTagsJobManager implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use ExecutesShopifyGraphQlQuery;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected const TIMEOUT = 840;
    protected const PAGE_SIZE = 50;
    protected Shopify $shopify;
    protected bool $hasNextPage = false;

    public function __construct(
        protected ?string $endCursor,
        protected ?int $customerId,
        protected string $startProcessedAt,
        protected string $endProcessedAt,
        protected bool $simulate,
        protected int $trialConversionDayLimit = 45
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled];
    }

    /**
     * @throws Exception
     */
    public function handle(Shopify $shopify): void
    {
        // set DI instances that we'll need
        $this->shopify = $shopify;

        $orderIds = $this->getOrderIds($this->endCursor);
        if ($orderIds->isEmpty()) {
            return;
        }

        // make a REST call to get the orders
        $orders = $this->shopify->getOrders(['ids' => $orderIds->implode(','), 'status' => 'any']);
        $orders->transform(
            fn(OrderResource $orderResource) => new Order(
                json_decode(json_encode($orderResource->getAttributes()), false)
            )
        );
        // add a new job into the batch, for each order's data
        $jobs = [];
        $orders->each(function (Order $order) use (&$jobs) {
            $jobs[] = new AddOrderTags($order, $this->trialConversionDayLimit, $this->simulate);
        });
        $this->batch()->add($jobs);

        // if there are more results to get, add another job to the batch
        if ($this->hasNextPage) {
            $this->batch()->add(
                new AddOrderTagsJobManager(
                    $this->endCursor,
                    $this->customerId,
                    $this->startProcessedAt,
                    $this->endProcessedAt,
                    $this->simulate,
                    $this->trialConversionDayLimit
                )
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
    private function getOrderIds(?string $endCursor): Collection
    {
        $count = self::PAGE_SIZE;
        $cursor = empty($endCursor) ? "" : "after: \"$endCursor\",";
        $customerIdQuery = empty($this->customerId) ? "" : " AND customer_id:{$this->customerId}";

        $gql = <<<GQL
            query {
                orders(first: $count, $cursor query: "processed_at:>=\"$this->startProcessedAt\" AND processed_at:<=\"$this->endProcessedAt\"$customerIdQuery AND status:any", sortKey: PROCESSED_AT) {
                    nodes {
                        ... on Order {
                            id
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

        $this->hasNextPage = $responseBody->data->orders->pageInfo->hasNextPage;
        $this->endCursor = $responseBody->data->orders->pageInfo->endCursor;

        return collect($responseBody->data->orders->nodes)
            ->transform(fn($data) => Str::after($data->id, "gid://shopify/Order/"));
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
        return false;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return class_basename(__CLASS__);
    }
}
