<?php

namespace App\Modules\Brand\Services;

use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use Illuminate\Support\Facades\Log;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Repositories\UserProductRepository;

class PrimaryBrandService
{
    private SubscriptionService $subscriptionService;
    private UserProductService $userProductService;

    public function __construct(
        SubscriptionService $subscriptionService,
        UserProductService $userProductService,
    ) {
        $this->subscriptionService = $subscriptionService;
        $this->userProductService = $userProductService;
    }

    /**
     * @param int $userId
     * @return mixed|null
     */
    public function getInitialBrand(int $userId): string
    {
        $brand = $this->subscriptionService->getFirstSubscriptionBrand($userId, config('brands'));
        if ($brand) {
            return $brand;
        }

        $brand = $this->userProductService->getFirstUserProductBrand($userId, config('brands'));
        if ($brand) {
            return $brand;
        }

        Log::warning("Unable to determine initial brand for user '$userId'");
        return '';
    }
}
