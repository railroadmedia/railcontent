<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Modules\UserManagementSystem\Models\User;

/**
 * This job acts as a manager between the dispatching command and the syncing jobs.
 * There could be too many users for the dispatcher to create all the syncing jobs fast enough, so we use this job to
 * take the large chunk of jobs, and further break that down into smaller chunks to pass along to the syncing jobs.
 */
class SyncUsersToShopifyJobManager implements ShouldQueue
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
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     *
     * @return void
     */
    public function handle(): void
    {
        $users = User::query()
            ->whereBetween("id", [$this->startAtId, $this->endAtId])
            ->where(function (Builder $q) {
                $q->when(!$this->fresh, function (Builder $q) {
                    return $q->whereNull("shopify_id")
                        ->orWhereDate("updated_at", ">", $this->lastSyncAt);
                });
            })
            ->select("id");

        $this->logDebug(
            sprintf(
                "%s: running batch for %s users: %s - %s",
                $this->getClassName(),
                $users->count(),
                $this->startAtId,
                $this->endAtId
            )
        );

        $batchSize = 25;
        $jobs = [];
        // step through the chunks of user ids to sync, and add a job to process each chunk
        $users->chunk($batchSize, function ($userIds) use (&$jobs) {
            $firstUserId = $userIds->first()->id;
            $lastUserId = $userIds->last()->id;
            $jobs[] = new SyncUsersToShopify(
                $firstUserId,
                $lastUserId,
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
        return "SyncUsersToShopifyJobManager";
    }
}
