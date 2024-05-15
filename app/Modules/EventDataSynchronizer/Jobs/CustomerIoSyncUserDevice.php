<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use Exception;
use App\Modules\CustomerIO\Services\CustomerIoService;
use App\Modules\UserManagementSystem\Services\UserService;
use Throwable;

class CustomerIoSyncUserDevice extends CustomerIoBaseJob
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var string
     */
    private $accountName;

    /**
     * @var array
     */
    private $deviceData;

    /**
     * @var int|null
     */
    private $timestamp;

    /**
     * @param $userId
     * @param $accountName
     * @param $deviceData
     * @param null $timestamp
     */
    public function __construct(
        $userId,
        $accountName,
        $deviceData,
        $timestamp = null
    ) {
        $this->userId = $userId;
        $this->accountName = $accountName;
        $this->deviceData = $deviceData;
        $this->timestamp = $timestamp;
    }

    /**
     * @param CustomerIoService $customerIoService
     * @param UserService $userService
     * @throws \Throwable
     */
    public function handle(
        CustomerIoService $customerIoService,
        UserService $userService
    ) {
        try {
            $user = $userService->GetByIdOrNull($this->userId);

            $customerIoService->syncDeviceForUserId(
                $user->id,
                $this->accountName,
                $this->deviceData,
                $this->timestamp
            );

        } catch (Exception $exception) {
            $this->failed($exception);
        }
    }

    /**
     * The job failed to process.
     *
     * @param Throwable $exception
     */
    public function failed(Throwable $exception)
    {
        error_log(
            'Error on CustomerIoSyncUserDevice job trying to sync user device to customer.io. User ID: ' .
            $this->userId
        );

        error_log($exception);

        parent::failed($exception);
    }
}
