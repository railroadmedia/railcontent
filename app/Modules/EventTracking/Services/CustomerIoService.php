<?php

namespace App\Modules\EventTracking\Services;

use App\Modules\CustomerIO\Models\Customer;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncNewUserByEmail;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class CustomerIoService
{
    /**
     * @param User $user
     * @return array
     */
    public function getCioIdsForUser(User $user): array
    {
        try {
            $customerIoProfileIds = $this->getCustomerIoProfilesForUser($user);
        } catch (Throwable) {
            dispatch_sync(new CustomerIoSyncNewUserByEmail($user));
            sleep(5);

            $customerIoProfileIds = $this->getCustomerIoProfilesForUser($user);
        }

        return [
            'cio_id_musora' => $customerIoProfileIds['musora'],
            'cio_id_drumeo' => $customerIoProfileIds['drumeo'],
            'cio_id_singeo' => $customerIoProfileIds['singeo'],
            'cio_id_pianote' => $customerIoProfileIds['pianote'],
            'cio_id_guitareo' => $customerIoProfileIds['guitareo']
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    private function getCustomerIoProfilesForUser(User $user): array
    {
        return [
            'musora' => $this->getCustomerIoProfileForUser($user, 'musora')->uuid,
            'drumeo' => $this->getCustomerIoProfileForUser($user, 'drumeo')->uuid,
            'singeo' => $this->getCustomerIoProfileForUser($user, 'singeo')->uuid,
            'pianote' => $this->getCustomerIoProfileForUser($user, 'pianote')->uuid,
            'guitareo' => $this->getCustomerIoProfileForUser($user, 'guitareo')->uuid
        ];
    }

    /**
     * @param User $user
     * @param string $workspaceName
     * @return Customer
     */
    private function getCustomerIoProfileForUser(User $user, string $workspaceName): Customer
    {
        return Customer::query()
            ->orWhere(function ($query) use ($user) {
                $query->where('user_id', '=', $user->id)
                    ->where('email', '=', $user->email);
            })
            ->where('workspace_name', '=', $workspaceName)
            ->orderBy('created_at')
            ->firstOrFail();
    }
}
