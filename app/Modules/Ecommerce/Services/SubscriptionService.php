<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;

class SubscriptionService
{

    public function getLatestSubscriptionTime(int $userId): ?Carbon
    {
        $max = Subscription::query()->fromUser($userId)->max('paid_until');
        return $max != null ? Carbon::parse($max) : null;
    }

    public function getFirstSubscriptionBrand(int $userId, array $brands): string
    {
        $result = Subscription::query()
            ->whereIn('brand', $brands)
            ->fromUser($userId)
            ->orderBy('created_at')
            ->first('brand');
        return $result['brand'] ?? '';
    }
}
