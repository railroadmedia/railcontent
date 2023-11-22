<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\DataTransferObjects\ShopifyCartDTO;
use Exception;
use Illuminate\Support\Arr;
use Shopify\Clients\Graphql;
use Shopify\Clients\Storefront;
use Shopify\Context;
use Shopify\Exception\HttpRequestException;
use Shopify\Exception\MissingArgumentException;

class ShopifyAPIService
{
    public Storefront $storefrontClient;
    public Graphql $adminClient;

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
                            cost {
                                totalAmount {
                                    amount
                                    currencyCode
                                }
                                subtotalAmount {
                                    amount
                                    currencyCode
                                }
                            }
                            merchandise {
                                ... on ProductVariant {
                                    availableForSale
                                    barcode
                                    currentlyNotInStock
                                    id
                                    quantityAvailable
                                    requiresShipping
                                    sku
                                    title
                                    weight
                                    weightUnit
                                    digitalAccessTimeType: metafield(
                                        namespace: "products"
                                        key: "digital_access_time_type"
                                    ) {
                                        value
                                    }
                                    digitalAccessType: metafield(
                                        namespace: "products"
                                        key: "digital_access_type"
                                    ) {
                                        value
                                    }
                                    image {
                                        altText
                                        height
                                        id
                                        originalSrc
                                        src
                                        transformedSrc
                                        url(transform: { maxWidth: 400, maxHeight: 400 })
                                        width
                                    }
                                    product {
                                        id
                                        title
                                        productType
                                        description
                                    }
                                }
                            }
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

        // see: https://admin.shopify.com/store/musora-sandbox-staging/settings/apps/development/62166990849/overview
        // currently using a private app created from the shopify store admin area, not a partner app (yet!)
        Context::initialize(
            apiKey: config('shopify.storefront.api_key'),
            apiSecretKey: config('shopify.storefront.api_secret_key'),
            scopes: config('shopify.storefront.scopes'),
            hostName: config('shopify.storefront.host_name'),
            sessionStorage: $this->sessionService,
            apiVersion: config('shopify.storefront.api_version'),
            isEmbeddedApp: true,
            isPrivateApp: true,
            privateAppStorefrontAccessToken: config('shopify.storefront.access_token'),
        );

        $this->storefrontClient = new Storefront(
            Context::$HOST_NAME,
            Context::$PRIVATE_APP_STOREFRONT_ACCESS_TOKEN
        );

//        dd(config('shopify.storefront.admin_access_token'));

