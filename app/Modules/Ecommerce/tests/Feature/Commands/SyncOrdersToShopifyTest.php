<?php

namespace App\Modules\Ecommerce\tests\Feature\Commands;

use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\Jobs\Shopify\SyncOrdersToShopify;
use App\Modules\Ecommerce\Jobs\Shopify\SyncOrdersToShopifyJobManager;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\traits\CreatesReflectionProperty;

class SyncOrdersToShopifyTest extends TestCase
{
    use CreatesReflectionProperty;

    protected Carbon $launchDate;

    public function test_dispatcher_finds_orders_to_sync(): void
    {
        // we don't want to run the jobs
        Queue::fake();

        // create some orders before and after our Shopify launch
        $beforeLaunch = $this->createOrders(5, true);

        $this->launchDate->addHour();
        $this->createOrders(3, false);

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan("shopify:sync-orders")
            ->assertSuccessful();

        Queue::assertPushedOn('command-two', function (SyncOrdersToShopifyJobManager $jobManager) use ($beforeLaunch) {
            return $this->getReflectionProperty($jobManager, 'startAtId') === $beforeLaunch->first()->id &&
                $this->getReflectionProperty($jobManager, 'endAtId') === $beforeLaunch->last()->id;
        });
    }

    private function getProduct(): Product
    {
        $product = Product::firstWhere('sku', 'DLM-1-month');
        if (is_null($product)) {
            $product = ProductFactory::createProductForSku("DLM-1-month");
        }
        return $product;
    }

    private function createOrders(int $count, bool $isBeforeLaunch): Collection
    {
        $product = $this->getProduct();
        if ($isBeforeLaunch) {
            $startDate = new Carbon('1970-01-01T00:00:00Z');
            $endDate = $this->launchDate;
        } else {
            $startDate = $this->launchDate->copy()->addDay();
            $endDate = now();
        }
        return Order::factory()
            ->count($count)
            ->hasOrderItemForProduct($product)
            ->createdAtInDateRange($startDate, $endDate)
            ->create()
            ->sortBy('id');
    }

    public function test_dispatcher_uses_the_limit(): void
    {
        Queue::fake();

        $beforeLaunch = $this->createOrders(20, true);

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan("shopify:sync-orders --limit=10")
            ->assertSuccessful();

        Queue::assertPushedOn('command-two', function (SyncOrdersToShopifyJobManager $jobManager) use ($beforeLaunch) {
            return $this->getReflectionProperty($jobManager, 'startAtId') === $beforeLaunch->first()->id &&
                $this->getReflectionProperty($jobManager, 'endAtId') === $beforeLaunch->take(10)->last()->id;
        });
    }

    public function test_dispatcher_uses_startingId(): void
    {
        Queue::fake();

        $beforeLaunch = $this->createOrders(20, true);

        $fifthEntry = $beforeLaunch->take(5)->last();

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan("shopify:sync-orders --startingId={$fifthEntry->id}")
            ->assertSuccessful();

        Queue::assertPushedOn('command-two', function (SyncOrdersToShopifyJobManager $jobManager) use (
            $fifthEntry,
            $beforeLaunch
        ) {
            return $this->getReflectionProperty($jobManager, 'startAtId') === $fifthEntry->id &&
                $this->getReflectionProperty($jobManager, 'endAtId') === $beforeLaunch->last()->id;
        });
    }

