<?php

namespace App\Modules\UserManagementSystem\Jobs;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncCustomerByEmail;
use App\Modules\UserManagementSystem\Services\OnboardingService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Modules\UserManagementSystem\Models\OnboardingAnswerHistory;
use Modules\UserManagementSystem\Models\User;

class BackfillOnboardingBrandsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

    private OnboardingService $onboardingService;

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    public function __construct(private readonly int $firstId, private readonly int $lastId)
    {
    }

    public function handle(): void
    {
        $this->onboardingService = app(OnboardingService::class);

        $users = User::query()
            ->where('membership_expiration_date', '>', now())
            ->whereBetween('id', [$this->firstId, $this->lastId])
            ->get();

        foreach ($users as $user) {
            // check membership brand
            $brands = [];
            $productIds = $user->userAccessPermissions()
                           ->orderBy('created_at', 'asc')
                           ->get()
                           ->toArray();

            foreach ($productIds as $key => $productId) {
                /** @var Product $product */
                $product = Product::whereId($productId)->first();
                if ($product && $product->brand !== 'musora') {
                    array_push($brands, $product->brand);
                }
            }

            // check onboarding instrument answers
            $brandAnswers = $user->onboardingAnswerHistory()
                     ->where('onboarding_question', 'instrument')
                     ->get()
                     ->map(function (OnboardingAnswerHistory $oah) {
                         return $this->onboardingService->getBrandFromInstrument($oah->onboarding_answer);
                     })->toArray();

            array_push($brands, ...$brandAnswers);

            // if nothing above, check primary brand
            if ($user->primary_brand) {
                array_push($brands, $user->primary_brand);
            }

            // clean up duplicates
            $brands = array_unique($brands);

            // push to customer.io
            $attributes = [];

            if (empty($brands)) {
                continue;
            }

            $userOnboardingBrand = $user->onboardingBrands()->firstOrCreate();

            $subscriptionTopics = config('customer-io.subscription_topics');

            $topics = array_fill_keys(array_values($subscriptionTopics), false);

            foreach ($brands as $brand) {
                $userOnboardingBrand->addBrand($brand);
                $userOnboardingBrand->save();

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

            if ($attributes) {
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
}
