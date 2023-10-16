<?php

namespace App\Modules\Ecommerce\ApiGateways;

use App\Modules\Ecommerce\Models\Shopify\Order;
use Exception;
use Signifly\Shopify\Shopify;

class ShopifyGateway
{
    private Shopify $shopify;

    public function __construct(Shopify $shopify)
    {
        $this->shopify = $shopify;
    }

    public function getCustomerOrders($shopifyCustomerId)
    {
        $orders = collect();
        $cursor = "";
        do {
            $gql = <<<GQL
            query {
                 orders(first:10$cursor, query:"customer_id:$shopifyCustomerId"){
                    nodes {
                        ... on Order {
                            id
                            createdAt
                            cancelledAt
                            brand: metafield(namespace: "Musora", key: "brand") {
                                value
                            }
                            paymentSource: metafield(namespace: "Musora", key: "payment_source") {
                                value
                            }
                            lineItems: lineItems(first: 50) {
                                nodes {
                                    id
                                    sku
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

            $gqlUrl = $this->shopify->getBaseUrl() . "/graphql.json";
            $pollResponse = $this->shopify->graphQl()->post($gqlUrl, ["query" => $gql]);
            if ($pollResponse->successful()) {
                $responseBody = json_decode($pollResponse->body());

                // check for any errors
                $responseErrors = $responseBody->errors ?? [];
                if (!empty($responseErrors)) {
                    throw new Exception(
                        sprintf(
                            "%s: Error(s) returned while attempting to get orders for customer %s: %s",
                            get_class($this),
                            $shopifyCustomerId,
                            collect($responseErrors)->implode("message", " ")
                        )
                    );
                }

                $orders->merge(
                    collect($responseBody->data->orders->nodes)->map(function ($order) {
                        return new Order($order);
                    })
                );
                $hasNextPage = $responseBody->data->orders->pageInfo->hasNextPage;
                $endCursor = $responseBody->data->orders->pageInfo->endCursor;
                $cursor = ", after: \"$endCursor\"";
            } else {
                throw new Exception(
                    sprintf(
                        "%s: Get orders failed for customer %s: %s",
                        get_class($this),
                        $shopifyCustomerId,
                        $pollResponse->reason()
                    )
                );
            }
        } while ($hasNextPage);


        return $orders;
    }


}
