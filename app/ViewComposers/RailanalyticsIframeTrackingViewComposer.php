<?php

namespace App\ViewComposers;

use App\Analytics\Tracker;
use Illuminate\Support\Facades\Cache;
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
        $drumeoCacheKey = null;
        $pianoteCacheKey = null;
        $guitareoCacheKey = null;
        $singeoCacheKey = null;

        if (current_user_has_recent_order()) {
            $currentUserHasRecentOrder = true;

            $drumeoQueueData = Tracker::getQueueForBrand('drumeo');
            $drumeoCacheKey = auth()->id() . '_recent_order_analytics_data_drumeo';
            Cache::store('redis')->put($drumeoCacheKey, $drumeoQueueData, 60);

            $pianoteQueueData = Tracker::getQueueForBrand('pianote');
            $pianoteCacheKey = auth()->id() . '_recent_order_analytics_data_pianote';
            Cache::store('redis')->put($pianoteCacheKey, $pianoteQueueData, 60);

            $guitareoQueueData = Tracker::getQueueForBrand('guitareo');
            $guitareoCacheKey = auth()->id() . '_recent_order_analytics_data_guitareo';
            Cache::store('redis')->put($guitareoCacheKey, $guitareoQueueData, 60);

            $singeoQueueData = Tracker::getQueueForBrand('singeo');
            $singeoCacheKey = auth()->id() . '_recent_order_analytics_data_singeo';
            Cache::store('redis')->put($singeoCacheKey, $singeoQueueData, 60);
        }


        $view->with([
            'currentUserHasRecentOrder' => $currentUserHasRecentOrder,
            'drumeoCacheKey' => $drumeoCacheKey,
            'pianoteCacheKey' => $pianoteCacheKey,
            'guitareoCacheKey' => $guitareoCacheKey,
            'singeoCacheKey' => $singeoCacheKey,
        ]);
    }
}
