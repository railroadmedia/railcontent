<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\Ecommerce\Services\ShopifySyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Railroad\Railanalytics\Tracker;
use Throwable;
use App\Modules\Ecommerce\Enums\ShopifyTagEnum;

class EverflowTrackConversion implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        private $brand,
        private $orderID
    ) {
    }



    public function handle(ShopifySyncService $shopifySyncService)
    {
        $id = $this->orderID;
        $order = $shopifySyncService->getOrder($id);
        $time = Carbon::parse($order->created_at)->timestamp;
        $isTrialConversion = str_contains(strtolower($order->tags), strtolower(ShopifyTagEnum::TrialConversion->value));
        $email = $order->email;
        $currency = $order->currency ?? 'USD';
        $amount = $order->current_total_price ?? '0.00';

        try {
            Tracker::queue(
                $this->brand,
                function () use ($time, $email, $id, $isTrialConversion, $currency, $amount) {
                    Tracker::trackEverFlowConversionAPI($id, $email, $time, $amount, $currency, $isTrialConversion);
                }
            );
        } catch (Throwable $exception) {
            error_log("Error in EverflowTrackConversion with order:");
            error_log($exception);
        }
    }

    /**
     * The job failed to process.
     */
    public function failed(Throwable $exception)
    {
        error_log($exception);
    }

}
