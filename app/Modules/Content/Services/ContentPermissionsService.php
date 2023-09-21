<?php

namespace App\Modules\Content\Services;

use App\Modules\Content\Models\Permission;
use App\Modules\Content\Models\UserPermission;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ContentPermissionsService
{
    public function getAll(): Collection
    {
        return Permission::query()->get();
    }

    public function getUserPermissionsQuery(int $userId)
    {
        return UserPermission::query()->where('user_id', '=', $userId);
    }


}
