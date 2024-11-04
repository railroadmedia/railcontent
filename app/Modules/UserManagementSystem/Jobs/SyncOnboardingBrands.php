<?php

namespace App\Modules\UserManagementSystem\Jobs;

use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncCustomerByEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\UserManagementSystem\Models\OnboardingBrand;
use Modules\UserManagementSystem\Models\User;

class SyncOnboardingBrands implements ShouldQueue
{
    use Dispatchable;

    public function __construct(private readonly int $userId, private readonly string $brand)
    {
    }

    public function handle(): void
    {
        /** @var User $user */
        $user = User::whereId($this->userId)->firstOrFail();
        $brand = $this->brand;

        /** @var OnboardingBrand $userOnboardingBrand */
        $userOnboardingBrand = $user->onboardingBrands()->firstOrCreate();
        $userOnboardingBrand->addBrand($brand);
        $userOnboardingBrand->save();

        $attributes = [
            'onboarding_brand' => $userOnboardingBrand->getAttributes()['brands'],
            'first_onboarding_brand' => $userOnboardingBrand->first_brand,
            'last_onboarding_brand' => $userOnboardingBrand->last_brand,
        ];

        dispatchWithDelay(
            new CustomerIoSyncCustomerByEmail(
                $user->email,
                config('event-data-synchronizer.customer_io_account_to_sync_all_brands'),
                $attributes
            ),
            3
        );
    }
}
