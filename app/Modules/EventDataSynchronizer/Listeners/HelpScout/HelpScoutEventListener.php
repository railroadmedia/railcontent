<?php

namespace App\Modules\EventDataSynchronizer\Listeners\HelpScout;

use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use App\Modules\Ecommerce\Events\UserProductsUpdated;
use Carbon\Carbon;
use Railroad\Ecommerce\Entities\User as EcommerceUser;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionCreated;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionRenewed;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionRenewFailed;
use Railroad\Ecommerce\Events\Subscriptions\SubscriptionUpdated;
use Railroad\Ecommerce\Events\UserProducts\UserProductCreated;
use Railroad\Ecommerce\Events\UserProducts\UserProductDeleted;
use Railroad\Ecommerce\Events\UserProducts\UserProductUpdated;
use App\Modules\EventDataSynchronizer\Jobs\HelpScoutUpdateUser;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use Modules\UserManagementSystem\Models\User;
use App\Modules\UserManagementSystem\Services\UserService;
use Throwable;

class HelpScoutEventListener
{
    /**
     * @var bool
     */
    public static bool $disable = false;

    /**
     * @var array
     */
    public static array $alreadyQueuedUserIds = [];
    private UserService $userService;

    /**
     * HelpScoutEventListener constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
            $user = $this->userService->getByEmailOrNull($userCreated->getUser()->id);

            if (!empty($user) && !in_array($userCreated->getUser()->id, self::$alreadyQueuedUserIds)) {
                dispatch(
                    (new HelpScoutUpdateUser($user))
                        ->delay(Carbon::now()->addSeconds(3))
                );

                self::$alreadyQueuedUserIds[] = $userCreated->getUser()->id;
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
            $user = $this->userService->getByEmailOrNull($userUpdated->getNewUser()->id);

            if (!empty($user) && !in_array($userUpdated->getNewUser()->id, self::$alreadyQueuedUserIds)) {
                dispatch(
                    (new HelpScoutUpdateUser($user))
                        ->delay(Carbon::now()->addSeconds(3))
                );

                self::$alreadyQueuedUserIds[] = $userUpdated->getNewUser()->id;
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param  UserProductCreated  $userProductCreated
     */
    public function handleUserProductCreated(UserProductCreated $userProductCreated)
    {
        if (self::$disable) {
            return;
        }

        try {
            $user = $this->userService->getByEmailOrNull(
                $userProductCreated->getUserProduct()
                    ->getUser()
                    ->getId()
            );

            if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
                dispatch(
                    (new HelpScoutUpdateUser($user))
                        ->delay(Carbon::now()->addSeconds(3))
                );

                self::$alreadyQueuedUserIds[] = $user->id;
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param  UserProductUpdated  $userProductUpdated
     */
    public function handleUserProductUpdated(UserProductUpdated $userProductUpdated)
    {
        if (self::$disable) {
            return;
        }

        try {
            $user = $this->userService->getByEmailOrNull(
                $userProductUpdated->getNewUserProduct()
                    ->getUser()
                    ->getId()
            );

            if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
                dispatch(
                    (new HelpScoutUpdateUser($user))
                        ->delay(Carbon::now()->addSeconds(3))
                );

                self::$alreadyQueuedUserIds[] = $user->id;
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    /**
     * @param  UserProductDeleted  $userProductDeleted
     */
    public function handleUserProductDeleted(UserProductDeleted $userProductDeleted)
    {
        if (self::$disable) {
            return;
        }

        try {
            $user = $this->userService->getByEmailOrNull(
                $userProductDeleted->getUserProduct()
                    ->getUser()
                    ->getId()
            );

            if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
                dispatch(
                    (new HelpScoutUpdateUser($user))
                        ->delay(Carbon::now()->addSeconds(3))
                );
                self::$alreadyQueuedUserIds[] = $user->id;
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }

    public function handleUserAccessPermissionsUpdated(UserAccessPermissionsUpdated $userAccessPermissionsUpdated)
    {
        if (self::$disable) {
            return;
        }

        try {
            //help scout syncing has never worked due to this code, may leave this for rudderstack integration
            $userId = $userAccessPermissionsUpdated->getUserId();
            $user = $this->userService->getByEmailOrNull($userId);

            if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
                dispatch(
                    (new HelpScoutUpdateUser($user))
                        ->delay(Carbon::now()->addSeconds(3))
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
                $user = $this->userService->getByEmailOrNull(
                    $subscriptionCreated->getSubscription()
                        ->getUser()
                        ->getId()
                );

                if (!empty($user) && !in_array($user->id, self::$alreadyQueuedUserIds)) {
                    dispatch(
                        (new HelpScoutUpdateUser($user))
                            ->delay(Carbon::now()->addSeconds(3))
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
                $user = $this->userService->getByEmailOrNull($user->getId());
            }

            if ($user instanceof User) {
                if (!in_array($user->id, self::$alreadyQueuedUserIds)) {
                    dispatch(
                        (new HelpScoutUpdateUser($user))
                            ->delay(Carbon::now()->addSeconds(3))
                    );

                    self::$alreadyQueuedUserIds[] = $user->id;
                }
            }
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
            if (!empty($subscriptionRenewed->getSubscription()) &&
                !empty($subscriptionRenewed->getSubscription()->getUser())) {
                $user = $subscriptionRenewed->getSubscription()->getUser();

                if ($user instanceof EcommerceUser) {
                    $user = $this->userService->getByEmailOrNull($user->getId());
                }

                if ($user instanceof User) {
                    if (!in_array($user->id, self::$alreadyQueuedUserIds)) {
                        dispatch(
                            (new HelpScoutUpdateUser($user))
                                ->delay(Carbon::now()->addSeconds(3))
                        );

                        self::$alreadyQueuedUserIds[] = $user->id;
                    }
                }
            }
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

        try {
            if (!empty($subscriptionRenewFailed->getSubscription()) &&
                !empty($subscriptionRenewFailed->getSubscription()->getUser())) {
                $user = $subscriptionRenewFailed->getSubscription()->getUser();

                if ($user instanceof EcommerceUser) {
                    $user = $this->userService->getByEmailOrNull($user->getId());
                }

                if ($user instanceof User) {
                    if (!in_array($user->id, self::$alreadyQueuedUserIds)) {
                        dispatch(
                            (new HelpScoutUpdateUser($user))
                                ->delay(Carbon::now()->addSeconds(3))
                        );

                        self::$alreadyQueuedUserIds[] = $user->id;
                    }
                }
            }
        } catch (Throwable $throwable) {
            error_log($throwable);
        }
    }
}
