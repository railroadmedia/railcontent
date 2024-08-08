<?php

namespace App\Modules\Ecommerce\Jobs;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Services\EventTrackingService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use Illuminate\Support\Facades\Log;

class AssignPrimaryBrandJob extends WebhookChildJob
{
    public function __construct(private array $contents)
    {
    }

    public function handle(ShopifySyncService $shopifySyncService, EventTrackingService $eventTrackingService): void
    {
        $user = $shopifySyncService->getOrCreateUser($this->contents['customer']['id'], $this->contents['customer']['email']);
        $brand = $eventTrackingService->getBrandFromOrder($this->contents);

        if ($brand !== 'musora') {
            $user->primary_brand = $brand;
            $user->save();

            dispatchWithDelay(new CustomerIoSyncUserByUserId($user, ['primary_brand' => $brand]), 3);
            Log::info("User {$user->id} assigned primary brand $brand");
        }
    }
}
