<?php

namespace Modules\Ecommerce\Jobs\Shopify;

use App\Jobs\WebhookChildJob;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Modules\Content\Services\ChallengesService;

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
        $orderProducts = $productService->getProductsBySkus([$skus]);
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
                        ChallengesService::COMMUNITY_NOTIFICATION_KEY
                    );
                }
            }
        }
        if ($ownsChallenge && !$user->is_challenge_owner) {
            $user->is_challenge_owner = true;
            $user->save();
        }
    }
}
