<?php

namespace App\Modules\Content\Services;

use App\Modules\Content\Models\Permission;
use App\Modules\Content\Models\UserPermission;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PermissionsService
{
    public function getAll(): Collection
    {
        return Permission::query()->get();
    }

    public function syncPermissions(int $userId, array $userPermissions): void
    {
        $existingPermissions = UserPermission::query()->where('user_id', '=', $userId)
            ->whereIn('permission_id', array_keys($userPermissions))->get()->keyBy('permission_id');

        foreach ($userPermissions as $permissionId => $dates) {
            $expirationDate = $dates['expiration_date'];
            $startDate = $dates['start_date'] ?? Carbon::now();

            $existingPermission = $existingPermissions[$permissionId] ?? null;
            $now = Carbon::now();
            if (!$existingPermission) {
                $existingPermission = new UserPermission();
                $existingPermission->user_id = $userId;
                $existingPermission->permission_id = $permissionId;
                $existingPermission->created_on = $now;
            }
            $existingPermission->start_date = $startDate;
            $existingPermission->expiration_date = $expirationDate;
            $existingPermissions->updated_on = $now;
            $existingPermission->save();
        }
    }

}
