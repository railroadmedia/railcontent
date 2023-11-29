<?php

namespace App\Modules\Ecommerce\ApiGateways;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Models\Shopify\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\Shopify;

class ShopifyGateway
{
    private Shopify $shopify;
    private $lastQueryCost = null;

    public function __construct(Shopify $shopify)
    {
        $this->shopify = $shopify;
    }

    public function getCustomerOrders($shopifyCustomerId)
    {
        $orders = collect();
        $cursor = "";
        $musoraNamespace = ShopifyMetafieldNamespace::Musora->value;
        $brandFieldKey = ShopifyMetafieldKey::Brand->value;
        $paymentSourceKey = ShopifyMetafieldKey::PaymentSource->value;
        do {
            $gql = <<<GQL
            query {
                 orders(first:10$cursor, query:"customer_id:$shopifyCustomerId"){
                    nodes {
                        ... on Order {
                            id
                            processedAt
                            cancelledAt
                            brand: metafield(namespace: "$musoraNamespace", key: "$brandFieldKey") {
                                value
                            }
                            paymentSource: metafield(namespace: "$musoraNamespace", key: "$paymentSourceKey") {
                                value
                            }
                            lineItems: lineItems(first: 50) {
                                nodes {
                                    id
                                    sku
                                }
                            }
                            totalPriceSet {
                                shopMoney {
                                    amount
                                }
                            }
                        }
                    }
                    pageInfo {
                      hasNextPage
                      endCursor
                    }
                }
            }
            GQL;

            $responseBody = $this->executeQuery($gql);


            $orders = $orders->merge(
                collect($responseBody->data->orders->nodes)->map(function ($order) {
                    return new Order($order);
                })
            );
            $hasNextPage = $responseBody->data->orders->pageInfo->hasNextPage;
            $endCursor = $responseBody->data->orders->pageInfo->endCursor;
            $cursor = ", after: \"$endCursor\"";
        } while ($hasNextPage);


        return $orders;
    }

    public function getCustomerOrderByProcessAtDate(int $shopifyCustomerId, Carbon $processedAt) {
        // DEV NOTE: we must supply the datetime as a properly formatted string, and for some reason Shopify isn't
        // taking the full datetime string into account when querying processed_at:\"$processedAtString\", and instead
        // only uses the date. So as a workaround, just check >= and <=.
        $processedAtString = $processedAt->toIso8601String();
        $gql = <<<GQL
            query {
                 orders(first:1, query:"customer_id:$shopifyCustomerId AND processed_at:>=\"$processedAtString\" AND processed_at:<=\"$processedAtString\""){
                    nodes {
                        ... on Order {
                            id,
                            legacyResourceId
                        }
                    }
                }
            }
            GQL;
        $responseBody = $this->executeQuery($gql);
        return $responseBody->data->orders->nodes;
    }

    public function doesOrderExist(int $shopifyCustomerId, Carbon $processedAt): bool
    {
        return count($this->getCustomerOrderByProcessAtDate($shopifyCustomerId, $processedAt));
    }

    public function executeQuery(string $gql): mixed
    {
        $this->handleRateLimitBefore();
        $gqlUrl = $this->shopify->getBaseUrl() . "/graphql.json";
        $pollResponse = $this->shopify->graphQl()->post($gqlUrl, ["query" => $gql]);
        if ($pollResponse->successful()) {
            $responseBody = json_decode($pollResponse->body());
            $this->lastQueryCost = $responseBody->extensions->cost ?? null;

            // check for any errors
            $responseErrors = $responseBody->errors ?? [];
            if (!empty($responseErrors)) {
                throw new Exception(
                    sprintf(
                        "%s: Error(s) returned: %s",
                        get_class($this),
                        collect($responseErrors)->implode("message", " ")
                    )
                );
            }
        } else {
            throw new Exception(
                sprintf(
                    "%s: Error(s) returned: %s",
                    get_class($this),
                    $pollResponse->reason()
                )
            );
        }
        return $responseBody;
    }

    protected function handleRateLimitBefore(): void
    {
        $lastQueryCost = $this->lastQueryCost;
        if (!$lastQueryCost) {
            return;
        }
        $rateLimitThresholdPercentage = config('shopify.rate_limit_gql.threshold_percentage');
        $rateLimitSleepTime = config('shopify.rate_limit_gql.sleep_time');

        $current = $lastQueryCost->throttleStatus->currentlyAvailable;
        $max = $lastQueryCost->throttleStatus->maximumAvailable;
        $percentageUsed = round(($max - $current) / $max * 100, 1);

        if ($percentageUsed > $rateLimitThresholdPercentage) {
            Log::debug("Shopify Graph QL availability: $current/$max ($percentageUsed%)");
            Log::warning(
                sprintf(
                    "About to hit Shopify Graph QL API rate limit. Sleeping for %s %s...",
                    $rateLimitSleepTime,
                    Str::plural("second", $rateLimitSleepTime)
                )
            );
            sleep($rateLimitSleepTime);
        }
    }
}