        $this->adminClient = new Graphql(
            Context::$HOST_NAME,
            config('shopify.storefront.admin_access_token')
        );
    }

    /**
     * @param array $productVariantIdsToAddToCart // ex: [ 'variant_id_1' => ['quantity' => 1, 'sellingPlanId' => 123], 'variant_id_2' => ['quantity' => 1, 'sellingPlanId' => 123] ]
     * @param array $discountCodesToAddToCard
     * @return array
     * @throws MissingArgumentException
     * @throws HttpRequestException
     * @throws Exception
     */
    public function createCart(
        array $productVariantIdsAndSellingPlanIdsToAddToCart = [],
        array $discountCodesToAddToCard = []
    ): array {
        $createCartInputLineArray = [];

        foreach ($productVariantIdsAndSellingPlanIdsToAddToCart as $productVariantIdToAddToCart => $quantityAndSellingPlanId) {
            $createCartInputLineItem = [
                'quantity' => (integer)$quantityAndSellingPlanId['quantity'],
                'merchandiseId' => $productVariantIdToAddToCart
            ];

            if (!empty($quantityAndSellingPlanId['sellingPlanId'])) {
                $createCartInputLineItem['sellingPlanId'] = $quantityAndSellingPlanId['sellingPlanId'];
            }

            $createCartInputLineArray[] = $createCartInputLineItem;
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

        $responseBody = $cartData->getBody()->getContents();
        $responseCode = $cartData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $responseCartData = $jsonResponse["data"]["cartCreate"]["cart"] ?? [];

        if ($responseCode !== 200 || empty($responseCartData)) {
            throw new Exception(
                "Shopify API call (cartCreate) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        $cartData = $this->applySpecialDiscountCodesAndRules($responseCartData['id']);

        return $cartData;
    }

    /**
     * @param $cartId
     * @return true
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function clearCart($cartId)
    {
        $shopifyCartData = $this->getCart($cartId);

        $merchandiseLineItemIdsToDelete = [];

        if (!empty($shopifyCartData['lines']['edges'])) {
            foreach ($shopifyCartData['lines']['edges'] as $edge) {
                $shopifyLineItemData = $edge['node'];

                if (empty($shopifyLineItemData)) {
                    continue;
                }

                $merchandiseLineItemIdsToDelete[] = $shopifyLineItemData['id'];
            }
        }

        if (!empty($merchandiseLineItemIdsToDelete)) {
            $this->removeCartItems(
                $cartId,
                $merchandiseLineItemIdsToDelete
            );
        }

        return true;
    }

    /**
     * @param $cartId
     * @param array $productVariantIdsAndSellingPlanIdsToAddToCart
     * @param array $discountCodesToApply
     * @return array
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function addToCart(
        $cartId,
        array $productVariantIdsAndSellingPlanIdsToAddToCart = [],
        array $discountCodesToApply = []
    ): array {
        $createCartInputLineArray = [];

        foreach ($productVariantIdsAndSellingPlanIdsToAddToCart as $productVariantIdToAddToCart => $quantityAndSellingPlanId) {
            $createCartInputLineItem = [
                'quantity' => (integer)$quantityAndSellingPlanId['quantity'],
                'merchandiseId' => $productVariantIdToAddToCart
            ];

            if (!empty($quantityAndSellingPlanId['sellingPlanId'])) {
                $createCartInputLineItem['sellingPlanId'] = $quantityAndSellingPlanId['sellingPlanId'];
            }

            $createCartInputLineArray[] = $createCartInputLineItem;
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

        $responseBody = $cartData->getBody()->getContents();
        $responseCode = $cartData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $responseCartData = $jsonResponse["data"]["cartLinesAdd"]["cart"] ?? [];

        if (!empty($discountCodesToApply)) {
            // always merge with existing discount codes
            $this->applyDiscountCodes(
                $cartId,
                array_unique(
                    array_merge(
                        $discountCodesToApply,
                        collect($responseCartData['discountCodes'] ?? [])->pluck('code')->toArray()
                    )
                )
            );
        }

        if ($responseCode !== 200 || empty($responseCartData)) {
            throw new Exception(
                "Shopify API call (cartLinesAdd) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        $cartData = $this->applySpecialDiscountCodesAndRules($cartId);

        return $cartData;
    }

    /**
     * @param $cartId
     * @param $merchandiseLineItemId
     * @param $newQuantity
     * @return array
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function updateCartItemQuantity(
        $cartId,
        $merchandiseLineItemId,
        $newQuantity
    ): array {
        $updateCartInputLineArray = [
            [
                'quantity' => (integer)$newQuantity,
                'id' => $merchandiseLineItemId
            ]
        ];

        $updateCartInputLineString = $this->jsonStringToGraphQLObjectString(
            json_encode($updateCartInputLineArray, JSON_UNESCAPED_SLASHES)
        );

        $cartString = self::cartGraphQLReturnDataString;
        $userErrorString = self::userErrorsGraphQLReturnDataString;

        $cartData = $this->storefrontClient->query(
            <<<GRAPHQL
                mutation {
                    cartLinesUpdate(
                        cartId: "$cartId",
                        lines: $updateCartInputLineString
                    ) {
                    $cartString
                    $userErrorString
                }
            }
            GRAPHQL,
        );

        $responseBody = $cartData->getBody()->getContents();

        $responseCode = $cartData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $responseCartData = $jsonResponse["data"]["cartLinesUpdate"]["cart"] ?? [];

        if ($responseCode !== 200 || empty($responseCartData)) {
            throw new Exception(
                "Shopify API call (cartLinesUpdate) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        $cartData = $this->applySpecialDiscountCodesAndRules($cartId);

        return $cartData;
    }

    /**
     * @param $cartId
     * @param $merchandiseLineItemId
     * @return array
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function removeCartItems(
        $cartId,
        $merchandiseLineItemIds
    ): array {
        $removeCartInputLineArray = $merchandiseLineItemIds;

        $removeCartInputLineString = $this->jsonStringToGraphQLObjectString(
            json_encode($removeCartInputLineArray, JSON_UNESCAPED_SLASHES)
        );

        $cartString = self::cartGraphQLReturnDataString;
        $userErrorString = self::userErrorsGraphQLReturnDataString;

        $cartData = $this->storefrontClient->query(
            <<<GRAPHQL
                mutation {
                    cartLinesRemove(
                        cartId: "$cartId",
                        lineIds: $removeCartInputLineString
                    ) {
                    $cartString
                    $userErrorString
                }
            }
            GRAPHQL,
        );

        $responseBody = $cartData->getBody()->getContents();

        $responseCode = $cartData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $responseCartData = $jsonResponse["data"]["cartLinesRemove"]["cart"] ?? [];

        if ($responseCode !== 200 || empty($responseCartData)) {
            throw new Exception(
                "Shopify API call (cartLinesRemove) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        $cartData = $this->applySpecialDiscountCodesAndRules($cartId);

        return $cartData;
    }

    /**
     * @param $cartId
     * @param array $productVariantIdsToAddToCart
     * @return array
     * @throws HttpRequestException
     * @throws MissingArgumentException
     * @throws Exception
     */
    public function getCart(
        $cartId
    ): array {
        $cartString = self::cartGraphQLReturnDataString;
        $userErrorString = self::userErrorsGraphQLReturnDataString;

        $cartString = str_replace('cart {', 'cart(id: "' . $cartId . '") {', $cartString);

        $cartData = $this->storefrontClient->query(
            <<<GRAPHQL
                query Cart {
                    $cartString
                }
            GRAPHQL,
        );

        $responseBody = $cartData->getBody()->getContents();
        $responseCode = $cartData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $responseCartData = $jsonResponse["data"]["cart"] ?? [];

        if ($responseCode !== 200) {
            throw new Exception(
                "Shopify API call (cart) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        return $jsonResponse["data"]["cart"] ?? [];
    }

    /**
     * This accepts either Shopify product SKUs or product variant SKUs. It always returns the underlying
     * product Shopify product variant id (not the product ID).
     *
     * @param array $productSKUs
     * @return array
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function getProductVariantIdsFromSKUs(array $productSKUs)
    {
        $productSKUsQueryStrings = [];

        foreach ($productSKUs as $productSKU) {
            $productSKUsQueryStrings[] = "(sku:$productSKU)";
        }

        $productsQueryString = implode(' OR ', $productSKUsQueryStrings);

        $productData = $this->adminClient->query(
            <<<GRAPHQL
                query {
                    productVariants(first: 20, query: "$productsQueryString") {
                        edges {
                            node {
                                id
                                sku
                                sellingPlanGroups(first: 1) {
                                	edges {
                                		node {
                                			sellingPlans(first: 1) {
                                				edges {
                                		            node {
                                		                id
                                			        }
                                			    }
                                			}
                                		}
                                	}
                                }
                            }
                        }
                    }
                }
            GRAPHQL
        );

        $responseBody = $productData->getBody()->getContents();
        $responseCode = $productData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $responseProductVariantData = $jsonResponse["data"]["productVariants"]["edges"] ?? [];

        if ($responseCode !== 200 || empty($responseProductVariantData)) {
            throw new Exception(
                "Shopify API call (productVariants) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        $productSKUsVariantIds = [];

        foreach ($jsonResponse["data"]["productVariants"]["edges"] as $edge) {
            $productSKUsVariantIds[$edge['node']['sku']] = $edge['node']['id'];
        }

        return $productSKUsVariantIds;
    }

    /**
     * This accepts either Shopify product SKUs or product variant SKUs.
     *
     * @param array $productSKUs
     * @return array
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function getProductsVariantsWithSellingPlansFromSKUs(array $productSKUs)
    {
        $productSKUsQueryStrings = [];

        foreach ($productSKUs as $productSKU) {
            $productSKUsQueryStrings[] = "(sku:$productSKU)";
        }

        $productsQueryString = implode(' OR ', $productSKUsQueryStrings);

        $productData = $this->adminClient->query(
            <<<GRAPHQL
                query {
                    productVariants(first: 20, query: "$productsQueryString") {
                        edges {
                            node {
                                id
                                sku
                                availableForSale
                                barcode
                                requiresShipping
                                title
                                weight
                                weightUnit
                                sellingPlanGroups(first: 1) {
                                	edges {
                                		node {
                                			sellingPlans(first: 1) {
                                				edges {
                                		            node {
                                		                id
                                		                description
                                		                name
                                		                options
                                		                position
                                			        }
                                			    }
                                			}
                                		}
                                	}
                                }
                            }
                        }
                    }
                }
            GRAPHQL
        );

        $responseBody = $productData->getBody()->getContents();
        $responseCode = $productData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $responseProductVariantData = $jsonResponse["data"]["productVariants"]["edges"] ?? [];

        if ($responseCode !== 200 || empty($responseProductVariantData)) {
            throw new Exception(
                "Shopify API call (productVariants) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        $productsData = [];

        // always only return the first selling plan
        foreach ($jsonResponse["data"]["productVariants"]["edges"] as $edge) {
            $edge['node']['sellingPlan'] = $edge['node']['sellingPlanGroups']['edges'][0]['node']['sellingPlans']['edges'][0]['node'] ?? null;
            unset($edge['node']['sellingPlanGroups']);
            $productsData[$edge['node']['sku']] = $edge['node'];
        }

        return $productsData;
    }

    /**
     * Based on: https://shopify.dev/docs/api/multipass
     *
     * @param $userEmail
     * @param null $redirectToUrl
     * @return string
     */
    public function generateMultipassToken($userEmail, $redirectToUrl = null)
    {
        $customerDataHash = ['email' => $userEmail];

        $keyMaterial = hash("sha256", config('shopify.multipass.secret_key'), true);
        $encryptionKey = substr($keyMaterial, 0, 16);
        $signatureKey = substr($keyMaterial, 16, 16);

        // Store the current time in ISO8601 format.
        // The token will only be valid for a small timeframe around this timestamp.
        $customerDataHash["created_at"] = date("c");

        // Tell Shopify to redirect to a URL after it authenticates
        if (!empty($redirectToUrl)) {
            $customerDataHash["return_to"] = $redirectToUrl;
        }

        // Serialize the customer data to JSON and encrypt it
        // Use a random IV
        $iv = openssl_random_pseudo_bytes(16);

        // Use IV as first block of ciphertext
        $cipherText = $iv . openssl_encrypt(
                json_encode($customerDataHash),
                "AES-128-CBC",
                $encryptionKey,
                OPENSSL_RAW_DATA,
                $iv
            );

        // Create a signature (message authentication code) of the ciphertext
        // and encode everything using URL-safe Base64 (RFC 4648)
        return strtr(base64_encode($cipherText . hash_hmac("sha256", $cipherText, $signatureKey, true)), '+/', '-_');
    }

    public function getCustomerAccessTokenFromMultipass($userEmail)
    {
        $multipassToken = $this->generateMultipassToken($userEmail);

        $cartData = $this->storefrontClient->query(
            <<<GRAPHQL
                mutation {
                    customerAccessTokenCreateWithMultipass(
                        multipassToken: "$multipassToken",
                    ) {
                    customerAccessToken {
                      accessToken
                    }
                    customerUserErrors {
                        code
                        field
                        message
                    }
                }
            }
            GRAPHQL,
        );

        $responseBody = $cartData->getBody()->getContents();

        $responseCode = $cartData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $accessToken = $jsonResponse["data"]["customerAccessTokenCreateWithMultipass"]["customerAccessToken"]["accessToken"] ?? '';

        if ($responseCode !== 200 || empty($accessToken)) {
            throw new Exception(
                "Shopify API call (cartLinesRemove) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        return $accessToken;
    }

    public function getAllCustomersOrders($userEmail)
    {
        $customerAccessToken = $this->getCustomerAccessTokenFromMultipass($userEmail);

        $orderData = $this->storefrontClient->query(
            <<<GRAPHQL
            query {
              customer(customerAccessToken: "$customerAccessToken") {
                id
                orders(first: 40, sortKey: PROCESSED_AT) {
                    edges {
                        node {
                            cancelReason
                            canceledAt
                            currencyCode
                            customerLocale
                            customerUrl
                            edited
                            email
                            financialStatus
                            fulfillmentStatus
                            id
                            name
                            orderNumber
                            phone
                            processedAt
                            statusUrl
                            lineItems(first: 15) {
                                edges {
                                    node {
                                        currentQuantity
                                        quantity
                                        title
                                    }
                                }
                            }
                            totalPrice {
                                amount
                            }
                        }
                    }
                }
              }
            }

            GRAPHQL
        );

        $responseBody = $orderData->getBody()->getContents();
        $responseCode = $orderData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $responseOrdersData = $jsonResponse["data"]["customer"]["orders"]["edges"] ?? [];

        if ($responseCode !== 200) {
            throw new Exception(
                "Shopify API call (orders) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        $allOrdersData = [];

        // always only return the first selling plan
        foreach ($responseOrdersData as $ordersDataNode) {
            $orderData = $ordersDataNode['node'];

            $itemTitlesArray = [];

            foreach ($orderData['lineItems']['edges'] as $lineItemNode) {
                $lineItemProductData = $lineItemNode['node'];
                $itemTitlesArray[] = $lineItemProductData['title'];
            }

            $orderData['itemsProductTitlesString'] = implode(', ', $itemTitlesArray);
            $orderData['totalPrice'] = $orderData['totalPrice']['amount'];
            $allOrdersData[] = $orderData;
        }

        return $allOrdersData;
    }

    private function applySpecialDiscountCodesAndRules($cartId)
    {
        $cartData = $this->getCart($cartId);

        if (empty($cartData)) {
            return true;
        }

        $currentDiscountCodes = collect($cartData['discountCodes'] ?? [])->pluck('code')->toArray();

        $applyAnnualMembershipDiscountCode = false;
        $freeWithAnnualDiscountCode = config('shopify.discount_codes.free_with_annual');

        $applyLifetimeMembershipDiscountCode = false;
        $freeWithLifetimeDiscountCode = config('shopify.discount_codes.free_with_lifetime');

        foreach ($cartData['lines']['edges'] as $lineItemNode) {
            $lineItemData = $lineItemNode['node'];
            $merchandise = $lineItemData['merchandise'];
            $product = $lineItemData['merchandise']['product'];

            if (strtolower($product['productType'] ?? '') === 'digital subscription' &&
                (float)$lineItemData['cost']['totalAmount']['amount'] > 100) {
                $applyAnnualMembershipDiscountCode = true;
            }

            if (($merchandise['digitalAccessTimeType']['value'] ?? null) === 'lifetime' &&
                (($merchandise['digitalAccessType']['value'] ?? null) === 'all content access' ||
                    ($merchandise['digitalAccessType']['value'] ?? null) === 'basic content access')  &&
                (float)$lineItemData['cost']['totalAmount']['amount'] > 250) {
                $applyLifetimeMembershipDiscountCode = true;
            }
        }

        // don't set if there are any quantities more than 1 or total cart items is more than 10;
        if (count($cartData['lines']['edges']) > 20) {
            $applyAnnualMembershipDiscountCode = false;
            $applyLifetimeMembershipDiscountCode = false;
        }

        // never in the same order
        if ($applyLifetimeMembershipDiscountCode) {
            $applyAnnualMembershipDiscountCode = false;
        }

        // apply code annual
        if ($applyAnnualMembershipDiscountCode) {
            $currentDiscountCodes[] = $freeWithAnnualDiscountCode;
        } else {
            if (($key = array_search($freeWithAnnualDiscountCode, $currentDiscountCodes)) !== false) {
                unset($currentDiscountCodes[$key]);
            }
        }

        // apply code lifetime
        if ($applyLifetimeMembershipDiscountCode) {
            $currentDiscountCodes[] = $freeWithLifetimeDiscountCode;
        } else {
            if (($key = array_search($freeWithLifetimeDiscountCode, $currentDiscountCodes)) !== false) {
                unset($currentDiscountCodes[$key]);
            }
        }

        return $this->applyDiscountCodes($cartId, $currentDiscountCodes);
    }

    public function applyDiscountCodes($cartId, array $discountCodes)
    {
        $addDiscountCodeInputLineArray = $discountCodes;

        $addDiscountCodeInputLineString = $this->jsonStringToGraphQLObjectString(
            json_encode(array_values($addDiscountCodeInputLineArray), JSON_UNESCAPED_SLASHES)
        );

        $cartString = self::cartGraphQLReturnDataString;
        $userErrorString = self::userErrorsGraphQLReturnDataString;

        $cartData = $this->storefrontClient->query(
            <<<GRAPHQL
                mutation {
                    cartDiscountCodesUpdate(
                        cartId: "$cartId",
                        discountCodes: $addDiscountCodeInputLineString
                    ) {
                    $cartString
                    $userErrorString
                }
            }
            GRAPHQL,
        );

        $responseBody = $cartData->getBody()->getContents();

        $responseCode = $cartData->getStatusCode();

        $jsonResponse = json_decode($responseBody, true);

        $responseCartData = $jsonResponse["data"]["cartDiscountCodesUpdate"]["cart"] ?? [];

        if ($responseCode !== 200 || empty($responseCartData)) {
            throw new Exception(
                "Shopify API call (cartDiscountCodesUpdate) error: " .
                "HTTP status code: $responseCode - " .
                "HTTP response body: $responseBody"
            );
        }

        return $jsonResponse["data"]["cartDiscountCodesUpdate"]["cart"];
    }

    private function jsonStringToGraphQLObjectString($jsonString)
    {
        return preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $jsonString);
    }
}
