<?php

namespace App\Modules\EventTracking\Services;

use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use App\Modules\CustomerIO\Models\Customer;
use App\Modules\CustomerIO\Services\CustomerIoService as LegacyCustomerIoService;
use Illuminate\Database\Eloquent\Collection;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class CustomerIoService
{
    private LegacyCustomerIoService $customerIoService;

    public function __construct()
    {
        $this->customerIoService = new LegacyCustomerIoService(new CustomerIoApiGateway());
    }

    /**
     * @param User $user
     * @return array
     */
    public function getCioIdsForUser(User $user): array
    {
        $profiles = $this->getUserProfiles($user);

        return [
            'cio_id_musora' => $profiles->filter(fn($profile) => $profile->workspace_name === 'musora')->first(
                )?->uuid ?? null,
            'cio_id_drumeo' => $profiles->filter(fn($profile) => $profile->workspace_name === 'drumeo')->first(
                )?->uuid ?? null,
            'cio_id_pianote' => $profiles->filter(fn($profile) => $profile->workspace_name === 'pianote')->first(
                )?->uuid ?? null,
            'cio_id_singeo' => $profiles->filter(fn($profile) => $profile->workspace_name === 'singeo')->first(
                )?->uuid ?? null,
            'cio_id_guitareo' => $profiles->filter(fn($profile) => $profile->workspace_name === 'guitareo')->first(
                )?->uuid ?? null
        ];
    }

    /**
     * @param User $user
     * @param array $customAttributes
     * @return void
     * @throws Throwable
     */
    public function updateUserAttributes(User $user, array $customAttributes = []): void
    {
        $this->getUserProfiles($user)
            ->each(function (Customer $profile) use ($user, $customAttributes) {
                $this->customerIoService->createOrUpdateCustomerByUserId(
                    $user->id,
                    $profile->workspace_name,
                    $user->email,
                    $customAttributes,
                );
            });
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function getUserProfiles(User $user): Collection
    {
        return Customer::query()
            ->orWhere(function ($query) use ($user) {
                $query->where('user_id', '=', $user->id)
                    ->where('email', '=', $user->email);
            })
            ->orderBy('updated_at', 'desc')->get();
    }
}
