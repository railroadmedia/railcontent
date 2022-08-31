<?php

namespace Modules\Mentor\Services;


use Carbon\Carbon;
use Modules\Ecommerce\Services\SubscriptionService;
use Modules\Ecommerce\Services\UserProductService;

class ActiveStudentService
{
    private SubscriptionService $subscriptionService;
    private UserProductService $userProductService;

    public function __construct(
        SubscriptionService $subscriptionService,
        UserProductService $userProductService
    ) {
        $this->subscriptionService = $subscriptionService;
        $this->userProductService = $userProductService;
    }

    public function isActive(int $userId): bool
    {
        $latestSubscriptionTime = $this->subscriptionService->getLatestSubscriptionTime($userId);
        if ($latestSubscriptionTime && $latestSubscriptionTime->addDays(30) >= Carbon::now()) {
            return true;
        }
        $latestExpirationTime = $this->userProductService->getLatestExpirationTime($userId);
        $latestTime = max($latestSubscriptionTime, $latestExpirationTime);

        return $latestTime && $latestTime->addDays(30) >= Carbon::now();
    }
}
