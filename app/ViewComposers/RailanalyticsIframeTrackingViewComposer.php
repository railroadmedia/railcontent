<?php

namespace App\ViewComposers;

use Illuminate\Support\Facades\Cache;
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
        function getProtectedValue($obj, $name) {
            $array = (array)$obj;
            $prefix = chr(0).'*'.chr(0);
            return $array[$prefix.$name];
        }

        $currentUserHasRecentOrder = false;
        $cacheKey = null;
        $brand = 'drumeo'; // todo

        if (current_user_has_recent_order()) {
            $currentUserHasRecentOrder = true;

            // todo: add other brands

            $queueData = \App\Analytics\Tracker::getQueueForBrand('drumeo');
            $cacheKey = auth()->id() . '_recent_order_analytics_data_drumeo';

            Log::info('RailanalyticsIframeTrackingViewComposer cacheKey: ' . $cacheKey);

            Log::info('RailanalyticsIframeTrackingViewComposer prefix: ' . getProtectedValue(getProtectedValue(Cache::store('redis'), 'store'), 'prefix'));

            cache()->store('redis')->put($cacheKey, $queueData, 6000);
            cache()->store('redis')->set($cacheKey . '1', $queueData, 6000);
            Cache::store('redis')->put($cacheKey . '3', $queueData, 6000);
            Cache::store('redis')->set($cacheKey . '4', $queueData, 6000);
        }


        $view->with([
            'currentUserHasRecentOrder' => $currentUserHasRecentOrder,
            'cacheKey' => $cacheKey,
            'brand' => $brand,
        ]);
    }
}
