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
            $currentUserId = auth()->user()->id;
            $redis =
                Cache::store('redis')
                    ->connection();
            $brandKeyValues = config('event-data-synchronizer.customer_io_members_area_cached_event_names', []);
            $brandKeyValue = array_key_exists(brand(), $brandKeyValues) ?
                $brandKeyValues[brand()] . $currentUserId : null;

            if (!$redis->exists($brandKeyValue) && $brandKeyValue) {

                // check for existing event keys from brands stored in cache in the last 24 hours for the current user
                $existingBrandsArray[brand()] = Carbon::now()->toDateTimeString();
                foreach ($brandKeyValues as  $brandKey => $existingBrandEventName) {
                    $existingBrandEventName .= $currentUserId;
                    if ($redis->exists($existingBrandEventName)) {
                        $existingBrandsArray[$brandKey] = $redis->get($existingBrandEventName);
                    }
                }
                array_multisort($existingBrandsArray, SORT_DESC);

                //store user event key in Redis, ttl=24 hours
                $redis->set(
                    $brandKeyValue,
                    Carbon::now()
                        ->toDateTimeString(),
                    'EX',
                    60 * 60 * 24
                );

                //customer-io event
                event(
                    new FirstActivityPerDay(
                        $currentUserId,
                        implode(", ", array_keys($existingBrandsArray)),
                        Carbon::now()
                            ->toDateTimeString()
                    )
                );
            }
        }
        return $next($request);
    }

}
