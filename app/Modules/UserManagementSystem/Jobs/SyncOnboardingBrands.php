<?php

namespace App\Modules\UserManagementSystem\Jobs;

use App\Modules\Brand\Enums\Brand;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncCustomerByEmail;
use Exception;
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

    public function handle(CustomerIoService $customerIoService): void
    {
        /** @var User $user */
        $user = User::whereId($this->userId)->firstOrFail();
        $brand = $this->brand;

        /** @var OnboardingBrand $userOnboardingBrand */
        $userOnboardingBrand = $user->onboardingBrands()->firstOrCreate();
        $userOnboardingBrand->addBrand($brand);
        $userOnboardingBrand->save();

        // update subscription topics settings
        $subscriptionTopics = config('customer-io.subscription_topics');
        $topics = array_fill_keys(array_values($subscriptionTopics), false);

        try {
            $profile = $customerIoService->getCustomerByEmail('musora', $user->email);

            if ($profile && array_key_exists('cio_subscription_preferences', $profile->getExternalAttributes())) {
                $topics = json_decode($profile->getExternalAttributes()['cio_subscription_preferences'], true)['topics'] ?? $topics;
            }
        } catch (Exception $_) {
            // do nothing as the profile will get created
        }

        if ($brand != Brand::Musora->value && Brand::tryFrom($brand)) {
            $topics[$subscriptionTopics[strtolower($brand) . '_membership_perks']] = true;
            $topics[$subscriptionTopics[strtolower($brand) . '_lesson_events']] = true;
        }

        $attributes = [
            'onboarding_brand' => $userOnboardingBrand->getAttributes()['brands'],
            'first_onboarding_brand' => $userOnboardingBrand->first_brand,
            'last_onboarding_brand' => $userOnboardingBrand->last_brand,
            'cio_subscription_preferences' => [
                'topics' => $topics,
            ],
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
