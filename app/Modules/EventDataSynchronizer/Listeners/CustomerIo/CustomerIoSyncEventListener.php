<?php

namespace App\Modules\EventDataSynchronizer\Listeners\CustomerIo;

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
use Modules\UserManagementSystem\Events\MobileAppLogin;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\User;
use Railroad\Ecommerce\Entities\Subscription;
use Railroad\Ecommerce\Entities\User as EcommerceUser;
use Railroad\Ecommerce\Events\AccessCodeClaimed;
use Railroad\Ecommerce\Events\AppSignupFinishedEvent;
use Railroad\Ecommerce\Events\AppSignupStartedEvent;
use Railroad\Ecommerce\Events\MobileOrderEvent;
use Railroad\Ecommerce\Events\OrderEvent;
use Railroad\Ecommerce\Events\PaymentEvent;
use Railroad\Ecommerce\Events\PaymentMethods\PaymentMethodCreated;
use Railroad\Ecommerce\Events\PaymentMethods\PaymentMethodUpdated;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionCreated;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionRenewed;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionRenewFailed;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionUpdated;
use Railroad\Ecommerce\Events\UserProducts\UserProductCreated;
use Railroad\Ecommerce\Events\UserProducts\UserProductDeleted;
use Railroad\Ecommerce\Events\UserProducts\UserProductUpdated;
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
use Railroad\Referral\Events\EmailInvite;
use Railroad\Referral\Events\ReferralClaimed;
use Throwable;

