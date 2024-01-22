<?php

namespace App\Modules\Ecommerce\Jobs;

use App;
use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Services\AppleStoreKitService;

class ProcessAppleExpiredSubscriptionsJob extends BatchQueryJob
{
    private int $skip;
    private int $take;

    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
    }

    function getSkip(): int
    {
        return $this->skip;
    }

    function getTake(): int
    {
        return $this->take;
    }

    function getQuery(): Builder
    {
        return Subscription::query()
            ->where('is_active', '=', 1)
            ->where('type', '=', Subscription::TYPE_APPLE_SUBSCRIPTION)
            ->whereNull('canceled_on')
            ->where('apple_expiration_date', '<=', Carbon::now());
    }

    function handleItem($item): void
    {
        /** @var SubscriptionRepository $subscriptionRepository */
        $subscriptionRepository = App::make(SubscriptionRepository::class);

        /** @var AppleStoreKitService $appleStoreKitService */
        $appleStoreKitService = App::make(AppleStoreKitService::class);

        $subscription = $subscriptionRepository->find($item->id);
        Log::info("Processing subscription $item->id");
        try {
            $appleStoreKitService->processSubscriptionRenewal($subscription);
            usleep(250000); //delay 250 ms to reduce load
        } catch (\Throwable $e) {
            Log::error($e);
        }

    }
}
