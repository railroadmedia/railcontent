<?php

namespace App\Modules\Ecommerce\tests\Unit\Jobs;

use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyTagEnum;
use App\Modules\Ecommerce\Jobs\Shopify\AddOrderTags;
use App\Modules\Ecommerce\Models\OrderPayment;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\tests\resources\Shopify\fixtures\ReadsFixture;
use Exception;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Signifly\Shopify\Shopify;
use Tests\TestCase;

class AddOrderTagsTest extends TestCase
{
    use ReadsFixture;

    protected string $baseShopifyUrl;

    public function test_adds_initial_order_tag_for_manual_source(): void
    {
        // the order id from the resource file
        $orderId = 5655911268646;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/updated/first_physical_only.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._only_physical_order')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Adding tags to Shopify Order $orderId: ".ShopifyTagEnum::InitialOrder->value
                ) === 0;
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });

        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::InitialOrder->value])
                );
        });
    }

    public function test_adds_initial_order_tag_for_revenuecat_initial_purchase(): void
    {
        // the order id from the resource file
        $orderId = 5733522800934;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_plus_monthly_membership_revenuecat_initial_purchase.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._revenuecat')
            ),
            // call to get the order's metafields: return back our fixture
            "$this->baseShopifyUrl/orders/*" => Http::response(
                $this->fixture('order.metafields._revenuecat_initial_purchase')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Adding tags to Shopify Order $orderId: ".ShopifyTagEnum::InitialOrder->value
                ) === 0;
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::InitialOrder->value])
                );
        });
    }

    public function test_does_not_add_initial_order_tag_for_revenuecat_renewal(): void
    {
        // the order id from the resource file
        $orderId = 5732685316390;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_plus_monthly_membership_revenuecat_renewal.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._revenuecat')
            ),
            // call to get the order's metafields: return back our fixture
            "$this->baseShopifyUrl/orders/*" => Http::response(
                $this->fixture('order.metafields._revenuecat_renewal')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Adding tags to Shopify Order $orderId: ".ShopifyTagEnum::MembershipRenewal->value
                ) === 0;
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job does not send out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertNotSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains($request->data()['query'], 'tags: ["'.ShopifyTagEnum::InitialOrder->value.'"]');
        });

        // make sure the job sends out the HTTP request to the graphql endpoint with the membership renewal tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::MembershipRenewal->value])
                );
        });
    }

    public function test_skips_initial_order_tag_if_already_present(): void
    {
        // the order id from the resource file
        $orderId = 5655911268646;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/updated/first_physical_only.json"
        );
        $json = json_decode(file_get_contents($path), true);

        // add the tag, to simulate it already being in Shopify
        $json['body']['tags'] = ShopifyTagEnum::InitialOrder->value;

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._only_physical_order')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Adding tags to Shopify Order $orderId: (none)"
                ) === 0;
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job does not send out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertNotSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains($request->data()['query'], 'tags: ["'.ShopifyTagEnum::InitialOrder->value.'"]');
        });
    }

    public function test_does_not_add_initial_order_tag_for_subscription_contract(): void
    {
        $orderId = 5739903844644;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/musora_annual_membership_recharge_renewal.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._musora_annual_membership_recharge')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Adding tags to Shopify Order $orderId: (none)",
                ) === 0;
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job does not send out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertNotSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains($request->data()['query'], 'tags: ["'.ShopifyTagEnum::InitialOrder->value.'"]');
        });
    }

    public function test_adds_trial_start_order_tag(): void
    {
        // the order id from the resource file
        $orderId = 5670901547302;
        $path = Storage::disk("ecommerce_test_resources")->path("Shopify/requests/order/created/drumeo_trial.json");
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._drumeo_memberships')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        // this is both the initial order and the trial start
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return Str::containsAll(
                    $message,
                    [
                        "AddOrderTags: Adding tags to Shopify Order $orderId: ",
                        ShopifyTagEnum::TrialStart->value,
                        ShopifyTagEnum::InitialOrder->value
                    ]
                );
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the initial order and trial start tags
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::TrialStart->value, ShopifyTagEnum::InitialOrder->value])
                );
        });
    }

    public function test_adds_trial_start_when_discount_is_on_discount_allocations(): void
    {
        // the order id from the resource file
        $orderId = 5716409221396;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_trial_discount_allocation.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._drumeo_trial_discount_allocation')
            ),
            // call to get the order's metafields: return back our fixture
            "$this->baseShopifyUrl/orders/*" => Http::response(
                $this->fixture('order.metafields._drumeo_trial_discount_allocation')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        // this is both the initial order and the trial start
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return Str::containsAll(
                    $message,
                    [
                        "AddOrderTags: Adding tags to Shopify Order $orderId: ",
                        ShopifyTagEnum::InitialOrder->value,
                        ShopifyTagEnum::TrialStart->value
                    ]
                );
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the initial order and trial start tags
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::TrialStart->value, ShopifyTagEnum::InitialOrder->value])
                );
        });
    }

    public function test_adds_trial_conversion_order_tag(): void
    {
        // the order id from the resource file
        $orderId = 5670966231334;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._drumeo_memberships')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return Str::containsAll(
                    $message,
                    [
                        "AddOrderTags: Adding tags to Shopify Order $orderId: ",
                        ShopifyTagEnum::TrialConversion->value
                    ]
                );
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the trial conversion tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::TrialConversion->value])
                );
        });
    }

    public function test_adds_membership_renewal_order_tag(): void
    {
        // the order id from the resource file
        $orderId = 5671228244262;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership_renewal.json"
        );
        $json = json_decode(file_get_contents($path), true);
        // set the source to be an automated one, so that we don't have the Initial Order tag trump the Membership Renewal
        $json['body']['source_name'] = config('shopify.automated_source_names')[0];

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._drumeo_memberships')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return Str::containsAll(
                    $message,
                    [
                        "AddOrderTags: Adding tags to Shopify Order $orderId: ",
                        ShopifyTagEnum::MembershipRenewal->value
                    ]
                );
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the membership renewal tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([
                        ShopifyTagEnum::MembershipRenewal->value
                    ])
                );
        });
    }

    public function test_does_not_add_membership_renewal_order_tag_when_trumped_by_initial_order(): void
    {
        // the order id from the resource file
        $orderId = 5671228244262;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership_renewal.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._drumeo_memberships')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return Str::containsAll(
                    $message,
                    [
                        "AddOrderTags: Adding tags to Shopify Order $orderId: ",
                        ShopifyTagEnum::InitialOrder->value
                    ]
                );
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([
                        ShopifyTagEnum::InitialOrder->value
                    ])
                );
        });
    }

    public function test_adds_membership_renewal_order_tag_and_removes_initial_order_for_subscription_payments(): void
    {
        $subscriptionPayment = SubscriptionPayment::factory()->create();
        // the order id from the resource file
        $orderId = 5566123016468;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/updated/imported_subscription_payment.json"
        );
        $json = json_decode(file_get_contents($path), true);
        // add the tag, for our test case where it was improperly added
        $json['body']['tags'] = ShopifyTagEnum::InitialOrder->value;
        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._imported_subscription_payment')
            ),
            // call to get the order's metafields: return back our fixture
            "$this->baseShopifyUrl/orders/*" => Http::response(
                json_decode(
                    '{
                    "metafields": [
                        {
                            "id": 99999999999999,
                            "namespace": "'.ShopifyMetafieldNamespace::Model_SubscriptionPayments->value.'",
                            "key": "'.ShopifyMetafieldKey::Id->value.'",
                            "value": '.$subscriptionPayment->id.',
                            "description": null,
                            "owner_id": '.$orderId.',
                            "created_at": "2023-11-05T12:13:59-08:00",
                            "updated_at": "2023-11-05T12:13:59-08:00",
                            "owner_resource": "order",
                            "type": "single_line_text_field",
                            "admin_graphql_api_id": "gid://shopify/Metafield/99999999999999"
                        }
                    ]
                }',
                    true
                )
            ),

            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return Str::containsAll(
                    $message,
                    [
                        "AddOrderTags: Adding tags to Shopify Order $orderId: ",
                        ShopifyTagEnum::MembershipRenewal->value
                    ]
                );
            });

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return Str::containsAll(
                    $message,
                    [
                        "AddOrderTags: Removing tags from Shopify Order $orderId: ",
                        ShopifyTagEnum::InitialOrder->value
                    ]
                );
            });

        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the membership renewal tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::containsAll(
                    $request->data()['query'],
                    [
                        'tagsAdd',
                        'tags: '.json_encode([
                            ShopifyTagEnum::MembershipRenewal->value
                        ])
                    ]
                );
        });
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::containsAll(
                    $request->data()['query'],
                    [
                        'tagsRemove',
                        'tags: '.json_encode([
                            ShopifyTagEnum::InitialOrder->value
                        ])
                    ]
                );
        });
    }

    public function test_adds_initial_order_for_subscription_payments_with_linked_order(): void
    {
        // create an order and link the subscription payment via the order's payments
        $product = Product::firstWhere('sku', 'DLM-1-month');
        $order = \App\Modules\Ecommerce\Models\Order::factory()
            ->hasOrderItemForProduct($product)
            ->create();
        $subscriptionPayment = SubscriptionPayment::factory()->create();
        OrderPayment::create([
            'order_id' => $order->id,
            'payment_id' => $subscriptionPayment->payment_id,
            'created_at' => now()
        ]);

        // the order id from the resource file
        $orderId = 5566123016468;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/updated/imported_subscription_payment.json"
        );
        $json = json_decode(file_get_contents($path), true);
        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._imported_subscription_payment')
            ),
            // call to get the order's metafields: return back our fixture
            "$this->baseShopifyUrl/orders/*" => Http::response(
                json_decode(
                    '{
                    "metafields": [
                        {
                            "id": 99999999999999,
                            "namespace": "'.ShopifyMetafieldNamespace::Model_SubscriptionPayments->value.'",
                            "key": "'.ShopifyMetafieldKey::Id->value.'",
                            "value": '.$subscriptionPayment->id.',
                            "description": null,
                            "owner_id": '.$orderId.',
                            "created_at": "2023-11-05T12:13:59-08:00",
                            "updated_at": "2023-11-05T12:13:59-08:00",
                            "owner_resource": "order",
                            "type": "single_line_text_field",
                            "admin_graphql_api_id": "gid://shopify/Metafield/99999999999999"
                        }
                    ]
                }',
                    true
                )
            ),

            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return Str::containsAll(
                    $message,
                    [
                        "AddOrderTags: Adding tags to Shopify Order $orderId: ",
                        ShopifyTagEnum::InitialOrder->value
                    ]
                );
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([
                        ShopifyTagEnum::InitialOrder->value
                    ])
                );
        });
    }

    public function test_handles_order_with_no_customer(): void
    {
        // the order id from the resource file
        $orderId = 5760283541780;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/no_customer.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Adding tags to Shopify Order $orderId: ".ShopifyTagEnum::InitialOrder->value
                ) === 0;
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::InitialOrder->value])
                );
        });
    }

    public function test_handles_recharge_subscription(): void
    {
        // the order id from the resource file
        $orderId = 5710284521748;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/recharge_subscription.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._recharge_subscriptions')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Adding tags to Shopify Order $orderId: ".ShopifyTagEnum::MembershipRenewal->value
                ) === 0;
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the membership renewal tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::MembershipRenewal->value])
                );
        });
    }

    public function test_handles_recharge_subscription_after_delay(): void
    {
        // this test case has the subscription that was renewed 3 weeks late
        // (payments failed and were re-attempted one week later, repeating until successful on the 3rd week)

        // the order id from the resource file
        $orderId = 5824040075540;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/recharge_subscription_delayed.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $orderData = new Order(json_decode(json_encode($json['body']), false));

        // set up the http faking, to emulate the process with Shopify
        Http::fake([
            // call to get the customer's orders: return back our fixture
            "$this->baseShopifyUrl/customers/*" => Http::response(
                $this->fixture('customer.orders._recharge_subscriptions')
            ),
            // catch the graphql call to update the order, and return a valid empty response
            "$this->baseShopifyUrl/graphql.json" => Http::response($this->fixture('empty_graphql')),
        ]);

        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Adding tags to Shopify Order $orderId: ".ShopifyTagEnum::MembershipRenewal->value
                ) === 0;
            });
        Log::shouldReceive("info")
            ->once()
            ->withArgs(function ($message) use ($orderId) {
                return strcmp(
                    $message,
                    "AddOrderTags: Removing tags from Shopify Order $orderId: (none)"
                ) === 0;
            });
        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the membership renewal tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::MembershipRenewal->value])
                );
        });
    }

    protected function setUp(): void
    {
        parent::setUp();
        $shopify = app(Shopify::class);
        $this->baseShopifyUrl = $shopify->getBaseUrl();
        $this->seedDrumeoMemberships();
    }

    /**
     * Create the
     * @throws Exception
     */
    private function seedDrumeoMemberships(): void
    {
        ProductFactory::createProductForSku("drumeo-base-monthly-recurring-7-day-trial-membership");
        ProductFactory::createProductForSku("DLM-Trial-1-month");
        ProductFactory::createProductForSku("DLM-1-month");
    }
}
