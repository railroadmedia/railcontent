<?php

namespace App\Modules\Content\Services;

use App\Modules\Content\Models\Permission;
use App\Modules\Content\Models\UserPermission;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ContentPermissionsService
{
    public function getAll(): Collection
    {
        return Permission::query()->get();
    }

    public function getByBrand($brand): Collection
    {
        return Permission::query()->where('brand', '=', $brand)->get();
    }

    public function getUserPermissions(int $userId): Collection
    {
        return UserPermission::query()->where('user_id', '=', $userId)->get();
    }

    public function getContentPermissionsLookup(): Collection
    {
        return $this->getAll()->keyBy(function ($permission) {
            return $permission->brand . '_' . $permission->name;
        });
    }
}
