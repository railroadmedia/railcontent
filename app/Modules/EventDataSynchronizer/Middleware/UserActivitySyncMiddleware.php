<?php

namespace App\Modules\EventDataSynchronizer\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;
use App\Modules\EventDataSynchronizer\Events\FirstActivityPerDay;

class UserActivitySyncMiddleware
{
    public static function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $currentUser = auth()->user();
            $redis =
                Cache::store('redis')
                    ->connection();
            $eventName =
                config('event-data-synchronizer.customer_io_brand_activity_event') .
                '_members_area_activity_' .
                $currentuser->id;

            if (!$redis->exists($eventName)) {
                //store user event key in Redis, ttl=24 hours
                $redis->set(
                    $eventName,
                    Carbon::now()
                        ->toDateTimeString(),
                    'EX',
                    60 * 60 * 24
                );

                //customer-io event
                event(
                    new FirstActivityPerDay(
                        $currentuser->id,
                        config('event-data-synchronizer.customer_io_brand_activity_event'),
                        Carbon::now()
                            ->toDateTimeString()
                    )
                );
            }
        }

        return $next($request);
    }
}
