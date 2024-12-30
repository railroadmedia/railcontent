<?php

namespace Modules\Ecommerce\Jobs\Shopify;

use App\Jobs\WebhookChildJob;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Services\UserNotificationKeys;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Modules\Content\Services\ChallengesService;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoCreateEventByUserId;

class OrderUpdateChallengesEnrollment extends WebhookChildJob
{
    public function __construct(
        private $contents,
    ) {
    }

    public function handle(
        SanityGateway $sanityGateway,
        ProductService $productService,
        UserService $userService,
        ChallengesService $challengesService
    ) {
        $lineItems = $this->contents['line_items'];
        $shopifyCustomerId = $this->contents['customer']['id'];
        $skus = Arr::pluck($lineItems, 'sku');
        $orderProducts = $productService->getProductsBySkus($skus);
        $orderProductIds = $orderProducts->pluck('id')->toArray();
        $sanityChallenges = $sanityGateway->getProductInformationForAllChallenges();
        $user = $userService->getUserByShopifyCustomerId($shopifyCustomerId);
        $ownsChallenge = false;
        foreach ($sanityChallenges as $challenge) {
            if (!in_array($challenge['product_id'], $orderProductIds)) {
                continue;
            }
            $ownsChallenge = true;
            $challengeId = $challenge['id'];
            $isSoloChallenge = $challenge['is_solo'] ?? false;
            $isAlreadyEnrolled = ChallengeUserProgress::whereChallengeIdAndUser($challengeId, $user->id) ?? false;
            if (!$isAlreadyEnrolled) {
                $startDate = $isSoloChallenge ? Carbon::today() : null;
                $challengesService->startChallenge($challengeId, $user->id, $startDate);
                //Send notifications it's not part of a bundle and is a community challenge
                if (count($skus) == 1 && !$isSoloChallenge) {
                    $challengesService->updateCustomerIONotifications(
                        $challengeId,
                        $user,
                        UserNotificationKeys::COMMUNITY_NOTIFICATION_KEY
                    );
                }

                dispatchWithDelay(
                    new CustomerIoCreateEventByUserId(
                        $user->id,
                        accountName: config('event-data-synchronizer.customer_io_account_to_sync_all_brands'),
                        eventName: 'challenge_enrolled',
                        eventData: [
                            'challenge_id' => $challengeId,
                            'brand' => $challenge['brand'] ?? 'musora',
                        ],
                        eventTimestamp: Carbon::now()->timestamp
                    ),
                    3
                );
            }
        }
        if ($ownsChallenge && !$user->is_challenge_owner) {
            $user->is_challenge_owner = true;
            $user->save();
        }

    }
}
