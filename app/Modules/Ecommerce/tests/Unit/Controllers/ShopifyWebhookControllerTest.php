<?php

namespace Controllers;

use App\Modules\Ecommerce\Jobs\ShopifySyncCustomerJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\BaseTestCase;

class ShopifyWebhookControllerTest extends BaseTestCase
{
    protected function setUp(): void
    {
        // DEV NOTE this is a bit of a hack, but the web_or_api_public middleware (from the 'ecommerce.route_middleware_public_groups' config)
        // is causing issues with the test environment, due to calls to Redis and all sorts of stuff;
        // so just disable it for these tests
        putenv("ECOMMERCE_ROUTE_MIDDLEWARE_PUBLIC_GROUPS=false");
        parent::setUp();
    }

    public function test_order_updated_dispatches_shopify_sync_customer_job_for_post_launch()
    {
        $path = Storage::disk("ecommerce_test_resources")->path("Shopify/requests/order/updated/first_physical_only.json");
        $json = json_decode(file_get_contents($path), true);

        // info logs are made (somewhere?)
        Log::shouldReceive('info')->zeroOrMoreTimes();
        // we don't have the endpoint protected
        Log::shouldReceive('warning')
            ->once()
            ->withArgs(function ($message) {
                return str_contains($message, 'SHOPIFY_WEBHOOK_SECRET not set in .env file.  Endpoints not protected');
            });
        // values, according to the resource file
        $customerId = 7794198741286;
        $customerEmail = 'only_physical_order@mail.com';
        Log::shouldReceive('debug')
            ->once()
            ->withArgs(function ($message) use ($customerEmail, $customerId) {
                return str_contains($message, "Shopify order updated webhook received:$customerId $customerEmail");
            });
        // error logs are made (somewhere?)
        Log::shouldReceive('error')->zeroOrMoreTimes();

        // use the fake bus, so we don't trigger the job for real
        Bus::fake();

        $response = $this->postJson(
            route('shopify.webhook.order.update'),
            $json['body'],
            $json['headers']
        );

        Bus::assertDispatched(ShopifySyncCustomerJob::class);
        $response->assertOk();
    }

    public function test_order_updated_does_not_dispatch_shopify_sync_customer_job_for_imported_orders()
    {
        $path = Storage::disk("ecommerce_test_resources")->path("Shopify/requests/order/updated/imported_order.json");
        $json = json_decode(file_get_contents($path), true);

        // info logs are made (somewhere?)
        Log::shouldReceive('info')->zeroOrMoreTimes();
        // we don't have the endpoint protected
        Log::shouldReceive('warning')
            ->once()
            ->withArgs(function ($message) {
                return str_contains($message, 'SHOPIFY_WEBHOOK_SECRET not set in .env file.  Endpoints not protected');
            });
        // values, according to the resource file
        $customerId = 7462119473446;
        $customerEmail = 'imported_memberships@mail.com';
        $processedAt = '2023-10-12T20:03:01-04:00';
        Log::shouldReceive('debug')
            ->once()
            ->withArgs(function ($message) use ($processedAt, $customerEmail, $customerId) {
                return str_contains($message, "Shopify order updated webhook received: $customerId $customerEmail, processed at $processedAt. Ignoring update.");
            });
        // error logs are made (somewhere?)
        Log::shouldReceive('error')->zeroOrMoreTimes();

        // use the fake bus, so we don't trigger the job for real
        Bus::fake();

        $response = $this->postJson(
            route('shopify.webhook.order.update'),
            $json['body'],
            $json['headers']
        );

        Bus::assertNotDispatched(ShopifySyncCustomerJob::class);
        $response->assertOk();
    }
}
