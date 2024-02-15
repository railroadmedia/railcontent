<?php

namespace App\Modules\EventDataSynchronizer\Listeners\CustomerIo;

use App\Modules\Ecommerce\Collections\OrderCollection;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\RechargeSubscriptionStatusEnum;
use App\Modules\Ecommerce\Events\AccessCodeClaimed;
use App\Modules\Ecommerce\Events\AugustContestReferralClaimed;
use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Recharge\Subscription as RechargeSubscription;
use App\Modules\Ecommerce\Models\Shopify\Order;
use App\Modules\Ecommerce\Models\Shopify\OrderLineItem;
use App\Modules\Ecommerce\Services\ProductService;
use App\Modules\EventDataSynchronizer\Events\FirstActivityPerDay;
use App\Modules\EventDataSynchronizer\Events\LiveStreamEventAttended;
use App\Modules\EventDataSynchronizer\Events\UTMLinks;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoCreateEventByUserId;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncCustomerByEmail;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncMentor;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncNewUserByEmail;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserDevice;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoTriggerEvent;
use App\Modules\Mentor\Events\StudentMentorsUpdated;
use App\Modules\UserManagementSystem\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Events\CommentCreated;
use Railroad\Railcontent\Events\CommentLiked;
use Railroad\Railcontent\Events\ContentFollow;
use Railroad\Railcontent\Events\ContentUnfollow;
use Railroad\Railcontent\Events\UserContentProgressSaved;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railforums\Events\PostCreated;
use Railroad\Railforums\Events\ThreadCreated;
use Railroad\Railforums\Repositories\CategoryRepository;
use Railroad\Railforums\Repositories\PostRepository;
use Railroad\Railforums\Repositories\ThreadRepository;
use Railroad\Railforums\Services\ConfigService;
use App\Modules\Referral\Events\EmailInvite;
use App\Modules\Referral\Events\ReferralClaimed;
use Throwable;

class CustomerIoSyncEventListener
{
    private UserService $userService;

    private CommentRepository $commentRepository;

    private ThreadRepository $threadRepository;

    private PostRepository $postRepository;

    private CategoryRepository $categoryRepository;

    private ContentService $contentService;

    /**
     * @var bool
     */
    public static $disable = false;
    /**
     * @var array
     */
    public static $alreadyQueuedUserIds = [];
    private ProductService $productService;

    public function __construct(
        UserService $userService,
        CommentRepository $commentRepository,
        CategoryRepository $categoryRepository,
        ThreadRepository $threadRepository,
        PostRepository $postRepository,
        ContentService $contentService,
        ProductService $productService
    ) {
        $this->userService = $userService;
        $this->commentRepository = $commentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->threadRepository = $threadRepository;
        $this->postRepository = $postRepository;
        $this->contentService = $contentService;
        $this->productService = $productService;
    }

