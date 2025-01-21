<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use ReflectionClass;

/**
 * This job acts as a manager between the dispatching command and the syncing jobs.
 * There are too many orders for the dispatcher to create all the syncing jobs fast enough, so we use this job to
 * take the large chunk of jobs, and further break that down into smaller chunks to pass along to the syncing jobs.
 */
class SyncOrdersToShopifyJobManager implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840; // 14 minutes

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $startAtId,
        protected int $endAtId,
        protected Carbon $startCreatedAt,
        protected Carbon $endCreatedAt,
        protected bool $simulate,
        protected bool $fresh
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     */
    public function handle(): void
    {
        $orders = Order::toSyncWithShopify(
            startingId: $this->startAtId,
            endingId: $this->endAtId,
            fresh: $this->fresh,
            startCreatedAt: $this->startCreatedAt,
            endCreatedAt: $this->endCreatedAt
        )
            ->select("id");

        Log::debug(
            sprintf(
                "%s: running batch for %s orders: %s - %s",
                (new ReflectionClass($this))->getShortName(),
                $orders->count(),
                $this->startAtId,
                $this->endAtId
            )
        );

        $batchSize = 25;
        $jobs = [];
        // step through the chunks of order ids to sync, and add a job to process each chunk
        $orders->chunk($batchSize, function ($orderIds) use (&$jobs) {
            $firstOrderId = $orderIds->first()->id;
            $lastOrderId = $orderIds->last()->id;
            $jobs[] = new SyncOrdersToShopify(
                $firstOrderId,
                $lastOrderId,
                $this->simulate,
                $this->fresh
            );
        });
        $this->batch()->add($jobs);
    }
}
