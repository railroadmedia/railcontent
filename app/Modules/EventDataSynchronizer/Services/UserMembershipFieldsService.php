<?php

namespace App\Modules\EventDataSynchronizer\Services;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Carbon\Carbon;
use Log;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Entities\UserProduct;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\SubscriptionRepository;
use Railroad\Ecommerce\Repositories\UserProductRepository;
use App\Modules\EventDataSynchronizer\Providers\UserProviderInterface;
use Railroad\Railcontent\Services\ContentService;

class UserMembershipFieldsService
{


    protected SubscriptionRepository $subscriptionRepository;
    protected UserProductRepository $userProductRepository;
    protected ProductRepository $productRepository;
    private ContentService $contentService;
    private UserProviderInterface $userProvider;

    private $instructorsCache = null;
    private UserAccessPermissionsService $userAccessPermissionsService;

    public function __construct(
        SubscriptionRepository $subscriptionRepository,
        UserProductRepository $userProductRepository,
        ProductRepository $productRepository,
        ContentService $contentService,
        UserProviderInterface $userProvider,
        UserAccessPermissionsService $userAccessPermissionsService
    ) {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->userProductRepository = $userProductRepository;
        $this->productRepository = $productRepository;
        $this->contentService = $contentService;
        $this->userProvider = $userProvider;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    public function syncUserAccess(UserAccessPermissionsCollection $userAccessPermissions): bool
    {
        $userId = $userAccessPermissions->getUserId();

        //This code is difficult to understand and should be thoroughly understood before changing it
        //membership expiration date comes from both plus and basic permissions combined
        $membershipExpirationDate = $userAccessPermissions->getMembershipExpirationDate();
        //access level comes from plus or basic permissions
        $plusMembershipExpirationDate = $userAccessPermissions->getPlusMembershipExpirationDate();
        $basicMembershipExpirationDate = $userAccessPermissions->getBasicMembershipExpirationDate();

        $songsOnlyExpirationDate = $userAccessPermissions->getSongsOnlyExpirationDate();

        $membershipLevel = null;
        if ($plusMembershipExpirationDate > Carbon::now() ||
            ($basicMembershipExpirationDate > Carbon::now() && $songsOnlyExpirationDate > Carbon::now())) {
            $membershipLevel = 'plus';
        } elseif ($basicMembershipExpirationDate > Carbon::now()) {
            $membershipLevel = 'basic';
        }

        $isLifetimeMember = $userAccessPermissions->getIsLifetimeMember();
        $isDrumeoLifetimeMember = $userAccessPermissions->getIsDrumeoLifetimeMember();
        $ownsPacks = $this->userAccessPermissionsService->getOwnsPacks($userAccessPermissions);


        $isAMember = $membershipExpirationDate > Carbon::now();

        $accessLevel = $this->getAccessLevelName(
            $userId,
            $isLifetimeMember,
            $isAMember,
            $membershipExpirationDate,
            $ownsPacks
        );

        return $this->userProvider->saveMembershipData(
            $userId,
            $membershipExpirationDate,
            $membershipStartDate,
            $isLifetimeMember,
            $accessLevel,
            $ownsPacks,
            $membershipLevel,
            $isDrumeoLifetimeMember
        );
    }

    public function sync($userId, array $userProducts = null, array $associatedCoaches = null): bool
    {
        $userAccessPermissions = $this->userAccessPermissionsService->getUserAccessPermissions($userId);
        return $this->syncUserAccess($userAccessPermissions);
    }

    /**
     * @param $userId
     * @param UserProduct[] $usersProducts
     * @return UserProduct|null
     */
    public function getUserProductThatRepresentsUsersMembership($userId, array $usersProducts): ?UserProduct
    {
        $eligibleUserProducts = [];

        foreach ($usersProducts as $userProductIndex => $userProduct) {
            // make sure the product is a membership product
            if (($userProduct->getProduct()->getDigitalAccessType() !==
                    Product::DIGITAL_ACCESS_TYPE_ALL_CONTENT_ACCESS &&
                    $userProduct->getProduct()->getDigitalAccessType() !==
                    'basic content access') ||
                $userProduct->getUser()->getId() !== $userId) {
                continue;
            }

            $eligibleUserProducts[] = $userProduct;
        }

        // get attributes related to the latest user membership product
        $latestMembershipUserProductToSync = null;

        foreach ($eligibleUserProducts as $eligibleUserProductIndex => $eligibleUserProduct) {
            // if its lifetime, use it
            if (empty($eligibleUserProduct->getExpirationDate()) &&
                $eligibleUserProduct->getProduct()->getDigitalAccessTimeType() ==
                Product::DIGITAL_ACCESS_TIME_TYPE_LIFETIME &&
                (empty($latestMembershipUserProductToSync) || $latestMembershipUserProductToSync->getProduct(
                    )->getBrand() != "drumeo")
            ) {
                //prioritize drumeo over other lifetimes because they get some songs access
                $latestMembershipUserProductToSync = $eligibleUserProduct;
            }
        }

        if (!empty($latestMembershipUserProductToSync)) {
            return $latestMembershipUserProductToSync;
        }

        foreach ($eligibleUserProducts as $eligibleUserProductIndex => $eligibleUserProduct) {
            if (empty($latestMembershipUserProductToSync)) {
                $latestMembershipUserProductToSync = $eligibleUserProduct;
                continue;
            }

            // if this product expiration date is further in the past than whatever is currently set, skip it
            if (!empty($latestMembershipUserProductToSync) &&
                ($latestMembershipUserProductToSync->getExpirationDate() <
                    $eligibleUserProduct->getExpirationDate())) {
                $latestMembershipUserProductToSync = $eligibleUserProduct;
            }
        }

        if (!empty($latestMembershipUserProductToSync)) {
            return $latestMembershipUserProductToSync;
        }

        return null;
    }

    /**
     * The value of this should be not used for anything other than visual purposes. It does not always represent the
     * state of the users membership exactly.
     *
     * @param $userId
     * @param bool $isLifetime
     * @param bool $isAMember
     * @param Carbon|null $membershipExpirationDate
     * @param bool $ownsPacks
     * @return string
     */
    public function getAccessLevelName(
        $userId,
        bool $isLifetime,
        bool $isAMember,
        ?Carbon $membershipExpirationDate,
        bool $ownsPacks,
        array $associatedCoaches = null
    ): string {
        if (empty($userId)) {
            return '';
        }

        if ($this->isHouseCoach($userId, $associatedCoaches)) {
            return 'house-coach';
        }

        if ($this->isCoach($userId, $associatedCoaches)) {
            return 'coach';
        }

        if ($this->userProvider->isAdministrator($userId)) {
            return 'team';
        }

        if ($isLifetime) {
            return 'lifetime';
        }

        if ($isAMember && (!empty($membershipExpirationDate) && $membershipExpirationDate > Carbon::now())) {
            return 'member';
        }

        if ($ownsPacks) {
            return 'pack';
        }

        if (!empty($membershipExpirationDate) && $membershipExpirationDate < Carbon::now()) {
            return 'expired';
        }

        return '';
    }

    /**
     * @param $userId
     * @return bool
     */
    public function isHouseCoach($userId, array $associatedCoaches = null): bool
    {
        if (!isset($associatedCoaches)) {
            $associatedCoaches = $this->getCoaches();
        }

        return
            (!empty($associatedCoaches) &&
                array_key_exists($userId, $associatedCoaches) &&
                ($associatedCoaches[$userId]['is_house_coach'] == "1"));
    }

    /**
     * @param $userId
     * @return bool
     */
    public function isCoach($userId, array $associatedCoaches = null): bool
    {
        if (!isset($associatedCoaches)) {
            $associatedCoaches = $this->getCoaches();
        }

        return !empty($associatedCoaches) && array_key_exists($userId, $associatedCoaches);
    }

    /**
     * @return array
     */
    public function getCoaches(): array
    {
        $associatedUsers = [];

        if (!isset($this->instructorsCache)) {
            $this->instructorsCache =
                $this->contentService
                    ->getFiltered(
                        1,
                        'null',
                        '-published_on',
                        ['instructor'],
                        [],
                        [],
                        [],
                        []
                    );
        }

        $instructors = $this->instructorsCache;

        foreach ($instructors->results() as $instructor) {
            $associatedUsers[$instructor->fetch('fields.associated_user_id')] = [
                'id' => $instructor['id'],
                'url' => $instructor->fetch('url', ''),
                'is_house_coach' => $instructor->fetch('fields.is_house_coach', 0),
            ];
        }

        return $associatedUsers;
    }
}