    /**
     * @param UserCreated $userCreated
     */
    public function handleUserCreated(UserCreated $userCreated)
    {
        if (self::$disable) {
            return;
        }

        try {
            $user = $this->userService->getByIdOrNull($userCreated->getUser()->id);

            if (!empty($user) && !in_array(
                    $userCreated->getUser()
                        ->id,
                    self::$alreadyQueuedUserIds
                )) {
                dispatch(
                    (new CustomerIoSyncNewUserByEmail($user))->delay(
                        Carbon::now()
                            ->addSeconds(3)
                    )
                );

                self::$alreadyQueuedUserIds[] =
                    $userCreated->getUser()
                        ->id;
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param UserUpdated $userUpdated
     */
    public function handleUserUpdated(UserUpdated $userUpdated)
    {
        if (self::$disable) {
            return;
        }

        try {
            $user = $this->userService->getByIdOrNull($userUpdated->getNewUser()->id);

            if (!empty($user) && !in_array(
                    $userUpdated->getNewUser()->id,
                    self::$alreadyQueuedUserIds
                )) {
                dispatch(
                    (new CustomerIoSyncUserByUserId($user))->delay(
                        Carbon::now()
                            ->addSeconds(3)
                    )
                );

                self::$alreadyQueuedUserIds[] = $user->id;
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    public function handleUserAccessPermissionsUpdated(UserAccessPermissionsUpdated $userAccessPermissionsUpdated): void
    {
        if (self::$disable) {
            return;
        }

        try {
            $userId = $userAccessPermissionsUpdated->getUserId();
            $user = $this->userService->getByIdOrNull($userId);

            $data = $this->getCustomerIoDataFromOrders(
                $user,
                $userAccessPermissionsUpdated->getUserAccessPermissions(),
                $userAccessPermissionsUpdated->getOrderCollection(),
                $userAccessPermissionsUpdated->getSubscriptions()
            );

            if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
                dispatch(
                    (new CustomerIoSyncUserByUserId($user, $data))->delay(
                        Carbon::now()
                            ->addSeconds(3)
                    )
                );

                self::$alreadyQueuedUserIds[] = $user->id;
            }
        } catch (Throwable $throwable) {
            Log::error($throwable);
        }
    }

    /**
     * @param CommentLiked $commentLiked
     */
    public function handleCommentLiked(CommentLiked $commentLiked)
    {
        if (self::$disable) {
            return;
        }

        try {
            $comment = $this->commentRepository->getById($commentLiked->commentId);
            $content = $this->contentService->getById($comment['content_id']);
            $user = $this->userService->getByIdOrNull($commentLiked->userId);

            if (!empty($comment) && !empty($content) && !empty($user)) {
                dispatch(
                    (new CustomerIoCreateEventByUserId(
                        $user->id, $content['brand'], $content['brand'] . '_action_lesson_comment-like', [
                        'content_id' => $content['id'],
                        'content_name' => $content->fetch('fields.title'),
                        'content_type' => $content['type'],
                    ], null, Carbon::now()->timestamp
                    ))->delay(
                        Carbon::now()
                            ->addSeconds(3)
                    )
                );
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param CommentCreated $commentCreated
     */
    public function handleCommentCreated(CommentCreated $commentCreated)
    {
        if (self::$disable) {
            return;
        }

        try {
            $comment = $this->commentRepository->getById($commentCreated->commentId);
            $content = $this->contentService->getById($comment['content_id']);
            $user = $this->userService->getByIdOrNull($commentCreated->userId);

            if (!empty($comment) && !empty($content) && !empty($user)) {
                dispatch(
                    (new CustomerIoCreateEventByUserId(
                        $user->id, $content['brand'], $content['brand'] . '_action_lesson_comment', [
                        'content_id' => $content['id'],
                        'content_name' => $content->fetch('fields.title'),
                        'content_type' => $content['type'],
                    ], null, Carbon::now()->timestamp
                    ))->delay(
                        Carbon::now()
                            ->addSeconds(3)
                    )
                );
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param ThreadCreated $threadCreated
     */
    public function handleForumsThreadCreated(ThreadCreated $threadCreated)
    {
        if (self::$disable) {
            return;
        }

        try {
            $thread =
                $this->threadRepository->getDecoratedQuery()
                    ->where(ConfigService::$tableThreads . '.id', $threadCreated->getThreadId())
                    ->first();
            $category =
                $this->categoryRepository->getDecoratedQuery()
                    ->where(ConfigService::$tableCategories . '.id', $thread['category_id'])
                    ->first();
            $user = $this->userService->getByIdOrNull($threadCreated->getUserId());

            if (!empty($thread) && !empty($user)) {
                dispatch(
                    (new CustomerIoCreateEventByUserId(
                        $user->id,
                        $category['brand'],
                        $category['brand'] . '_action_forum_create-thread',
                        [],
                        null,
                        Carbon::now()->timestamp
                    ))->delay(
                        Carbon::now()
                            ->addSeconds(3)
                    )
                );
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param PostCreated $postCreated
     */
    public function handleForumsPostCreated(PostCreated $postCreated)
    {
        if (self::$disable) {
            return;
        }

        try {
            $post =
                $this->postRepository->getDecoratedQuery()
                    ->where(ConfigService::$tablePosts . '.id', $postCreated->getPostId())
                    ->first();
            $thread =
                $this->threadRepository->getDecoratedQuery()
                    ->where(ConfigService::$tableThreads . '.id', $post['thread_id'])
                    ->first();
            $category =
                $this->categoryRepository->getDecoratedQuery()
                    ->where(ConfigService::$tableCategories . '.id', $thread['category_id'])
                    ->first();
            $user = $this->userService->getByIdOrNull($post['author_id']);

            if (!empty($thread) && !empty($user)) {
                dispatch(
                    (new CustomerIoCreateEventByUserId(
                        $user->id,
                        $category['brand'],
                        $category['brand'] . '_action_forum_comment',
                        [],
                        null,
                        Carbon::now()->timestamp
                    ))->delay(
                        Carbon::now()
                            ->addSeconds(3)
                    )
                );
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param UserContentProgressSaved $userContentProgressSaved
     */
    public function handleUserContentProgressSaved(UserContentProgressSaved $userContentProgressSaved)
    {
        if (self::$disable) {
            return;
        }

        try {
            $content = $this->contentService->getById($userContentProgressSaved->contentId);
            $user = $this->userService->getByIdOrNull($userContentProgressSaved->userId);

            if (!empty($content) && !empty($user)) {
                // map the content type to the event string
                $contentTypeToEventStringMap =
                    config('event-data-synchronizer.customer_io_content_type_to_event_string_map', []);

                if (!empty($contentTypeToEventStringMap[$content['type']])) {
                    $data = [
                        'content_id' => $content['id'],
                        'content_name' => $content->fetch('fields.title'),
                        'content_type' => $content['type'],
                    ];

                    // if its a song, attach extra data
                    if ($content['type'] == 'song') {
                        $data['song_name'] = $content->fetch('fields.title');
                        $data['song_artist'] = $content->fetch('fields.artist');
                        $data['song_album'] = $content->fetch('fields.album');
                        $data['song_difficulty'] = $content->fetch('fields.difficulty');
                    }

                    dispatch(
                        (new CustomerIoCreateEventByUserId(
                            $user->id,
                            $content['brand'],
                            $content['brand'] .
                            '_action_' .
                            $contentTypeToEventStringMap[$content['type']] .
                            '_' .
                            $userContentProgressSaved->progressStatus,
                            $data,
                            null,
                            Carbon::now()->timestamp
                        ))->delay(
                            Carbon::now()
                                ->addSeconds(3)
                        )
                    );
                }

                // if has a video attached, also trigger the generic lesson event
                if (!empty($content->fetch('*fields.video'))) {
                    $data = [
                        'content_id' => $content['id'],
                        'content_name' => $content->fetch('fields.title'),
                        'content_type' => $content['type'],
                    ];

                    dispatch(
                        (new CustomerIoCreateEventByUserId(
                            $user->id,
                            $content['brand'],
                            $content['brand'] . '_action_lesson' . '_' . $userContentProgressSaved->progressStatus,
                            $data,
                            null,
                            Carbon::now()->timestamp
                        ))->delay(
                            Carbon::now()
                                ->addSeconds(3)
                        )
                    );
                }

                // if its method content, also trigger the relevant method event
                if (in_array($content['type'], ['learning-path', 'learning-path-level', 'learning-path-lesson'])) {
                }
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param LiveStreamEventAttended $liveStreamEventAttended
     */
    public function handleLiveLessonAttended(LiveStreamEventAttended $liveStreamEventAttended)
    {
        if (self::$disable) {
            return;
        }

        try {
            $content = $this->contentService->getById($liveStreamEventAttended->getContentId());
            $user = $this->userService->getByIdOrNull($liveStreamEventAttended->getUserId());

            if (!empty($content) && !empty($user)) {
                $data = [
                    'content_id' => $content['id'],
                    'content_name' => $content->fetch('fields.title'),
                    'content_type' => $content['type'],
                ];

                dispatch(
                    (new CustomerIoCreateEventByUserId(
                        $user->id,
                        $content['brand'],
                        $content['brand'] . '_action_live-stream-event-attended',
                        $data,
                        null,
                        Carbon::now()->timestamp
                    ))->delay(
                        Carbon::now()
                            ->addSeconds(3)
                    )
                );
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param FirstActivityPerDay $activityEvent
     */
    public function handleFirstActivityPerDay(FirstActivityPerDay $activityEvent)
    {
        if (self::$disable) {
            return;
        }

        try {
            dispatch(
                (new CustomerIoCreateEventByUserId(
                    $activityEvent->getUserId(),
                    config('event-data-synchronizer.customer_io_account_to_sync_all_brands'),
                    'musora_members_area_activity',
                    [
                        'brands' => $activityEvent->getBrands()
                    ],
                    null,
                    Carbon::now()->timestamp
                ))->delay(
                    Carbon::now()
                        ->addSeconds(3)
                )
            );
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    public function handleContentFollow(ContentFollow $contentFollow)
    {
        $this->syncUsersContentFollows($contentFollow->userId);
    }

    public function handleContentUnfollow(ContentUnfollow $contentUnfollow)
    {
        $this->syncUsersContentFollows($contentUnfollow->userId);
    }

    public function syncUsersContentFollows(int $userId)
    {
        if (self::$disable) {
            return;
        }

        try {
            $user = $this->userService->getByIdOrNull($userId);

            if (!empty($user) && !in_array($userId, self::$alreadyQueuedUserIds)) {
                dispatch(
                    (new CustomerIoSyncUserByUserId($user))->delay(
                        Carbon::now()
                            ->addSeconds(3)
                    )
                );

                self::$alreadyQueuedUserIds[] = $user->id;
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param UTMLinks $UTMLinks
     */
    public function handleUTMLinks(UTMLinks $UTMLinks)
    {
        if (self::$disable) {
            return;
        }

        $data = [];
        if ($UTMLinks->getUtmId()) {
            $data = array_merge($data, ['utm_id' => $UTMLinks->getUtmId()]);
        }
        if ($UTMLinks->getUtmSource()) {
            $data = array_merge($data, ['utm_source' => $UTMLinks->getUtmSource()]);
        }
        if ($UTMLinks->getUtmCampaign()) {
            $data = array_merge($data, ['utm_campaign' => $UTMLinks->getUtmCampaign()]);
        }
        if ($UTMLinks->getUtmMedium()) {
            $data = array_merge($data, ['utm_medium' => $UTMLinks->getUtmMedium()]);
        }

        try {
            dispatch(
                (new CustomerIoCreateEventByUserId(
                    $UTMLinks->getUserId(),
                    $UTMLinks->getBrand(),
                    $UTMLinks->getBrand() . '_prospect_ultimate-toolbox',
                    $data,
                    null,
                    Carbon::now()->timestamp
                ))->delay(
                    Carbon::now()
                        ->addSeconds(3)
                )
            );
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param EmailInvite $emailInvite
     */
    public function handleReferralInvite(EmailInvite $emailInvite)
    {
        if (self::$disable) {
            return;
        }

        // create or update customer.io customer by email, add attribute for the referral link
        // trigger event for that customer
        // only trigger for the brand customer.io workspaces

        // customer_io_saasquatch_email_invite_event_name
        // customer_io_saasquatch_email_invite_link_attribute_name

        try {
            dispatch(
                (new CustomerIoSyncCustomerByEmail(
                    $emailInvite->getReceiversEmail(),
                    $emailInvite->getBrand(),  //todo: is this param correct? or should we use another one?
                    [
                        $emailInvite->getBrand() . config(
                            'event-data-synchronizer.customer_io_saasquatch_email_invite_link_attribute_name'
                        ) => $emailInvite->getReferralLink()
                    ]
                ))->delay(
                    Carbon::now()
                        ->addSeconds(3)
                )
            );

            dispatch(
                (new CustomerIoTriggerEvent(
                    $emailInvite->getBrand(),
                    $emailInvite->getReceiversEmail(),
                    null,
                    $emailInvite->getBrand() . config(
                        'event-data-synchronizer.customer_io_saasquatch_email_invite_event_name'
                    )
                ))->delay(
                    Carbon::now()
                        ->addSeconds(10)
                )
            );

            dispatch(
                (new CustomerIoTriggerEvent(
                    config('event-data-synchronizer.customer_io_account_to_sync_all_brands'),
                    $emailInvite->getReceiversEmail(),
                    null,
                    config('event-data-synchronizer.customer_io_account_to_sync_all_brands') . config(
                        'event-data-synchronizer.customer_io_saasquatch_email_invite_event_name'
                    )
                ))->delay(
                    Carbon::now()
                        ->addSeconds(10)
                )
            );
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param MobileAppLogin $mobileAppLogin
     */
    public function handleMobileAppLogin(MobileAppLogin $mobileAppLogin)
    {
        if (self::$disable) {
            return;
        }

        if (!$mobileAppLogin->getFirebaseToken() || !$mobileAppLogin->getPlatform()) {
            return;
        }

        try {
            $this->syncDevice(
                $mobileAppLogin->getUser()->id,
                $mobileAppLogin->getFirebaseToken(),
                $mobileAppLogin->getPlatform()
            );
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param $userId
     * @param $token
     * @param $platform
     * @param null $timestamp
     */
    public function syncDevice($userId, $token, $platform, $brand = null, $timestamp = null)
    {
        try {
            dispatch(
                (new CustomerIoSyncUserDevice(
                    $userId, $brand ?? config('event-data-synchronizer.customer_io_brand_activity_event'), [
                    'id' => $token,
                    'platform' => $platform,
                ], $timestamp ?? Carbon::now()->timestamp
                ))->delay(
                    Carbon::now()
                        ->addSeconds(3)
                )
            );
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }


    public function handleMentorUpdated(StudentMentorsUpdated $studentMentorsUpdated): void
    {
        if (self::$disable) {
            return;
        }

        try {
            dispatch(
                (new CustomerIoSyncMentor($studentMentorsUpdated->mentorStudentData))
                    ->delay(Carbon::now()->addSeconds(3))
            );
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }


    public function handleAccessCodeClaimed(AccessCodeClaimed $accessCodeClaimed)
    {
        $accessCode = $accessCodeClaimed->getAccessCode();
        $brand = $accessCode->brand;

        dispatch(
            (new CustomerIoCreateEventByUserId(
                $accessCodeClaimed->getUser()->id,
                $brand,
                'musora_membership_non_recurring_access_added',
                [
                    'brand_source' => $brand,
                    'access_method' => $accessCode->code,
                    'access_source' => $accessCode->source,
                    'access_added_timestamp' => Carbon::parse($accessCode->updated_at)->timestamp,
                    'code_creation_date' => Carbon::parse($accessCode->created_at)->timestamp,
                    'product_ids' => $accessCode->getProductIdsAsString(),
                    'referrer_id' => null,
                    'musora_id' => null

                ], null, Carbon::now()->timestamp
            ))->delay(
                Carbon::now()
                    ->addSeconds(3)
            )
        );
    }

    // CMT-77 August Referral Contest

    /**
     * @param ReferralClaimed $referralClaimed
     */
    public function handleAugustContestReferralClaimed(AugustContestReferralClaimed $referralClaimed)
    {
        $referrer = $referralClaimed->getReferrer();
        $referrerEmail = $this->userService->getByIdOrNull($referrer->user_id)?->getEmail();
        dispatch(
            (new CustomerIoCreateEventByUserId(
                $referralClaimed->getUserId(),
                $referrer->brand,
                'musora_trial_subscription_via_referral',
                [
                    'brand_source' => $referrer->brand,
                    'access_source' => 'saasquatch',
                    'access_added_timestamp' => $referrer->updated_at->timestamp,
                    'product_ids' => $referralClaimed->getProductId(),
                    'referrer_email' => $referrerEmail // email of the person who generated the invite code - CMT-77
                ],
                null,
                Carbon::now()->timestamp
            ))
                ->delay(
                    Carbon::now()
                        ->addSeconds(3)
                )
        );
    }

    /**
     * @param ReferralClaimed $referralClaimed
     */
    public function handleReferralClaimed(ReferralClaimed $referralClaimed)
    {
        $referrer = $referralClaimed->getReferrer();
        dispatch(
            (new CustomerIoCreateEventByUserId(
                $referralClaimed->getUserId(),
                $referrer->brand,
                'musora_membership_non_recurring_access_added',
                [
                    'brand_source' => $referrer->brand,
                    'access_method' => $referrer->referral_code,
                    'access_source' => 'saasquatch',
                    'access_added_timestamp' => $referrer->updated_at->timestamp,
                    'code_creation_date' => null,
                    'product_ids' => $referralClaimed->getProductId(),
                    'referrer_id' => $referralClaimed->getUserId(),  // the id of the new user created - MT-438
                    'musora_id' => $referrer->user_id   // the person who generated the invite code - MT-438
                ],
                null,
                Carbon::now()->timestamp
            ))
                ->delay(
                    Carbon::now()
                        ->addSeconds(3)
                )
        );
    }

    private function getCustomerIoDataFromOrders(
        User $user,
        UserAccessPermissionsCollection $userAccessPermissionsCollection,
        ?OrderCollection $orderCollection,
        $subscriptions
    ): array {
        $attributes = $this->getOrderAttributes($orderCollection);
        $permissionsAttributes = $this->getPermissionsAttributes($userAccessPermissionsCollection);
        $subscriptionAttributes = $this->getSubscriptionAttributes($user, $subscriptions);
        return array_merge($attributes, $permissionsAttributes, $subscriptionAttributes);
    }

    public function getPermissionsAttributes(UserAccessPermissionsCollection $userAccessPermissionsCollection)
    {
        $attributes = [];
        $packProductLookup = $this->productService->getPackProductsByOwnedProductIds(
            $userAccessPermissionsCollection->getActiveProductIds()
        )->groupBy('brand');

        $brands = config('event-data-synchronizer.customer_io_brands_to_sync');

        foreach ($brands as $brand) {
            $ownedPackIds = $this->getOwnedPackIds($brand, $packProductLookup);
            $attributes[$brand . '_owned_pack_product_ids'] = implode(', ', $ownedPackIds);

            $ownedPackSkus = $this->getOwnedPackSkus($brand, $packProductLookup);
            $attributes[$brand . '_owned_pack_product_skus'] = implode(', ', $ownedPackSkus);
        }
        return $attributes;
    }

    public function getOrderAttributes(?OrderCollection $orderCollection): array
    {
        if (!$orderCollection) {
            return [];
        }
        $attributes = [];

        $membershipOrderItemsLookup = $orderCollection->getOrders()->flatMap(function ($order) {
            /** @var Order $order */
            return $order->lineItems->filter(function ($orderLineItem) {
                /** @var OrderLineItem $orderLineItem */
                return $orderLineItem->product && $orderLineItem->product->isDigital(
                    ) && $orderLineItem->product->isMembershipProduct();
            });
        })->groupBy(function ($orderLineItem) {
            /** @var OrderLineItem $orderLineItem */
            if ($orderLineItem->product) {
                return $orderLineItem->product->brand;
            }
            return 'unknown';
        });

        $brands = config('event-data-synchronizer.customer_io_brands_to_sync');

        foreach ($brands as $brand) {
            $orderItems = ($membershipOrderItemsLookup[$brand] ?? collect())->sortBy(function ($orderLineItem) {
                /** @var OrderLineItem $orderLineItem */
                return $orderLineItem->order->processedAt->timestamp;
            });

            $first = $orderItems->first();
            if ($first) {
                $attributes[$brand . '_membership_first-access-start-date'] = $first->order->processedAt->timestamp;
            }

            $last = $orderItems->last();
            if ($last) {
                $attributes[$brand . '_membership_latest-access-start-date'] = $last->order->processedAt->timestamp;
            }
        }
        return $attributes;
    }

    private
    function getSubscriptionAttributes(
        User $user,
        $subscriptions
    ): array {
        if (!$subscriptions) {
            return [];
        }
        $attributes = [];

        $subscriptionsByBrand = $subscriptions->groupBy(function ($subscription) {
            /** @var RechargeSubscription $subscription */
            return $subscription->product->brand;
        });


        $brands = config('event-data-synchronizer.customer_io_brands_to_sync');

        foreach ($brands as $brand) {
            $brandSubscriptions = ($subscriptionsByBrand[$brand] ?? collect())->sortBy('createdAt');
            /** @var RechargeSubscription $first */
            $first = $brandSubscriptions->first() ?? null;
            /** @var RechargeSubscription $latest */
            $latest = $brandSubscriptions->last() ?? null;

            if (!$first || !$latest || $user->hasMobileMembership()) {
                continue;
            }

            $attributes[$brand . '_membership_status'] = $this->getSubscriptionStatus($latest);
            $attributes[$brand . '_membership_subscription_type'] =
                $latest->product->subscription_interval_count . "_" . $latest->product->subscription_interval_type;
            $attributes[$brand . '_membership_subscription_renewal-date'] = $latest->nextChargeScheduledAt?->timestamp ?? '';
            $attributes[$brand . '_membership_subscription_cancellation-date'] = $latest->cancelledAt?->timestamp;
            $attributes[$brand . '_membership_subscription_cancellation-reason'] = $latest->cancellationReason;
            $attributes[$brand . '_membership_subscription_first-start-date'] =
                Carbon::parse($user->created_at)->timestamp;
            $attributes[$brand . '_membership_subscription_latest-start-date'] = $latest->updatedAt?->timestamp;
            $attributes[$brand . '_membership_subscription_trial-type'] = $this->getTrialType($latest);
            $attributes[$brand . '_membership_latest-access-product-id'] = $latest->product->id;
        }
        return $attributes;
    }

    public
    function getSubscriptionStatus(
        RechargeSubscription $subscription
    ): string {
        return match ($subscription->status) {
            RechargeSubscriptionStatusEnum::Active->value => 'active',
            RechargeSubscriptionStatusEnum::Cancelled->value => 'cancelled',
            RechargeSubscriptionStatusEnum::Expired->value => 'expired',
            default => 'unknown',
        };
    }

    private
    function getTrialType(
        RechargeSubscription $latest
    ): string {
        if (!$latest->product->isTrial()) {
            return "";
        }
        $interval = match ($latest->product->subscription_interval_type) {
            "month" => "monthly",
            "year" => "annual",
            default => "unknown",
        };

        $days = 0;
        if (str_contains(strtolower($latest->product->sku), "7-day")
            || $latest->product->sku == "PIANOTE-MEMBERSHIP-TRIAL") {
            $days = 7;
        }
        if (str_contains(strtolower($latest->product->sku), "30-day")
            || str_contains(strtolower($latest->product->sku), "1-month")) {
            $days = 30;
        }

        if ($days == 0 || $interval == "unknown") {
            Log::error("Unable to parse trial type for product: " . $latest->product->id);
            return "";
        }

        return $interval . "_" . $days . "_days_free";
    }

    public function getOwnedPackIds(string $brand, $packProductLookup): array
    {
        $packIds = ($packProductLookup[$brand] ?? collect())
            ->map(function (Product $product) {
                return "_" . $product->id . "_";
            })->toArray();

        return $packIds;
    }

    public function getOwnedPackSkus(string $brand, $packProductLookup): array
    {
        $packSkus = ($packProductLookup[$brand] ?? collect())
            ->map(function (Product $product) {
                return "_" . $product->sku . "_";
            })->toArray();

        return $packSkus;
    }
}
