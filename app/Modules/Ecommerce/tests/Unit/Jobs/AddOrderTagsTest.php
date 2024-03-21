<?php

namespace App\Modules\Ecommerce\tests\Unit\Jobs;

use App\Modules\Ecommerce\Enums\ShopifyTagEnum;
use App\Modules\Ecommerce\Jobs\Shopify\AddOrderTags;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
use App\Modules\Ecommerce\tests\resources\Shopify\fixtures\ReadsFixture;
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

    public function test_adds_initial_order_tag_for_manual_source()
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

    public function test_adds_initial_order_tag_for_revenuecat_initial_purchase()
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

    public function test_does_not_add_initial_order_tag_for_revenuecat_renewal()
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

    public function test_skips_initial_order_tag_if_already_present()
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

        AddOrderTags::dispatchSync($orderData);

        // make sure the job does not send out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertNotSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains($request->data()['query'], 'tags: ["'.ShopifyTagEnum::InitialOrder->value.'"]');
        });
    }

    public function test_does_not_add_initial_order_tag_for_subscription_contract()
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

        AddOrderTags::dispatchSync($orderData);

        // make sure the job does not send out the HTTP request to the graphql endpoint with the initial order tag
        Http::assertNotSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains($request->data()['query'], 'tags: ["'.ShopifyTagEnum::InitialOrder->value.'"]');
        });
    }

    public function test_adds_trial_start_order_tag()
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

    public function test_adds_trial_start_when_discount_is_on_discount_allocations()
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

    public function test_adds_trial_conversion_order_tag()
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
                        ShopifyTagEnum::InitialOrder->value,
                        ShopifyTagEnum::TrialConversion->value
                    ]
                );
            });

        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the trial conversion tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([ShopifyTagEnum::TrialConversion->value, ShopifyTagEnum::InitialOrder->value])
                );
        });
    }

    public function test_adds_membership_renewal_order_tag()
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
                        ShopifyTagEnum::InitialOrder->value,
                        ShopifyTagEnum::MembershipRenewal->value
                    ]
                );
            });

        AddOrderTags::dispatchSync($orderData);

        // make sure the job sends out the HTTP request to the graphql endpoint with the membership renewal tag
        Http::assertSent(function (Request $request) {
            return $request->url() == "$this->baseShopifyUrl/graphql.json"
                && Str::contains(
                    $request->data()['query'],
                    'tags: '.json_encode([
                        ShopifyTagEnum::MembershipRenewal->value,
                        ShopifyTagEnum::InitialOrder->value
                    ])
                );
        });
    }

    public function test_handles_order_with_no_customer()
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


    protected function setUp(): void
    {
        parent::setUp();
        $shopify = app(Shopify::class);
        $this->baseShopifyUrl = $shopify->getBaseUrl();
        $this->seedDrumeoMemberships();
    }

    /**
     * Create the
     * @return void
     */
    private function seedDrumeoMemberships(): void
    {
        Product::create([
            'brand' => "drumeo",
            'name' => "Drumeo Monthly Membership | With 7-Day Trial",
            'sku' => "drumeo-base-monthly-recurring-7-day-trial-membership",
            'inventory_control_sku' => "17001",
            'fulfillment_sku' => "membership",
            'price' => "25.00",
            'type' => "digital subscription",
            'active' => 1,
            'category' => "NULL",
            'description' => "7 days free, then $25 / month. Easy to cancel anytime. Includes access to Drumeo’s step-by-step method, lessons from legendary artists, and unlimited personal support.",
            'thumbnail_url' => "'https' =>//d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
            'sales_page_url' => null,
            'is_physical' => 0,
            'weight' => "0.00",
            'subscription_interval_type' => "month",
            'subscription_interval_count' => 1,
            'stock' => 999952,
            'min_stock_level' => 0,
            'public_stock_count' => 0,
            'auto_decrement_stock' => 0,
            'digital_access_permission_names' => "[\"Musora Basic Membership\"]",
            'digital_access_type' => "basic content access",
            'digital_access_time_interval_type' => "day",
            'digital_access_time_type' => "recurring",
            'digital_access_time_interval_length' => 7,
            'digital_membership_access_expiration_date' => null,
            'shopify_id' => 47070845370644,
            'note' => null,
        ]);

        Product::create([
            'brand' => "drumeo",
            'name' => "Drumeo+ Monthly Membership: Includes Songs | With 7-Day Trial",
            'sku' => "DLM-Trial-1-month",
            'inventory_control_sku' => "17001",
            'fulfillment_sku' => "membership",
            'price' => "30.00",
            'type' => "digital subscription",
            'active' => 1,
            'category' => "NULL",
            'description' => "7 days free, then $30 / month. Easy to cancel anytime. Includes access to Drumeo’s step-by-step method, lessons from legendary artists, and unlimited personal support. As a “+” member, you’ll also get access to 5000+ professionally transcribed songs.",
            'thumbnail_url' => "'https' =>//d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
            'sales_page_url' => null,
            'is_physical' => 0,
            'weight' => "0.00",
            'subscription_interval_type' => "month",
            'subscription_interval_count' => 1,
            'stock' => 999999,
            'min_stock_level' => 0,
            'public_stock_count' => 0,
            'auto_decrement_stock' => 0,
            'digital_access_permission_names' => "[\"Musora Basic Membership\"]",
            'digital_access_type' => "basic content access",
            'digital_access_time_interval_type' => "day",
            'digital_access_time_type' => "recurring",
            'digital_access_time_interval_length' => 7,
            'digital_membership_access_expiration_date' => null,
            'shopify_id' => 47070758797588,
            'note' => null,
        ]);
    }
}
