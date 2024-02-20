<?php

namespace App\Modules\Ecommerce\ApiGateways;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Models\Shopify\MetaFieldDefinition;
use App\Modules\Ecommerce\Models\Shopify\Order;
use App\Modules\Ecommerce\Traits\ExecutesShopifyGraphQlQuery;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Signifly\Shopify\Shopify;

class ShopifyGateway
{
    use ExecutesShopifyGraphQlQuery;

    private Shopify $shopify;

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

    /**
     * Get all unique customer email addresses who have an order that was updated between the given dates.
     *
     * @param  Carbon  $startDate
     * @param  Carbon  $endDate
     * @return Collection
     * @throws Exception
     */
    public function getCustomersToUpdate(Carbon $startDate, Carbon $endDate): Collection
    {
        $emails = collect();
        $cursor = "";
        $startDateString = $startDate->toIso8601String();
        $endDateString = $endDate->toIso8601String();

        $i = 0;
        $max = 100;
        do {
            $this->handleRateLimitBefore();
            $gql = <<<GQL
            query {
                 orders(first:250$cursor, query:"updated_at:>=\"$startDateString\" AND updated_at:<=\"$endDateString\""){
                    nodes {
                        ... on Order {
                            customer {
                                email
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


            $emails = $emails->merge(
                collect($responseBody->data->orders->nodes)->map(function ($order) {
                    return $order->customer->email;
                })
            );
            $hasNextPage = $responseBody->data->orders->pageInfo->hasNextPage;
            $endCursor = $responseBody->data->orders->pageInfo->endCursor;
            $cursor = ", after: \"$endCursor\"";
            $i++;
        } while ($hasNextPage && $i < $max);
        return $emails->unique();
    }

    public function doesOrderExist(int $shopifyCustomerId, Carbon $processedAt): bool
    {
        return count($this->getCustomerOrderByProcessAtDate($shopifyCustomerId, $processedAt));
    }

    public function getCustomerOrderByProcessAtDate(int $shopifyCustomerId, Carbon $processedAt)
    {
        // DEV NOTE: we must supply the datetime as a properly formatted string, and for some reason Shopify isn't
        // taking the full datetime string into account when querying processed_at:\"$processedAtString\", and instead
        // only uses the date. So as a workaround, just check >= and <=.
        $processedAtStartString = $processedAt->clone()->addDays(-1)->toIso8601String();
        $processedAtEndString = $processedAt->clone()->addDays(1)->toIso8601String();
        $gql = <<<GQL
            query {
                 orders(first:1, query:"customer_id:$shopifyCustomerId AND processed_at:>=\"$processedAtStartString\" AND processed_at:<=\"$processedAtEndString\""){
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

    public function defineMetaField()
    {
        $namespace = ShopifyMetafieldNamespace::Model_Users->value;
        $key = ShopifyMetafieldKey::LastTrialEndDate->value;
        $type = ShopifyMetafieldTypes::date->value;
        $query =
            <<<GRAPHQL
                mutation {
                    metafieldDefinitionCreate (definition: {
                        name: "Last Free Trial End"
                        namespace: "$namespace"
                        key: "$key"
                        type: "$type"
                        ownerType: CUSTOMER
                        description: "End date of the users previous free trial"
                    }
                    ) {
                    createdDefinition {
                        id
                        name
                    }
                    userErrors {
                        field
                        message
                        code
                    }
                }
            }
            GRAPHQL;
        $response = $this->executeQuery($query);
        return $response;
    }

    public function updateCustomerLastTrialEndDate($customerID, $lastTrialEndDate)
    {
        // This data is processed by the shopify extension: checkout-block-repeated-trials
        // in the repository: musora-shop-ify-extensions-app
        $namespace = ShopifyMetafieldNamespace::Model_Users->value;
        $key = ShopifyMetafieldKey::LastTrialEndDate->value;
        $type = ShopifyMetafieldTypes::date->value;
        $lastTrialEndDate = $lastTrialEndDate->toDateString();
        $query =
            <<<GRAPHQL
                mutation {
                    metafieldsSet( metafields: {
                        namespace: "$namespace"
                        key: "$key"
                        type: "$type"
                        ownerId:  "gid://shopify/Customer/$customerID"
                        value: "$lastTrialEndDate"
                    }
                    ) {
                    metafields {
                        key
                        namespace
                        value
                        createdAt
                        updatedAt
                    }
                    userErrors {
                        field
                        message
                        code
                    }
                }
            }
            GRAPHQL;
        $response = $this->executeQuery($query);
        return $response;
    }

    /**
     * Check if there's a metafield definition in Shopify that matches the given MetaFieldDefinition
     *
     * @param  MetaFieldDefinition  $metaFieldDefinition
     * @return bool
     * @throws Exception
     */
    public function doesMetaFieldDefinitionExist(MetaFieldDefinition $metaFieldDefinition): bool
    {
        $ownerType = $metaFieldDefinition->ownerType;
        $key = $metaFieldDefinition->key;
        $name = $metaFieldDefinition->name;
        $namespace = $metaFieldDefinition->namespace;
        $type = $metaFieldDefinition->type;

        $gql = <<<GQL
            query {
                metafieldDefinitions(first:1, ownerType: $ownerType, query:"key:$key AND name:$name AND namespace:$namespace AND type:$type") {
                    nodes {
                        id
                        key
                        name
                        namespace
                        validations {
                            name
                            type
                            value
                        }
                        type {
                            name
                        }
                    }
                }
            }
            GQL;

        $responseBody = $this->executeQuery($gql);
        return collect($responseBody->data->metafieldDefinitions->nodes)->isNotEmpty();
    }

    /**
     * Create a new metafield definition in Shopify with the given MetaFieldDefinition
     * @param  MetaFieldDefinition  $metaFieldDefinition
     * @return mixed
     * @throws Exception
     */
    public function createMetaFieldDefinition(MetaFieldDefinition $metaFieldDefinition): mixed
    {
        $ownerType = $metaFieldDefinition->ownerType;
        $key = $metaFieldDefinition->key;
        $name = $metaFieldDefinition->name;
        $description = $metaFieldDefinition->description;
        $namespace = $metaFieldDefinition->namespace;
        $type = $metaFieldDefinition->type;

        $query = <<<GRAPHQL
                mutation {
                    metafieldDefinitionCreate(definition: {
                        name: "$name",
                        namespace: "$namespace",
                        key: "$key",
                        type: "$type",
                        ownerType: $ownerType,
                        description: "$description"
                    }
                    ) {
                    createdDefinition {
                        id
                        name
                        namespace
                        key
                    }
                    userErrors {
                        field
                        message
                        code
                    }
                }
            }
            GRAPHQL;
        return $this->executeQuery($query);
    }

    /**
     * @inheritDoc
     */
    protected function getShopifyConnection(): Shopify
    {
        return $this->shopify;
    }
}
