<?php

namespace App\Modules\Brand\Services;

use Illuminate\Support\Facades\Log;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;

class PrimaryBrandService
{

    /**
     * @var SubscriptionRepository
     */
    private SubscriptionRepository $subscriptionRepository;

    /**
     * @param SubscriptionRepository $subscriptionRepository
     */
    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @param int $userId
     * @return mixed|null
     */
    public function getInitialBrand(int $userId)
    {
        $brand = $this->subscriptionRepository->getFirstSubscriptionBrand($userId, config('brands'));
        if ($brand) return $brand;
        Log::warning("Unable to determine initial brand for user '$userId'");
        return null;
    }
}
