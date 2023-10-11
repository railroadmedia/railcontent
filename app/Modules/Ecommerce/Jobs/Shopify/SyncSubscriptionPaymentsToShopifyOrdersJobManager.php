<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;

/**
 * This job acts as a manager between the dispatching command the syncing jobs.
 * There are too many subscription payments for the dispatcher to create all the syncing jobs fast enough, so we use
 * this job to take the large chunk of jobs, and further break that down into smaller chunks to pass along to the
 * syncing jobs.
 */
class SyncSubscriptionPaymentsToShopifyOrdersJobManager implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use LogsShopify;
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
        protected Carbon $lastSyncAt,
        protected bool $simulate,
        protected bool $fresh
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled];
    }

    /**
     * Execute the job
     *
     * @return void
     */
    public function handle(): void
    {
        $subscriptionPayments = SubscriptionPayment::query()
            ->whereBetween("id", [$this->startAtId, $this->endAtId])
            ->where(function (Builder $q) {
                $q->when(!$this->fresh, function (Builder $q) {
                    return $q->whereNull("shopify_id")
                        ->orWhereDate("updated_at", ">", $this->lastSyncAt);
                });
            })
            ->whereIn("payment_id", function($query) {
                $query->select("id")
                    ->from("ecommerce_payments")
                    ->where("status", Payment::STATUS_PAID)
                    ->whereNot("type", Payment::TYPE_INITIAL_ORDER);
            })
            ->select("id");

        $this->logDebug(
            sprintf(
                "%s: running batch for %s subscription payments: %s - %s (non-contiguously)",
                $this->getClassName(),
                $subscriptionPayments->count(),
                $this->startAtId,
                $this->endAtId
            )
        );

        $batchSize = 25;
        $jobs = [];
        // step through the chunks of subscription payment ids to sync, and add a job to process each chunk
        $subscriptionPayments->chunk($batchSize, function ($subscriptionPaymentIds) use (&$jobs) {
            $firstSubscriptionPaymentId = $subscriptionPaymentIds->first()->id;
            $lastSubscriptionPaymentId = $subscriptionPaymentIds->last()->id;
            $jobs[] = new SyncSubscriptionPaymentsToShopifyOrders(
                $firstSubscriptionPaymentId,
                $lastSubscriptionPaymentId,
                $this->lastSyncAt,
                $this->simulate,
                $this->fresh
            );
        });
        $this->batch()->add($jobs);
    }


    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncSubscriptionPaymentsToShopifyOrdersJobManager";
    }
}
