<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\DataTransferObjects\ShopifyCartDTO;
use Shopify\Clients\Storefront;
use Shopify\Context;
use Shopify\Exception\HttpRequestException;
use Shopify\Exception\MissingArgumentException;

class ShopifyStoreFrontAPIService
{
    public Storefront $storefrontClient;
    public ShopifyStoreFrontAPISessionService $sessionService;

    private const cartGraphQLReturnDataString =
        <<<GRAPHQL
            cart {
                checkoutUrl
                createdAt
                id
                note
                totalQuantity
                updatedAt
                buyerIdentity {
                    countryCode
                    email
                    phone
                    walletPreferences
                    customer {
                        acceptsMarketing
                        createdAt
                        displayName
                        email
                        firstName
                        id
                        lastName
                        numberOfOrders
                        phone
                        tags
                        updatedAt
                    }
                }
                cost {
                    totalAmount {
                        amount
                        currencyCode
                    }
                    checkoutChargeAmount {
                        amount
                        currencyCode
                    }
                    subtotalAmount {
                        amount
                        currencyCode
                    }
                    totalTaxAmount {
                        amount
                        currencyCode
                    }
                }
                lines(first: 100) {
                    edges {
                        node {
                            id
                            quantity
                        }
                    }
                }
                discountCodes {
                    applicable
                    code
                }
            }
        GRAPHQL;

    private const userErrorsGraphQLReturnDataString =
        <<<GRAPHQL
            userErrors {
                code
                field
                message
            }
        GRAPHQL;

    /**
     * @throws MissingArgumentException
     */
    public function __construct()
    {
        $this->sessionService = new ShopifyStoreFrontAPISessionService();

        Context::initialize(
            apiKey: config('shopify.apiKey'),
            apiSecretKey: config('shopify.apiSecretKey'),
            scopes: config('shopify.scopes'),
            hostName: config('shopify.hostName'),
            sessionStorage: $this->sessionService,
            apiVersion: config('shopify.apiVersion'),
            isEmbeddedApp: true,
            isPrivateApp: true,
            privateAppStorefrontAccessToken: config('shopify.privateAppStorefrontAccessToken'),
        );

        $this->storefrontClient = new Storefront(
            Context::$HOST_NAME,
            Context::$PRIVATE_APP_STOREFRONT_ACCESS_TOKEN
        );
    }

    /**
     * @param array $productVariantIdsToAddToCart // ex: [ 'variant_id_1' => quantity, 'variant_id_2' => quantity ]
     * @param array $discountCodesToAddToCard
     * @return array
     * @throws MissingArgumentException
     * @throws HttpRequestException
     */
    public function createCart(
        array $productVariantIdsToAddToCart = [],
        array $discountCodesToAddToCard = []
    ): array {
        $createCartInputLineArray = [];

        foreach ($productVariantIdsToAddToCart as $productVariantIdToAddToCart => $quantity) {
            $createCartInputLineArray[] = [
                'quantity' => $quantity,
                'merchandiseId' => 'gid://shopify/ProductVariant/' . $productVariantIdToAddToCart
            ];
        }

        $createCartInputLineString = $this->jsonStringToGraphQLObjectString(
            json_encode($createCartInputLineArray, JSON_UNESCAPED_SLASHES)
        );

        $createCartDiscountCodesString = $this->jsonStringToGraphQLObjectString(
            json_encode($discountCodesToAddToCard, JSON_UNESCAPED_SLASHES)
        );

        $cartString = self::cartGraphQLReturnDataString;
        $userErrorString = self::userErrorsGraphQLReturnDataString;

        $cartData = $this->storefrontClient->query(
            <<<GRAPHQL
                mutation {
                    cartCreate(
                        input: {
                            lines: $createCartInputLineString,
                            discountCodes: $createCartDiscountCodesString
                        }
                    ) {
                    $cartString
                    $userErrorString
                }
            }
            GRAPHQL,
        );

        $jsonResponse = json_decode($cartData->getBody()->getContents(), true);

        return $jsonResponse["data"]["cartCreate"]["cart"];
    }

    /**
     * @param $cartId
     * @param array $productVariantIdsToAddToCart
     * @return array
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function addToCart(
        $cartId,
        array $productVariantIdsToAddToCart = []
    ): array {
        $createCartInputLineArray = [];

        foreach ($productVariantIdsToAddToCart as $productVariantIdToAddToCart => $quantity) {
            $createCartInputLineArray[] = [
                'quantity' => $quantity,
                'merchandiseId' => 'gid://shopify/ProductVariant/' . $productVariantIdToAddToCart
            ];
        }

        $createCartInputLineString = $this->jsonStringToGraphQLObjectString(
            json_encode($createCartInputLineArray, JSON_UNESCAPED_SLASHES)
        );

        $cartString = self::cartGraphQLReturnDataString;
        $userErrorString = self::userErrorsGraphQLReturnDataString;

        $cartData = $this->storefrontClient->query(
            <<<GRAPHQL
                mutation {
                    cartLinesAdd(
                        cartId: "$cartId",
                        lines: $createCartInputLineString
                    ) {
                    $cartString
                    $userErrorString
                }
            }
            GRAPHQL,
        );

        $jsonResponse = json_decode($cartData->getBody()->getContents(), true);

        dd($jsonResponse);

        return $jsonResponse["data"]["cartLinesAdd"]["cart"];
    }


    private function jsonStringToGraphQLObjectString($jsonString)
    {
        return preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $jsonString);
    }
}
