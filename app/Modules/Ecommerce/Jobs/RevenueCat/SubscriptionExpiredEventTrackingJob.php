<?php

namespace App\Modules\Ecommerce\Jobs\RevenueCat;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Services\EventTrackingService;
use App\Modules\Ecommerce\Services\RevenueCatService;
use Exception;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SubscriptionExpiredEventTrackingJob extends WebhookChildJob
{
    use Dispatchable;

    public function __construct(private array $contents)
    {
    }

    public function handle(
        RevenueCatService $revenueCatService,
        EventTrackingService $eventTrackingService
    ): void {
        $user = $revenueCatService->tryGetUserFromNotificationData($this->contents, false);
        if (!$user) {
            throw new Exception('User not found');
        }
        $type = (strtolower($this->contents['event']['store']) == 'app_store') ? 'apple' : 'google';
        $revenueCatService->unsetUserSubscription($user, $type);
        $productId = $revenueCatService->getProductId($this->contents['event']['product_id']);

        //get Musora product
        $musoraProducts = $revenueCatService->getMusoraProducts($type, $this->contents['event'], $productId);
        if ($musoraProducts->isEmpty()) {
            Log::error(
                "SubscriptionExpiredEventTrackingJob - musora product not found: $productId"
            );
            throw new Exception('Musora product not found');
        }

        $musoraProduct = $musoraProducts->first();

        $eventTrackingService->handleSubscriptionExpired($user, $musoraProduct->brand);
    }
}
