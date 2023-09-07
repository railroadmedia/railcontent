<?php

namespace App\Modules\Ecommerce\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Signifly\Shopify\Shopify;

class ShopifyCartAPIController extends Controller
{
    private Shopify $shopify;

    public function __construct(Shopify $shopify)
    {
        $this->shopify = $shopify;
    }

    public function handleWebhook(Request $request)
    {
        dd($request->all());
    }

    public function addToCart(Request $request)
    {
        $gqlUrl = $this->shopify->getBaseUrl() . "/graphql.json";

        $data['query'] =
            'mutation CartCreate($input: CartInput) {
    cartCreate(input: $input) {
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
            }
            lines(first: 100) {
                edges {
                    node {
                        id
                        quantity
                    }
                }
            }
        }
        userErrors {
            code
            field
            message
        }
    }
}';

        $data['variables'] = [
            'input' => [
                'lines' => [
                    ['quantity' => 1, 'merchandiseId' => 'gid://shopify/ProductVariant/46137514361127']
                ]
            ]
        ];

        $results = $this->shopify->graphQl()->post($gqlUrl, $data);
        dd($results->body());
    }
}
