<?php

namespace Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;

class SubscriptionService
{

    public function getLatestSubscriptionTime(int $userId): ?Carbon
    {
        $max = Subscription::query()->fromUser($userId)->max('paid_until');
        return $max != null ? Carbon::parse($max) : null;
    }


}
