<?php

namespace App\Modules\UserManagementSystem\Jobs;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Shopify\Rest\Order;
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
use Modules\UserManagementSystem\Models\OnboardingAnswerHistory;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\REST\Resources\OrderResource;
use Signifly\Shopify\Shopify;

class BackfillOnboardingBrandsJob implements ShouldQueue
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
            ->doesntHave('onboardingBrands')
            ->whereBetween('id', [$this->firstId, $this->lastId])
            ->get();

        foreach ($users as $user) {
            // check membership brand
            $brands = [];

            $permissionBrands = $user->userAccessPermissions()
                ->orderBy('created_at')
                ->withOnly('product')
                ->get()
                ->pluck('product.brand')
                ->reject(fn (?string $brand) => $brand === Brand::Musora->value)
                ->unique()
                ->values()
                ->filter()
                ->toArray();

            array_push($brands, ...$permissionBrands);

            // check onboarding instrument answers
            $brandAnswers = $user->onboardingAnswerHistory()
                     ->where('onboarding_question', 'instrument')
                     ->get()
                     ->map(function (OnboardingAnswerHistory $oah) {
                         return $this->onboardingService->getBrandFromInstrument($oah->onboarding_answer);
                     })->toArray();

            array_push($brands, ...$brandAnswers);

            // if nothing above, try checking Shopify
            if (empty($brands)) {
                $customer = $this->shopify->getCustomers(['email' => $user->email])->first();
                $this->handleRateLimit();
                if (!$customer) {
                    Log::warning(sprintf("%s: User not found in Shopify", $this->getClassName()));
                } else {
                    $customerOrders = $this->shopify->getCustomerOrders($customer->id, ['status' => 'any']);
                    $this->handleRateLimit();
                    // clean up the response to our data model
                    $customerOrders->transform(function (OrderResource $orderResource) {
                        $attributes = $orderResource->getAttributes();
                        return new Order(json_decode(json_encode($attributes), false));
                    });

                    // get only those with a membership item, sorted oldest to newest
                    $membershipOrders = $customerOrders->filter(function (Order $order) {
                        return $order->isMembershipOrder();
                    })->sortByDesc('processedAt');

                    $orderBrands = $membershipOrders->map(function (Order $order) {
                        return $order->lineItems->pluck('product.brand');
                    })
                        ->flatten()
                        ->reject(Brand::Musora->value)
                        ->unique();

                    array_push($brands, ...$orderBrands);
                }
            }

            // if still nothing, check primary brand
            if (empty($brands) && $user->primary_brand) {
                $brands[] = $user->primary_brand;
            }

            // clean up duplicates
            $brands = array_unique($brands);

            if (empty($brands)) {
                Log::warning(sprintf("%s: No brand information found for user %s", $this->getClassName(), $user->email));
                continue;
            }

            // push to customer.io
            $attributes = [];

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
