<?php

namespace App\Modules\Brand\Services;

use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use App\Modules\UserManagementSystem\Services\OnboardingService;
use Illuminate\Support\Facades\Log;

class PrimaryBrandService
{
    private OnboardingService $onboardingService;

    public function __construct(
        OnboardingService $onboardingService,
    ) {
        $this->onboardingService = $onboardingService;
    }

    public function getInitialBrand(int $userId): string
    {
        $brand = $this->onboardingService->getBrand($userId);
        if ($brand) {
            return $brand;
        }
        return '';
    }
}
