<?php

namespace App\Modules\EventTracking\Jobs;

use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddProfilesWithActivityToSegmentManager implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;

    public function __construct(
        private readonly array $accountConfigData,
        private readonly string $workspaceName,
        private readonly int $segmentId,
        private readonly string $activityType,
        private readonly Carbon $startDate,
        private readonly ?string $nextCursor = null
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    public function handle(CustomerIoApiGateway $customerIoApiGateway): void
    {
        try {
            $response = $customerIoApiGateway->getActivities(
                $this->accountConfigData['app_api_key'],
                $this->activityType,
                null,
                100,
                $this->nextCursor ?? 'start'
            );
            $next = $response->next;

            $ids = collect($response->activities ?? [])
                ->filter(function ($activity) {
                    $timestamp = Carbon::createFromTimestamp($activity->timestamp);
                    return $timestamp->gte($this->startDate);
                })
                ->pluck('customer_identifiers.id')
                ->unique()
                ->toArray();

            if (empty($ids)) {
                Log::info(
                    'No profiles found for activity type ' . $this->activityType . ' and segment ' . $this->segmentId . ' for workspace ' . $this->workspaceName
                );
                return;
            }

            $this->batch()->add(
                new AddProfilesWithActivityToSegment(
                    $this->workspaceName,
                    $this->segmentId,
                    $this->startDate,
                    $this->accountConfigData,
                    $ids
                )
            );

            if ($next) {
                $this->batch()->add(
                    new AddProfilesWithActivityToSegmentManager(
                        $this->accountConfigData,
                        $this->workspaceName,
                        $this->segmentId,
                        $this->activityType,
                        $this->startDate,
                        $next
                    )
                );
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return;
        }
    }
}
