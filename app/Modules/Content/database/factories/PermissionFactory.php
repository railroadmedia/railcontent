<?php

namespace App\Modules\Content\database\factories;

use App\Modules\Content\Models\Permission;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    public const TestPackPermissionId = 154310;
    public const TestPackName = "Test Pack";
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'brand' => 'drumeo',
        ];
    }

    public static function ensureMembershipPermissionsExist(): void
    {
        if (Permission::all()->count() > 0) {
            return;
        }
        Permission::factory()->create([
            'id' => UserAccessPermissionsCollection::MusoraBasicMembershipPermission,
            'name' => 'Musora Basic Membership',
            'brand' => 'musora'
        ]);
        Permission::factory()->create([
            'id' => UserAccessPermissionsCollection::MusoraPlusMembershipPermission,
            'name' => 'Musora Plus Membership',
            'brand' => 'musora'
        ]);
        Permission::factory()->create([
            'id' => UserAccessPermissionsCollection::SongsOnlyMembershipPermission,
            'name' => 'Musora Only Songs Membership',
            'brand' => 'musora'
        ]);

        Permission::factory()->create([
            'id' => self::TestPackPermissionId,
            'name' => self::TestPackName,
            'brand' => 'musora'
        ]);

        Permission::factory()->create([
            'id' => UserAccessPermissionsCollection::DrumeoLifetimePermission,
            'name' => 'Drumeo Lifetime Member',
            'brand' => 'drumeo'
        ]);
    }
}
