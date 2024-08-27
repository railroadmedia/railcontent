<?php


use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Models\Order as EcommerceOrder;
use App\Modules\Ecommerce\Models\OrderPayment;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\tests\resources\Shopify\fixtures\ReadsFixture;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Signifly\Shopify\Shopify;
use Tests\TestCase;

class RestOrderModelTest extends TestCase
{
    use ReadsFixture;

    protected string $baseShopifyUrl;

    public function test_retrieves_linked_order_by_metafield(): void
    {
        // create a few extra orders first
        EcommerceOrder::factory()->count(4)->create();
        // the order id from the resource file
        $orderId = 5670966231334;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $product = ProductFactory::createProductForSku("DLM-1-month");
        $order = EcommerceOrder::factory()
            ->hasOrderItemForProduct($product)
            ->create();

        $orderData = new Order(json_decode(json_encode($json['body']), false));
        Http::fake([
            // call to get the order's metafields: return back our fixture
            "$this->baseShopifyUrl/orders/*" => Http::response(
                json_decode(
                    '{
                    "metafields": [
                        {
                            "id": 99999999999999,
                            "namespace": "'.ShopifyMetafieldNamespace::Model_Orders->value.'",
                            "key": "'.ShopifyMetafieldKey::Id->value.'",
                            "value": '.$order->id.',
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
        ]);

        $this->assertEquals($order->id, $orderData->getEcommerceModel()->id);
    }

    public function test_retrieves_linked_order_by_shopify_id(): void
    {
        // create a few extra orders first
        EcommerceOrder::factory()->count(4)->create();
        // the order id from the resource file
        $orderId = 5670966231334;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $product = ProductFactory::createProductForSku("DLM-1-month");
        $order = EcommerceOrder::factory()
            ->hasOrderItemForProduct($product)
            ->create(['shopify_id' => $orderId]);

        $orderData = new Order(json_decode(json_encode($json['body']), false));
        Http::fake([
            // call to get the order's metafields: return empty
            "$this->baseShopifyUrl/orders/*" => Http::response(
                json_decode(
                    '{
                    "metafields": []
                }',
                    true
                )
            ),
        ]);

        $this->assertEquals($order->id, $orderData->getEcommerceModel()->id);
    }

    public function test_throws_exception_for_invalid_order_id_metafield(): void
    {
        // the order id from the resource file
        $orderId = 5670966231334;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $product = ProductFactory::createProductForSku("DLM-1-month");
        EcommerceOrder::factory()
            ->hasOrderItemForProduct($product)
            ->create();

        $orderData = new Order(json_decode(json_encode($json['body']), false));
        Http::fake([
            // call to get the order's metafields: return back our fixture
            "$this->baseShopifyUrl/orders/*" => Http::response(
                json_decode(
                    '{
                    "metafields": [
                        {
                            "id": 99999999999999,
                            "namespace": "'.ShopifyMetafieldNamespace::Model_Orders->value.'",
                            "key": "'.ShopifyMetafieldKey::Id->value.'",
                            "value": 89789798487987,
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
        ]);

        $this->expectException(ModelNotFoundException::class);
        $orderData->getEcommerceModel();
    }

    public function test_retrieves_linked_subscription_payment_by_metafield(): void
    {
        // create a few extra subscription payments first
        SubscriptionPayment::factory()->count(5)->create();
        // the order id from the resource file
        $orderId = 5670966231334;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $product = ProductFactory::createProductForSku("DLM-1-month");
        $order = EcommerceOrder::factory()
            ->hasOrderItemForProduct($product)
            ->create();
        $subscriptionPayment = SubscriptionPayment::factory()->create();
        OrderPayment::create([
            'order_id' => $order->id,
            'payment_id' => $subscriptionPayment->payment_id,
            'created_at' => now()
        ]);

        $orderData = new Order(json_decode(json_encode($json['body']), false));
        Http::fake([
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
        ]);

        $this->assertEquals($subscriptionPayment->id, $orderData->getEcommerceModel()->id);
    }

    public function test_retrieves_linked_subscription_payment_by_shopify_id(): void
    {
        // create a few extra subscription payments first
        SubscriptionPayment::factory()->count(5)->create();
        // the order id from the resource file
        $orderId = 5670966231334;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $product = ProductFactory::createProductForSku("DLM-1-month");
        $order = EcommerceOrder::factory()
            ->hasOrderItemForProduct($product)
            ->create();
        $subscriptionPayment = SubscriptionPayment::factory()->create(['shopify_id' => $orderId]);
        OrderPayment::create([
            'order_id' => $order->id,
            'payment_id' => $subscriptionPayment->payment_id,
            'created_at' => now()
        ]);

        $orderData = new Order(json_decode(json_encode($json['body']), false));
        Http::fake([
            // call to get the order's metafields: return empty
            "$this->baseShopifyUrl/orders/*" => Http::response(
                json_decode(
                    '{
                    "metafields": []
                }',
                    true
                )
            ),
        ]);

        $this->assertEquals($subscriptionPayment->id, $orderData->getEcommerceModel()->id);
    }

    public function test_throws_exception_for_invalid_subscription_payment_id_metafield(): void
    {
        // the order id from the resource file
        $orderId = 5670966231334;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $product = ProductFactory::createProductForSku("DLM-1-month");
        $order = EcommerceOrder::factory()
            ->hasOrderItemForProduct($product)
            ->create();
        $subscriptionPayment = SubscriptionPayment::factory()->create(['shopify_id' => $orderId]);
        OrderPayment::create([
            'order_id' => $order->id,
            'payment_id' => $subscriptionPayment->payment_id,
            'created_at' => now()
        ]);

        $orderData = new Order(json_decode(json_encode($json['body']), false));
        Http::fake([
            // call to get the order's metafields: return back our fixture
            "$this->baseShopifyUrl/orders/*" => Http::response(
                json_decode(
                    '{
                    "metafields": [
                        {
                            "id": 99999999999999,
                            "namespace": "'.ShopifyMetafieldNamespace::Model_SubscriptionPayments->value.'",
                            "key": "'.ShopifyMetafieldKey::Id->value.'",
                            "value": 89789798487987,
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
        ]);

        $this->expectException(ModelNotFoundException::class);
        $orderData->getEcommerceModel();
    }


    public function test_throws_exception_when_no_metafield_or_shopify_id(): void
    {
        // the order id from the resource file
        $orderId = 5670966231334;
        $path = Storage::disk("ecommerce_test_resources")->path(
            "Shopify/requests/order/created/drumeo_membership.json"
        );
        $json = json_decode(file_get_contents($path), true);

        $product = ProductFactory::createProductForSku("DLM-1-month");
        $order = EcommerceOrder::factory()
            ->hasOrderItemForProduct($product)
            ->create();
        $subscriptionPayment = SubscriptionPayment::factory()->create();
        OrderPayment::create([
            'order_id' => $order->id,
            'payment_id' => $subscriptionPayment->payment_id,
            'created_at' => now()
        ]);

        $orderData = new Order(json_decode(json_encode($json['body']), false));
        Http::fake([
            // call to get the order's metafields: return empty
            "$this->baseShopifyUrl/orders/*" => Http::response(
                json_decode(
                    '{
                    "metafields": []
                }',
                    true
                )
            ),
        ]);

        $this->expectException(ModelNotFoundException::class);
        $orderData->getEcommerceModel();
    }

    protected function setUp(): void
    {
        parent::setUp();
        $shopify = app(Shopify::class);
        $this->baseShopifyUrl = $shopify->getBaseUrl();
    }
}
