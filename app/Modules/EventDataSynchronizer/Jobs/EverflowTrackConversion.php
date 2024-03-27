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

        if (!str_contains(strtolower($order->tags), strtolower(ShopifyTagEnum::TrialConversion->value))) {
            return;
        }
        $email = $order->email;

        try {
            Tracker::queue(
                $this->brand,
                function () use ($time, $email, $id) {
                    Tracker::trackEverFlowConversionAPI($id, $email, $time);
                }
            );
        } catch (Throwable $exception) {
            error_log("Error in EverflowTrackConversion with order:");
            error_log($exception);
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Throwable  $exception
     */
    public function failed(Throwable $exception)
    {
        error_log($exception);
    }

}
