<?php

namespace App\Modules\Brand\Services;

use Illuminate\Support\Facades\Log;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Repositories\UserProductRepository;

class PrimaryBrandService
{

    /**
     * @var SubscriptionRepository
     */
    private SubscriptionRepository $subscriptionRepository;
    private UserProductRepository $userProductRepository;

    /**
     * @param SubscriptionRepository $subscriptionRepository
     */
    public function __construct(
        SubscriptionRepository $subscriptionRepository,
        UserProductRepository $userProductRepository
    ) {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->userProductRepository = $userProductRepository;
    }

    /**
     * @param int $userId
     * @return mixed|null
     */
    public function getInitialBrand(int $userId): string
    {
        $brand = $this->subscriptionRepository->getFirstSubscriptionBrand($userId, config('brands'));
        if ($brand) {
            return $brand;
        }

        $brand = $this->userProductRepository->getFirstUserProductBrand($userId, config('brands'));
        if ($brand) {
            return $brand;
        }

        Log::warning("Unable to determine initial brand for user '$userId'");
        return '';
    }
}
