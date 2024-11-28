<?php

namespace App\Modules\UserManagementSystem\Jobs;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncCustomerByEmail;
use App\Modules\UserManagementSystem\Services\OnboardingService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\OnboardingBrand;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

class ResyncOnboardingBrandsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;
    use HandlesShopifyRateLimit;

    private OnboardingService $onboardingService;
    protected Shopify $shopify;

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    public function __construct(private readonly int $firstId, private readonly int $lastId)
    {
    }

    public function handle(Shopify $shopify): void
    {
        $this->onboardingService = app(OnboardingService::class);
        $this->shopify = $shopify;

        $users = User::query()
            ->withoutDeleted()
            ->whereNotNull('membership_expiration_date')
            ->has('onboardingBrands')
            ->whereBetween('id', [$this->firstId, $this->lastId])
            ->get();

        /** @var User $user */
        foreach ($users as $user) {
            $attributes = [];

            /** @var OnboardingBrand $userOnboardingBrand */
            $userOnboardingBrand = $user->onboardingBrands()->firstOrFail();

            $subscriptionTopics = config('customer-io.subscription_topics');

            $topics = array_fill_keys(array_values($subscriptionTopics), false);

            foreach ($userOnboardingBrand->brands as $brand) {
                if ($brand === Brand::Drumeo->value) {
                    $topics[$subscriptionTopics['drumeo_membership_perks']] = true;
                    $topics[$subscriptionTopics['drumeo_lesson_events']] = true;
                }
                if ($brand === Brand::Pianote->value) {
                    $topics[$subscriptionTopics['pianote_membership_perks']] = true;
                    $topics[$subscriptionTopics['pianote_lesson_events']] = true;
                }
                if ($brand === Brand::Guitareo->value) {
                    $topics[$subscriptionTopics['guitareo_membership_perks']] = true;
                    $topics[$subscriptionTopics['guitareo_lesson_events']] = true;
                }
                if ($brand === Brand::Singeo->value) {
                    $topics[$subscriptionTopics['singeo_membership_perks']] = true;
                    $topics[$subscriptionTopics['singeo_lesson_events']] = true;
                }

                $attributes = [
                    'onboarding_brand' => $userOnboardingBrand->getAttributes()['brands'],
                    'first_onboarding_brand' => $userOnboardingBrand->first_brand,
                    'last_onboarding_brand' => $userOnboardingBrand->last_brand,
                    'cio_subscription_preferences' => [
                        'topics' => $topics,
                    ],
                ];
            }

            if (!$attributes) {
                Log::warning(sprintf("%s: No attributes found for user %s. Unable to sync to customer.io", $this->getClassName(), $user->email));
                continue;
            }

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

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return 'BackfillOnboardingBrands';
    }
}
