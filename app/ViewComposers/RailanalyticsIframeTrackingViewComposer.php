<?php

namespace App\ViewComposers;

use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class RailanalyticsIframeTrackingViewComposer
{
    /**
     * Check the users permission levels and render a different nav for different levels
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $currentUserHasRecentOrder = false;
        $cacheKey = null;
        $brand = 'drumeo'; // todo

        if (current_user_has_recent_order()) {
            $currentUserHasRecentOrder = true;

            // todo: add other brands

            $queueData = \App\Analytics\Tracker::getQueueForBrand('drumeo');
            $cacheKey = auth()->id() . '_recent_order_analytics_data_drumeo';

            Log::info('RailanalyticsIframeTrackingViewComposer cacheKey: ' . $cacheKey);

            cache()->store('redis')->put($cacheKey, $queueData, 6000);
        }


        $view->with([
            'currentUserHasRecentOrder' => $currentUserHasRecentOrder,
            'cacheKey' => $cacheKey,
            'brand' => $brand,
        ]);
    }
}
