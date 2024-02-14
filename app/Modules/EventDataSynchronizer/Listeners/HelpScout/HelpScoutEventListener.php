<?php

namespace App\Modules\EventDataSynchronizer\Listeners\HelpScout;

use App\Modules\Ecommerce\Events\UserAccessPermissionsUpdated;
use Carbon\Carbon;
use App\Modules\EventDataSynchronizer\Jobs\HelpScoutUpdateUser;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Events\User\UserUpdated;
use App\Modules\UserManagementSystem\Services\UserService;
use Throwable;

class HelpScoutEventListener
{
    public static bool $disable = false;
    public static array $alreadyQueuedUserIds = [];
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handleUserCreated(UserCreated $userCreated): void
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

    public function handleUserUpdated(UserUpdated $userUpdated): void
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

    public function handleUserAccessPermissionsUpdated(UserAccessPermissionsUpdated $userAccessPermissionsUpdated): void
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
            Log::error($throwable);
        }
    }
}
