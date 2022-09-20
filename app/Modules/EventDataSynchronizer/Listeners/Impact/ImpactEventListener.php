<?php

namespace App\Modules\EventDataSynchronizer\Listeners\Impact;

use Carbon\Carbon;
use Railroad\Ecommerce\Events\OrderEvent;
use App\Modules\EventDataSynchronizer\Jobs\ImpactTrackConversion;

class ImpactEventListener
{
    public function __construct()
    {

    }

    /**
     * @param OrderEvent $orderEvent
     */
    public function handleSubscriptionRenewed(OrderEvent $orderEvent)
    {

        $order = $orderEvent->getOrder();

        dispatch(
            (new ImpactTrackConversion($order))
                ->delay(Carbon::now()->addSeconds(3))
        );
    }

}
