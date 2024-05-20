<?php

namespace Commands;

use App\Modules\Ecommerce\Jobs\Shopify\SyncSubscriptionPaymentsToShopifyOrders;
use App\Modules\Ecommerce\Jobs\Shopify\SyncSubscriptionPaymentsToShopifyOrdersJobManager;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\traits\CreatesReflectionProperty;

class SyncSubscriptionPaymentsToShopifyTest extends TestCase
{
    use CreatesReflectionProperty;

    protected Carbon $launchDate;

    public function test_dispatcher_finds_subscriptions_to_sync()
    {
        // we don't want to run the jobs
        Queue::fake();

        // create some subscription Payments before and after our Shopify launch
        $beforeLaunch = $this->createSubscriptionPayments(5, true);

        $this->launchDate->addHour();
        $this->createSubscriptionPayments(3, false);

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan("shopify:sync-subscription-payments")
            ->assertSuccessful();

        Queue::assertPushedOn('command-two', function (SyncSubscriptionPaymentsToShopifyOrdersJobManager $jobManager) use ($beforeLaunch) {
            return $this->getReflectionProperty($jobManager, 'startAtId') === $beforeLaunch->first()->id &&
                $this->getReflectionProperty($jobManager, 'endAtId') === $beforeLaunch->last()->id;
        });
    }

    private function createSubscriptionPayments(int $count, bool $isBeforeLaunch): Collection
    {
        if ($isBeforeLaunch) {
            $startDate = new Carbon('1970-01-01T00:00:00Z');
            $endDate = $this->launchDate;
        } else {
            $startDate = $this->launchDate;
            $endDate = now();
        }
        return SubscriptionPayment::factory()
            ->count($count)
            ->createdAtInDateRange($startDate, $endDate)
            ->create();
    }

    public function test_dispatcher_uses_the_limit()
    {
        Queue::fake();

        $beforeLaunch = $this->createSubscriptionPayments(20, true);

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan("shopify:sync-subscription-payments --limit=10")
            ->assertSuccessful();

        Queue::assertPushedOn('command-two', function (SyncSubscriptionPaymentsToShopifyOrdersJobManager $jobManager) use ($beforeLaunch) {
            return $this->getReflectionProperty($jobManager, 'startAtId') === $beforeLaunch->first()->id &&
                $this->getReflectionProperty($jobManager, 'endAtId') === $beforeLaunch->take(10)->last()->id;
        });
    }

    public function test_dispatcher_uses_startingId()
    {
        Queue::fake();

        $beforeLaunch = $this->createSubscriptionPayments(20, true);

        $fifthEntry = $beforeLaunch->take(5)->last();

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan("shopify:sync-subscription-payments --startingId={$fifthEntry->id}")
            ->assertSuccessful();

        Queue::assertPushedOn('command-two', function (SyncSubscriptionPaymentsToShopifyOrdersJobManager $jobManager) use (
            $fifthEntry,
            $beforeLaunch
        ) {
            return $this->getReflectionProperty($jobManager, 'startAtId') === $fifthEntry->id &&
                $this->getReflectionProperty($jobManager, 'endAtId') === $beforeLaunch->last()->id;
        });
    }

    public function test_dispatcher_uses_date_ranges()
    {
        Queue::fake();

        $startCreatedAt = new Carbon('2020-01-01T00:00:00Z');
        $endCreatedAt = $this->launchDate->copy()->addMonth();

        // before our wanted period
        SubscriptionPayment::factory()
            ->count(6)
            ->createdAtInDateRange(new Carbon('1970-01-01T00:00:00Z'), $startCreatedAt)
            ->create();

        $beforeLaunch = SubscriptionPayment::factory()
            ->count(5)
            ->createdAtInDateRange($startCreatedAt, $this->launchDate)
            ->create();

        $afterLaunch = SubscriptionPayment::factory()
            ->count(4)
            ->createdAtInDateRange($this->launchDate, $endCreatedAt)
            ->create();

        // after our wanted period
        SubscriptionPayment::factory()
            ->count(3)
            ->createdAtInDateRange($endCreatedAt, now())
            ->create();

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan(
            "shopify:sync-subscription-payments --startCreatedAt='{$startCreatedAt->toDateTimeString()}' --endCreatedAt='{$endCreatedAt->toDateTimeString()}'"
        )
            ->assertSuccessful();

        Queue::assertPushedOn('command-two', function (SyncSubscriptionPaymentsToShopifyOrdersJobManager $jobManager) use (
            $afterLaunch,
            $beforeLaunch
        ) {
            return $this->getReflectionProperty($jobManager, 'startAtId') === $beforeLaunch->first()->id &&
                $this->getReflectionProperty($jobManager, 'endAtId') === $afterLaunch->last()->id;
        });
    }

    public function test_dispatcher_uses_fresh()
    {
        Queue::fake();

        SubscriptionPayment::factory()
            ->count(5)
            ->createdAtInDateRange(new Carbon('1970-01-01T00:00:00Z'), $this->launchDate)
            ->state(new Sequence(
                fn ($sequence) => [ 'shopify_id' => $this->faker->randomNumber(9)]
            ))
            ->create();

        // we won't bother checking the log message, this just helps keep it from outputting in the test run
        Log::shouldReceive("info");

        $this->artisan("shopify:sync-subscription-payments")
            ->assertSuccessful();
        Queue::assertNothingPushed();

        $this->artisan("shopify:sync-subscription-payments --fresh")
            ->assertSuccessful();
        Queue::assertPushedOn('command-two', SyncSubscriptionPaymentsToShopifyOrdersJobManager::class);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->launchDate = new Carbon(config('ecommerce.launch_date_times.shopify'));
    }

    /**
     * @throws \ReflectionException
     */
    public function test_manager_adds_a_job_for_each_batch()
    {
        // batch size is 25, so making 60 should create 3 batches
        $beforeLaunch = $this->createSubscriptionPayments(60, true);
        $chunked = $beforeLaunch->chunk(25)->toArray();
        $batch1 = collect($chunked[0]);
        $batch2 = collect($chunked[1]);
        $batch3 = collect($chunked[2]);

        $startCreatedAt = new Carbon('1970-01-01T00:00:00Z');
        $endCreatedAt = $this->launchDate->copy()->addMonth();

        [$job, $batch] = (new SyncSubscriptionPaymentsToShopifyOrdersJobManager(
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
                        'running batch for %s subscription payments: %s - %s',
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
            $batch->added[0] instanceof SyncSubscriptionPaymentsToShopifyOrders &&
            $this->getReflectionProperty($batch->added[0], 'startAtId') === $batch1->first()['id'] &&
            $this->getReflectionProperty($batch->added[0], 'endAtId') === $batch1->last()['id']
        );
        $this->assertTrue(
            $batch->added[1] instanceof SyncSubscriptionPaymentsToShopifyOrders &&
            $this->getReflectionProperty($batch->added[1], 'startAtId') === $batch2->first()['id'] &&
            $this->getReflectionProperty($batch->added[1], 'endAtId') === $batch2->last()['id']
        );
        $this->assertTrue(
            $batch->added[2] instanceof SyncSubscriptionPaymentsToShopifyOrders &&
            $this->getReflectionProperty($batch->added[2], 'startAtId') === $batch3->first()['id'] &&
            $this->getReflectionProperty($batch->added[2], 'endAtId') === $batch3->last()['id']
        );
    }
}
