<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;

class SubscriptionService
{
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
