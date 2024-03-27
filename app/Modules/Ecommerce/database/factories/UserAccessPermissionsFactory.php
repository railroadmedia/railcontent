<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Enums\Interval;
use App\Modules\Content\database\factories\PermissionFactory;
use App\Modules\Content\Models\Permission;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use phpDocumentor\Reflection\Types\Self_;

class UserAccessPermissionsFactory extends Factory
{
    protected $model = UserAccessPermission::class;
    private static ?Collection $cachedPermissions = null;

    public function definition(): array
    {
        return [
            'source' => 'manual',
            'source_hash' => uniqid(),
            'start_time' => Carbon::now(),
            'time_minutes' => 0,
            'time_days' => 0,
            'time_months' => 0,
            'time_lifetime' => 0,
            'time_fixed' => null,
            'status' => 'active',
            'manually_revoked' => 0,
            'created_at' => Carbon::now()
                ->toDateTimeString(),
        ];
    }

    public static function createPermissions(
        User $user,
        Product $product,
        Carbon $startTime,
        array $attributes = []
    ): Collection {
        $permissions = collect();
        foreach (self::getPermissionIds($product) as $permissionId) {
            $attributes = array_merge($attributes, [
                'user_id' => $user->id,
                'product_id' => $product->id,
                'permission_id' => $permissionId,
                'start_time' => $startTime,
                'time_days' => $product->getMembershipTimeDays(),
                'time_months' => $product->getMembershipTimeMonths(),
                'time_lifetime' => $product->isLifeTime(),
            ]);
            $permission = UserAccessPermission::factory()->create($attributes);
            $permissions->push($permission);
        }
        return $permissions;
    }

    private static function getPermissionIds(Product $product): array
    {
        if (self::$cachedPermissions == null) {
            PermissionFactory::ensureMembershipPermissionsExist();
            self::$cachedPermissions = Permission::all()->keyBy('name');
        }

        $permissionNames = collect($product->getDigitalAccessPermissionNames());
        return $permissionNames->map(function ($permissionName) {
            if (!self::$cachedPermissions->has($permissionName)) {
                throw new \Exception("Permission not found: $permissionName");
            }
            return self::$cachedPermissions[$permissionName]->id;
        })->toArray();
    }

}
