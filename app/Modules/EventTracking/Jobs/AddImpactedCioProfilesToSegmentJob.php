<?php

namespace App\Modules\EventTracking\Jobs;

use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddImpactedCioProfilesToSegmentJob implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        private readonly string $workspaceName,
        private readonly int $segmentId,
        private readonly Carbon $startDate,
        private readonly array $accountConfig,
        private readonly array $customerIds
    ) {
    }

    public function handle(CustomerIoApiGateway $customerIoApiGateway): void
    {
        Log::info(
            'Adding ' . count(
                $this->customerIds
            ) . ' profiles to segment ' . $this->segmentId . ' for workspace ' . $this->workspaceName
        );

        try {
            $customerIoApiGateway->addProfilesToSegment(
                $this->accountConfig['site_id'],
                $this->accountConfig['track_api_key'],
                $this->segmentId,
                $this->customerIds,
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return;
        }

        Log::info('Profiles added to segment');
    }
}
