<?php

namespace App\Modules\EventDataSynchronizer\tests\Feature;

use App\Enums\Interval;
use App\Modules\Content\database\factories\PermissionFactory;
use App\Modules\Content\Models\ContentField;
use App\Modules\Content\Models\Instructor;
use App\Modules\Ecommerce\database\factories\ProductFactory;
use App\Modules\Ecommerce\database\factories\UserAccessPermissionsFactory;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\EventDataSynchronizer\Services\UserMembershipFieldsService;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class UserMembershipFieldsServiceTest extends TestCase
{
    private const BUFFER_DAYS = 7;
    private UserMembershipFieldsService $userMembershipFieldsService;

    protected function setUp(): void
    {
        parent::setUp();
        PermissionFactory::ensureMembershipPermissionsExist();
        $this->userMembershipFieldsService = $this->app->make(UserMembershipFieldsService::class);
    }


    private function assertAccess(
        ?Carbon $membershipExpirationDate,
        ?string $membership_level,
        bool $isLifetimeMember,
        ?string $accessLevel,
        bool $isPackOwner
    ) {
        $this->assertDatabaseHas('usora_users', [
            'membership_expiration_date' => $membershipExpirationDate?->toDateTimeString(),
            'membership_level' => $membership_level,
            'is_lifetime_member' => $isLifetimeMember ? 1 : 0,
            'access_level' => $accessLevel,
            'is_pack_owner' => $isPackOwner ? 1 : 0,
        ]);
    }

    public function test_no_user()
    {
        $this->userMembershipFieldsService->sync(0);

        $this->assertDatabaseMissing('usora_users', [
            'membership_expiration_date' => null,
            'is_lifetime_member' => false,
            'access_level' => '',
        ]);
    }

    public function test_no_user_products()
    {
        $userId = User::factory()->create()->id;

        $this->userMembershipFieldsService->sync($userId);

        $this->assertAccess(null, null, false, '', false);
    }

    public function test_basic_monthly_membership_access()
    {
        $user = User::factory()->create();
        $product = ProductFactory::createSubscriptionProduct(
            'musora',
            DigitalAccessType::Basic,
            Interval::Month,
            100
        );
        $startDate = Carbon::now();
        $expirationDate = $startDate->clone()->addMonth()->addDays(self::BUFFER_DAYS);
        UserAccessPermissionsFactory::createPermissions($user, $product, $startDate);
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            $expirationDate,
            'basic',
            false,
            'member',
            false
        );
    }

    public function test_plus_monthly_membership_access()
    {
        $user = User::factory()->create();
        $product = ProductFactory::createSubscriptionProduct(
            'musora',
            DigitalAccessType::Plus,
            Interval::Month,
            100
        );
        $startDate = Carbon::now();
        $expirationDate = $startDate->clone()->addMonth()->addDays(self::BUFFER_DAYS);
        UserAccessPermissionsFactory::createPermissions($user, $product, $startDate);
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            $expirationDate,
            'plus',
            false,
            'member',
            false
        );
    }

    public function test_basic_annual_membership_access()
    {
        $user = User::factory()->create();
        $product = ProductFactory::createSubscriptionProduct(
            'musora',
            DigitalAccessType::Basic,
            Interval::Year,
            100
        );
        $startDate = Carbon::now();
        $expirationDate = $startDate->clone()->addYear()->addDays(self::BUFFER_DAYS);
        UserAccessPermissionsFactory::createPermissions($user, $product, $startDate);
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            $expirationDate,
            'basic',
            false,
            'member',
            false
        );
    }

    public function test_lifetime()
    {
        $user = User::factory()->create();
        $product = ProductFactory::createLifetimeProduct();
        $startDate = Carbon::now();
        $expirationDate = Carbon::maxValue();
        UserAccessPermissionsFactory::createPermissions($user, $product, $startDate);
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            $expirationDate,
            'basic',
            true,
            'lifetime',
            false
        );
    }

    public function test_lifetime_upgrade()
    {
        $user = User::factory()->create();
        $productLifetime = ProductFactory::createLifetimeProduct();
        $product = ProductFactory::createSubscriptionProduct(
            'musora',
            DigitalAccessType::Songs,
            Interval::Month,
            100
        );
        $startDate = Carbon::now();
        $expirationDate = Carbon::maxValue();
        UserAccessPermissionsFactory::createPermissions($user, $productLifetime, $startDate);
        UserAccessPermissionsFactory::createPermissions($user, $product, $startDate);
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            $expirationDate,
            'plus',
            true,
            'lifetime',
            false
        );
    }

    public function test_lifetime_revoked()
    {
        $user = User::factory()->create();
        $product = ProductFactory::createLifetimeProduct();
        $startDate = Carbon::now()->subDays(30);
        $revokedAt = $startDate->clone()->addDays(20);
        UserAccessPermissionsFactory::createPermissions(
            $user,
            $product,
            $startDate,
            [
                'status' => 'revoked',
                'revoked_at' => $revokedAt
            ]
        );
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            $revokedAt,
            null,
            false,
            'expired',
            false
        );
    }

    public function test_aggregate_membership_access()
    {
        $user = User::factory()->create();
        $product = ProductFactory::createSubscriptionProduct(
            'musora',
            DigitalAccessType::Basic,
            Interval::Month,
            100
        );
        $startDate = Carbon::now();
        $startDate2 = Carbon::now()->addDays(10);
        $expirationDate = $startDate->clone()->addMonths(2)->addDays(self::BUFFER_DAYS);
        UserAccessPermissionsFactory::createPermissions($user, $product, $startDate);
        UserAccessPermissionsFactory::createPermissions($user, $product, $startDate2);
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            $expirationDate,
            'basic',
            false,
            'member',
            false
        );
    }

    public function test_expired()
    {
        $user = User::factory()->create();
        $product = ProductFactory::createSubscriptionProduct(
            'musora',
            DigitalAccessType::Basic,
            Interval::Month,
            100
        );
        $startDate = Carbon::now()->addDays(-40);
        $expirationDate = $startDate->clone()->addMonth(1)->addDays(self::BUFFER_DAYS);
        UserAccessPermissionsFactory::createPermissions($user, $product, $startDate);
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            $expirationDate,
            null,
            false,
            'expired',
            false
        );
    }

    public function test_pack_owner()
    {
        $user = User::factory()->create();
        $product = ProductFactory::createPackProduct();
        $startDate = Carbon::now()->subDays(30);
        UserAccessPermissionsFactory::createPermissions(
            $user,
            $product,
            $startDate
        );
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            null,
            null,
            false,
            'pack',
            true
        );
    }

    public function test_admin_team()
    {
        $user = User::factory()->create(['permission_level' => 'administrator']);
        $product = ProductFactory::createLifetimeProduct();
        $startDate = Carbon::now()->subDays(30);
        UserAccessPermissionsFactory::createPermissions(
            $user,
            $product,
            $startDate
        );
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            Carbon::maxValue(),
            'basic',
            true,
            'team',
            false
        );
    }

    public function test_coach()
    {
        $user = User::factory()->create(['permission_level' => 'administrator']);
        $instructor = Instructor::factory()->create();
        ContentField::factory()->create([
            'content_id' => $instructor->id,
            'key' => 'associated_user_id',
            'value' => $user->id,
            'type' => 'string',
            'position' => 1
        ]);

        $product = ProductFactory::createLifetimeProduct();
        $startDate = Carbon::now()->subDays(30);
        UserAccessPermissionsFactory::createPermissions(
            $user,
            $product,
            $startDate
        );
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            Carbon::maxValue(),
            'basic',
            true,
            'coach',
            false
        );
    }

    public function test_house_coach()
    {
        $user = User::factory()->create(['permission_level' => 'administrator']);
        $instructor = Instructor::factory()->create();
        ContentField::factory()->create([
            'content_id' => $instructor->id,
            'key' => 'associated_user_id',
            'value' => $user->id,
            'type' => 'string',
            'position' => 1
        ]);
        ContentField::factory()->create([
            'content_id' => $instructor->id,
            'key' => 'is_house_coach',
            'value' => true,
            'type' => 'boolean',
            'position' => 1
        ]);

        $product = ProductFactory::createLifetimeProduct();
        $startDate = Carbon::now()->subDays(30);
        UserAccessPermissionsFactory::createPermissions(
            $user,
            $product,
            $startDate
        );
        $this->userMembershipFieldsService->sync($user->id);

        $this->assertAccess(
            Carbon::maxValue(),
            'basic',
            true,
            'coach',
            false
        );
    }

}