    public function test_dispatcher_uses_date_ranges(): void
    {
        Queue::fake();

        $product = $this->getProduct();
        $startCreatedAt = new Carbon('2020-01-01T00:00:00Z');
        $endCreatedAt = $this->launchDate->copy()->addMonth();

        // before our wanted period
        Order::factory()
            ->count(6)
            ->hasOrderItemForProduct($product)
            ->createdAtInDateRange(new Carbon('1970-01-01T00:00:00Z'), $startCreatedAt->copy()->subDay())
            ->create();

        // create these in a loop, so we can have an incrementing created_at value
        $beforeLaunch = collect();
        $previousCreatedAt = $startCreatedAt->copy();
        for ($i = 0; $i < 5; $i++) {
            $order = Order::factory()
                ->hasOrderItemForProduct($product)
                ->createdAtInDateRange($previousCreatedAt, $this->launchDate)
                ->create();

            // update the previousCreatedAt to the created_at of the current order, so the next will be after it
            $previousCreatedAt = $order->created_at->copy()->addSecond();
            $beforeLaunch->push($order);
        }

        $afterLaunch = collect();
        $previousCreatedAt = $this->launchDate->copy()->addMinute();
        for ($i = 0; $i < 4; $i++) {
            $order = Order::factory()
                ->hasOrderItemForProduct($product)
                ->createdAtInDateRange($previousCreatedAt, $endCreatedAt->copy()->startOfDay())
                ->create();

            // update the previousCreatedAt to the created_at of the current order, so the next will be after it
            $previousCreatedAt = $order->created_at->copy()->addSecond();
            $afterLaunch->push($order);
        }

        // after our wanted period
        Order::factory()
            ->count(3)
            ->hasOrderItemForProduct($product)
            ->createdAtInDateRange($endCreatedAt->copy()->addDay(), now())
            ->create();

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan(
            "shopify:sync-orders --startCreatedAt='{$startCreatedAt->toDateTimeString()}' --endCreatedAt='{$endCreatedAt->toDateTimeString()}'"
        )
            ->assertSuccessful();

        Queue::assertPushedOn('command-two', function (SyncOrdersToShopifyJobManager $jobManager) use (
            $afterLaunch,
            $beforeLaunch
        ) {
            return $this->getReflectionProperty($jobManager, 'startAtId') === $beforeLaunch->first()->id &&
                $this->getReflectionProperty($jobManager, 'endAtId') === $afterLaunch->last()->id;
        });
    }

    public function test_dispatcher_uses_fresh(): void
    {
        Queue::fake();

        Order::factory()
            ->count(5)
            ->hasOrderItemForProduct($this->getProduct())
            ->createdAtInDateRange(new Carbon('1970-01-01T00:00:00Z'), $this->launchDate)
            ->create([
                'shopify_id' => $this->faker->randomNumber(9)
            ]);

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan("shopify:sync-orders")
            ->assertSuccessful();
        Queue::assertNothingPushed();

        $this->artisan("shopify:sync-orders --fresh")
            ->assertSuccessful();
        Queue::assertPushedOn('command-two', SyncOrdersToShopifyJobManager::class);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->launchDate = new Carbon(config('ecommerce.launch_date_times.shopify'));
    }

    /**
     * @throws \ReflectionException
     */
    public function test_manager_adds_a_job_for_each_batch(): void
    {
        // batch size is 25, so making 60 should create 3 batches
        $beforeLaunch = $this->createOrders(60, true);
        $chunked = $beforeLaunch->chunk(25)->toArray();
        $batch1 = collect($chunked[0]);
        $batch2 = collect($chunked[1]);
        $batch3 = collect($chunked[2]);

        $startCreatedAt = new Carbon('1970-01-01T00:00:00Z');
        $endCreatedAt = $this->launchDate->copy()->addMonth();

        [$job, $batch] = (new SyncOrdersToShopifyJobManager(
            $beforeLaunch->first()->id,
            $beforeLaunch->last()->id,
            $startCreatedAt,
            $endCreatedAt,
            false,
            false
        )
        )->withFakeBatch();

        Log::shouldReceive("debug")
            ->once()
            ->withArgs(function ($message) use ($beforeLaunch) {
                return Str::contains(
                    $message,
                    sprintf(
                        'running batch for %s orders: %s - %s',
                        $beforeLaunch->count(),
                        $beforeLaunch->first()->id,
                        $beforeLaunch->last()->id
                    )
                );
            });

        $job->handle();

        // ensure 3 jobs were added, and each one is for the correct order id ranges
        $this->assertCount(3, $batch->added);
        $this->assertTrue(
            $batch->added[0] instanceof SyncOrdersToShopify &&
            $this->getReflectionProperty($batch->added[0], 'startAtId') === $batch1->first()['id'] &&
            $this->getReflectionProperty($batch->added[0], 'endAtId') === $batch1->last()['id']
        );
        $this->assertTrue(
            $batch->added[1] instanceof SyncOrdersToShopify &&
            $this->getReflectionProperty($batch->added[1], 'startAtId') === $batch2->first()['id'] &&
            $this->getReflectionProperty($batch->added[1], 'endAtId') === $batch2->last()['id']
        );
        $this->assertTrue(
            $batch->added[2] instanceof SyncOrdersToShopify &&
            $this->getReflectionProperty($batch->added[2], 'startAtId') === $batch3->first()['id'] &&
            $this->getReflectionProperty($batch->added[2], 'endAtId') === $batch3->last()['id']
        );
    }
}
