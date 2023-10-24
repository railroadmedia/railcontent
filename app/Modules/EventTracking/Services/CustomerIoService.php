<?php

namespace App\Modules\EventTracking\Services;

use App\Modules\CustomerIO\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Modules\UserManagementSystem\Models\User;

class CustomerIoService
{
    /**
     * @param User $user
     * @return array
     */
    public function getCioIdsForUser(User $user): array
    {
        /** @var Collection $profiles */
        $profiles = Customer::query()
            ->orWhere(function ($query) use ($user) {
                $query->where('user_id', '=', $user->id)
                    ->where('email', '=', $user->email);
            })
            ->orderBy('updated_at', 'desc')->get();

        return [
            'musora' => $profiles->filter(fn($profile) => $profile->workspace_name === 'musora')->first(
                )?->uuid ?? null,
            'drumeo' => $profiles->filter(fn($profile) => $profile->workspace_name === 'drumeo')->first(
                )?->uuid ?? null,
            'pianote' => $profiles->filter(fn($profile) => $profile->workspace_name === 'pianote')->first(
                )?->uuid ?? null,
            'singeo' => $profiles->filter(fn($profile) => $profile->workspace_name === 'singeo')->first(
                )?->uuid ?? null,
            'guitareo' => $profiles->filter(fn($profile) => $profile->workspace_name === 'guitareo')->first(
                )?->uuid ?? null
        ];
    }
}
