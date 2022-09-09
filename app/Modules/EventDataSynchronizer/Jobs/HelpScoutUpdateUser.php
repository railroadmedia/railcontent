<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Modules\EventDataSynchronizer\Services\HelpScoutSyncService;
use Railroad\Usora\Entities\User;
use Railroad\Usora\Repositories\UserRepository;

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
     * @param  UserRepository $userRepository
     *
     * @throws \Throwable
     */
    public function handle(
        HelpScoutSyncService $helpScoutSyncService,
        HelpScoutService $helpScoutService,
        UserRepository $userRepository
    ) {
        try {
            $this->user = $userRepository->find($this->user->getId());

            $userAttributes = $helpScoutSyncService->getUsersAttributes($this->user);
            $brandsAttributesKeys = $helpScoutSyncService->getBrandsMembershipAttributesKeys();

            $helpScoutService->createOrUpdateCustomer(
                $this->user->getId(),
                $this->user->getFirstName(),
                $this->user->getLastName(),
                $this->user->getEmail(),
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
            $this->user->getId().' - lookupEmail: '.$this->user->getEmail()
        );

        error_log($exception);
    }
}
