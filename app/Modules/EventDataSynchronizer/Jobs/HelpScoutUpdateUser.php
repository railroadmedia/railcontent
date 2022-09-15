<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\HelpScout\Services\HelpScoutService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Modules\EventDataSynchronizer\Services\HelpScoutSyncService;
use Modules\UserManagementSystem\Models\User;
use App\Modules\UserManagementSystem\Services\UserService;

class HelpScoutUpdateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param  HelpScoutSyncService $helpScoutSyncService
     * @param  HelpScoutService $helpScoutService
     * @param  UserService $userService
     *
     * @throws \Throwable
     */
    public function handle(
        HelpScoutSyncService $helpScoutSyncService,
        HelpScoutService $helpScoutService,
        UserService $userService
    ) {
        try {
            $this->user = $userService->GetByIdOrNull($this->user->id);

            $userAttributes = $helpScoutSyncService->getUsersAttributes($this->user);
            $brandsAttributesKeys = $helpScoutSyncService->getBrandsMembershipAttributesKeys();

            $helpScoutService->createOrUpdateCustomer(
                $this->user->id,
                $this->user->first_name,
                $this->user->last_name,
                $this->user->email,
                $userAttributes,
                $brandsAttributesKeys
            );
        } catch (Exception $exception) {
            $this->failed($exception);
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     */
    public function failed(Exception $exception)
    {
        error_log(
            'Error on HelpScoutUpdateUser job trying to sync user to helpscout. User ID: '.
            $this->user->id.' - lookupEmail: '.$this->user->email
        );

        error_log($exception);
    }
}