class CustomerIoSyncEventListener
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var ThreadRepository
     */
    private $threadRepository;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var bool
     */
    public static $disable = false;
    /**
     * @var array
     */
    public static $alreadyQueuedUserIds = [];

    /**
     * CustomerIoSyncEventListener constructor.
     *
     * @param UserService $userService
     * @param CommentRepository $commentRepository
     * @param CategoryRepository $categoryRepository
     * @param ThreadRepository $threadRepository
     * @param PostRepository $postRepository
     */
    public function __construct(
        UserService $userService,
        CommentRepository $commentRepository,
        CategoryRepository $categoryRepository,
        ThreadRepository $threadRepository,
        PostRepository $postRepository,
        ContentService $contentService
    ) {
        $this->userService = $userService;
        $this->commentRepository = $commentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->threadRepository = $threadRepository;
        $this->postRepository = $postRepository;
        $this->contentService = $contentService;
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

    /**
     * @param PaymentMethodCreated $paymentMethodCreated
     */
    public function handleUserPaymentMethodCreated(PaymentMethodCreated $paymentMethodCreated)
    {
        if (self::$disable) {
            return;
        }

        try {
            if ($paymentMethodCreated->getUser() instanceof User) {
                $this->handleUserPaymentMethodUpdated(
                    new PaymentMethodUpdated(
                        $paymentMethodCreated->getPaymentMethod(),
                        $paymentMethodCreated->getPaymentMethod(),
                        $paymentMethodCreated->getUser()
                    )
                );
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param PaymentMethodUpdated $paymentMethodUpdated
     */
    public function handleUserPaymentMethodUpdated(PaymentMethodUpdated $paymentMethodUpdated)
    {
        if (self::$disable) {
            return;
        }

        try {
            if (!empty(
                $paymentMethodUpdated->getUser()
                    ->getId()
                ) && $paymentMethodUpdated->getUser() instanceof User && !in_array(
                    $paymentMethodUpdated->getUser()
                        ->getId(),
                    self::$alreadyQueuedUserIds
                )) {
                $userId = $paymentMethodUpdated->getUser()->getId();
                $user = $this->userService->getByIdOrNull($userId);

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
     * @param UserProductCreated $userProductCreated
     */
    public function handleUserProductCreated(UserProductCreated $userProductCreated)
    {
        if (self::$disable) {
            return;
        }

        try {
            $userId = $userProductCreated->getUserProduct()
                ->getUser()
                ->getId();
            $user = $this->userService->getByIdOrNull($userId);

            if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
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
     * @param UserProductUpdated $userProductUpdated
     */
    public function handleUserProductUpdated(UserProductUpdated $userProductUpdated)
    {
        if (self::$disable) {
            return;
        }

        try {
            $userId = $userProductUpdated->getNewUserProduct()
                ->getUser()
                ->getId();
            $user = $this->userService->getByIdOrNull($userId);

            if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
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
     * @param UserProductDeleted $userProductDeleted
     */
    public function handleUserProductDeleted(UserProductDeleted $userProductDeleted)
    {
        if (self::$disable) {
            return;
        }

        try {
            $userId = $userProductDeleted->getUserProduct()
                ->getUser()
                ->getId();
            $user = $this->userService->getByIdOrNull($userId);

            if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
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
     * @param SubscriptionCreated $subscriptionCreated
     */
    public function handleSubscriptionCreated(SubscriptionCreated $subscriptionCreated)
    {
        if (self::$disable) {
            return;
        }

        try {
            if (!empty(
                $subscriptionCreated->getSubscription()
                    ->getUser() &&
                $subscriptionCreated->getSubscription()
                    ->getUser() instanceof User
            )) {
                $userId = $subscriptionCreated->getSubscription()
                    ->getUser()
                    ->getId();
                $user = $this->userService->getByIdOrNull($userId);

                if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
                    dispatch(
                        (new CustomerIoSyncUserByUserId($user))->delay(
                            Carbon::now()
                                ->addSeconds(3)
                        )
                    );

                    self::$alreadyQueuedUserIds[] = $user->id;
                }
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param SubscriptionUpdated $subscriptionUpdated
     */
    public function handleSubscriptionUpdated(SubscriptionUpdated $subscriptionUpdated)
    {
        if (self::$disable) {
            return;
        }

        $newSubscription = $subscriptionUpdated->getNewSubscription();

        try {
            $user = $newSubscription->getUser();

            if ($user instanceof EcommerceUser) {
                $userId = $newSubscription->getUser()
                    ->getId();
                $user = $this->userService->getByIdOrNull($userId);
            }

            if ($user instanceof User) {
                if (!in_array($user->id, self::$alreadyQueuedUserIds)) {
                    dispatch(
                        (new CustomerIoSyncUserByUserId($user))->delay(
                            Carbon::now()
                                ->addSeconds(3)
                        )
                    );

                    self::$alreadyQueuedUserIds[] = $user->id;
                }
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param AppSignupStartedEvent $appSignupStarted
     */
    public function handleAppSignupStarted(AppSignupStartedEvent $appSignupStarted)
    {
        if (self::$disable) {
            return;
        }

        try {
            // todo: sync event for this: brand_onboarding_app_sign-up-flow-started
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param AppSignupFinishedEvent $appSignupFinished
     */
    public function handleAppSignupFinished(AppSignupFinishedEvent $appSignupFinished)
    {
        if (self::$disable) {
            return;
        }

        try {
            // todo: sync event for this: brand_onboarding_app_sign-up-flow-finished
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param SubscriptionRenewed $subscriptionRenewed
     */
    public function handleSubscriptionRenewed(SubscriptionRenewed $subscriptionRenewed)
    {
        if (self::$disable) {
            return;
        }

        try {
            $this->syncSubscriptionRenew($subscriptionRenewed->getSubscription());
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param SubscriptionRenewFailed $subscriptionRenewFailed
     */
    public function handleSubscriptionRenewalAttemptFailed(SubscriptionRenewFailed $subscriptionRenewFailed)
    {
        if (self::$disable) {
            return;
        }

        if ($subscriptionRenewFailed->getSubscription()
                ->getIsActive() == false &&
            $subscriptionRenewFailed->getSubscription()
                ->getCanceledOn() == null &&
            $subscriptionRenewFailed->getSubscription()
                ->getStopped() == false &&
            $subscriptionRenewFailed->getSubscription()
                ->getPaidUntil() < Carbon::now()) {
            // todo
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
     * @param OrderEvent $orderEvent
     */
    public function handleOrderPlaced(OrderEvent $orderEvent)
    {
        if (self::$disable) {
            return;
        }

        try {
            $this->syncOrder($orderEvent->getOrder(), $orderEvent->getPayment());
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param PaymentEvent $paymentEvent
     */
    public function handlePaymentPaid(PaymentEvent $paymentEvent)
    {
        if (self::$disable) {
            return;
        }

        try {
            $this->syncPayment(
                $paymentEvent->getPayment(),
                $paymentEvent->getUser()
                    ->getId()
            );
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
                    $activityEvent->getBrand(),
                    $activityEvent->getBrand() . '_members_area_activity',
                    [],
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

    public function syncOrder($order, $payment)
    {
        try {
            if (!empty($order) && !empty(
                $order->getUser()
                )) {
                $productIds = [];

                foreach (
                    $order->getOrderItems() as $orderItem
                ) {
                    $productIds[] =
                        $orderItem->getProduct()
                            ->getId();
                }

                $data = [
                    'product_id' => $productIds,
                    'amount_paid' => $payment ? $payment->getTotalPaid() : $order->getTotalPaid(),
                    'amount_due' => $order->getTotalDue(),
                ];

                dispatch(
                    (new CustomerIoCreateEventByUserId(
                        $order->getUser()
                            ->getId(),
                        $order->getBrand(),
                        $order->getBrand() . '_user_order',
                        $data,
                        null,
                        $order->getCreatedAt()->timestamp
                    ))->delay(
                        Carbon::now()
                            ->addSeconds(30)
                    )
                );

                // trigger pack specific events
                $skuToEventNameMap = config('event-data-synchronizer.customer_io_pack_sku_to_purchase_event_name', []);

                foreach (
                    $order->getOrderItems() as $orderItem
                ) {
                    if (array_key_exists(
                        $orderItem->getProduct()
                            ->getSku(),
                        $skuToEventNameMap
                    )) {
                        dispatch(
                            (new CustomerIoCreateEventByUserId(
                                $order->getUser()
                                    ->getId(),
                                $order->getBrand(),
                                $order->getBrand() .
                                '_pack_' .
                                $skuToEventNameMap[$orderItem->getProduct()
                                    ->getSku()],
                                [
                                    'amount_paid' => $orderItem->getFinalPrice(),
                                ],
                                null,
                                $order->getCreatedAt()->timestamp
                            ))->delay(
                                Carbon::now()
                                    ->addSeconds(30)
                            )
                        );
                    }
                }
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param PaymentEvent $paymentEvent
     */
    public function syncPayment($payment, $userId)
    {
        try {
            if (!empty($payment) &&
                !empty($user) &&
                $payment->getTotalPaid() == $payment->getTotalDue() &&
                $payment->getTotalRefunded() == 0) {
                $order = $payment->getOrder();
                $subscription = $payment->getSubscription();

                $productIds = [];

                if (!empty($order)) { // order inital payment
                    foreach ($order->getOrderItems() as $orderItem) {
                        $productIds[] =
                            $orderItem->getProduct()
                                ->getId();
                    }
                } elseif (!empty($subscription) && !empty($subscription->getProduct())) { // membership renewal payment
                    $productIds[] =
                        $subscription->getProduct()
                            ->getId();
                } elseif (!empty($subscription) &&
                    // payment plan renewal payment
                    empty($subscription->getProduct()) &&
                    !empty($subscription->getOrder()) &&
                    $subscription->getType() == Subscription::TYPE_PAYMENT_PLAN) {
                    foreach (
                        $subscription->getOrder()
                            ->getOrderItems() as $orderItem
                    ) {
                        $productIds[] =
                            $orderItem->getProduct()
                                ->getId();
                    }
                }

                $data = [
                    'product_id' => $productIds,
                    'amount_paid' => $payment->getTotalPaid(),
                ];

                dispatch(
                    (new CustomerIoCreateEventByUserId(
                        $userId,
                        $payment->getGatewayName(),
                        $payment->getGatewayName() . '_user_payment',
                        $data,
                        null,
                        $payment->getCreatedAt()->timestamp
                    ))->delay(
                        Carbon::now()
                            ->addSeconds(30)
                    )
                );
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param $subscription
     */
    public function syncSubscriptionRenew($subscription)
    {
        try {
            if (!empty($subscription) && !empty($subscription->getUser())) {
                dispatch(
                    (new CustomerIoCreateEventByUserId(
                        $subscription->getUser()
                            ->getId(), $subscription->getBrand(), $subscription->getBrand() . '_membership_renewed', [
                        'membership_rate' => $subscription->getTotalPrice(),
                    ], null, $subscription->getCreatedAt()->timestamp
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
                    $emailInvite->getBrand() . config('event-data-synchronizer.customer_io_saasquatch_email_invite_event_name')
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
            dispatch((new CustomerIoSyncMentor($studentMentorsUpdated->mentorStudentData))
                ->delay(Carbon::now()->addSeconds(3)));
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }


    /**
     * @param AccessCodeClaimed $accessCodeClaimed
     */
    public function handleAccessCodeClaimed(AccessCodeClaimed $accessCodeClaimed)
    {
        $accessCode = $accessCodeClaimed->getAccessCode();
        $brand = $accessCode->getBrand();

        dispatch(
            (new CustomerIoCreateEventByUserId(
                $accessCodeClaimed->getUser()->getId(),
                $brand,
                'musora_membership_non_recurring_access_added',
                [
                    'brand_source' => $brand,
                    'access_method' => $accessCode->getCode(),
                    'access_source' => $accessCode->getSource(),
                    'access_added_timestamp' => $accessCode->getUpdatedAt()->timestamp,
                    'code_creation_date' => $accessCode->getCreatedAt()->timestamp,
                    'product_ids' => $accessCode->getProductIdsAsString()

                ], null, Carbon::now()->timestamp
            ))->delay(
                    Carbon::now()
                        ->addSeconds(3)
                )
        );

        //        dispatch(
        //            (new CustomerIoCreateEventByUserId(
        //                $accessCodeClaimed->getUser()->getId(),
        //                $brand,
        //                'musora_membership_access',
        //                [
        //                    'access_type' => 'manual_access_type',
        //                    'access_start_date' => '',
        //                    'access_expiration_date' => '',
        //
        //                ],
        //                null,
        //                Carbon::now()->timestamp
        //            ))
        //                ->delay(
        //                    Carbon::now()
        //                        ->addSeconds(3)
        //                )
        //        );
    }

    public function handleMobileOrderPlaced(MobileOrderEvent $mobileOrderEvent)
    {
        $latestPayment =
            ($mobileOrderEvent->getSubscription()
                ->getLatestPayment());
        $amountPaid = ($latestPayment) ? $latestPayment->getTotalPaid() : 0;
        $amountDue = ($latestPayment) ? $latestPayment->getTotalDue() : 0;
        $productIds =
            [
                $mobileOrderEvent->getSubscription()
                    ->getProduct()
                    ->getId(),
            ];

        $data = [
            'product_id' => $productIds,
            'amount_paid' => $amountPaid,
            'amount_due' => $amountDue,
        ];

        dispatch(
            (new CustomerIoCreateEventByUserId(
                $mobileOrderEvent->getSubscription()->getUser()
                    ->getId(),
                $mobileOrderEvent->getSubscription()->getBrand(),
                $mobileOrderEvent->getSubscription()->getBrand().'_user_order',
                $data,
                null,
                $mobileOrderEvent->getSubscription()->getCreatedAt()->timestamp
            ))->delay(
                Carbon::now()
                    ->addSeconds(30)
            )
        );
    }

    /**
     * @param ReferralClaimed $referralClaimed
     */
    public function handleReferralClaimed(ReferralClaimed $referralClaimed) {

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
                    'product_ids' => $referralClaimed->getProductId()
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

}
