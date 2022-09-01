<?php

namespace App\Modules\Mentor\tests\Feature\Services;

use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;
use Mockery\MockInterface;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use App\Modules\Mentor\Services\ActiveStudentService;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class ActiveStudentServiceTest extends TestCase
{
    private ActiveStudentService $activeStudentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->activeStudentService = app(ActiveStudentService::class);
    }

    public function test_is_active_subscription(): void
    {
        /** @var User $user */
        $user = User::factory()->hasSubscription()->create();

        $active = $this->activeStudentService->isActive($user->id);
        $this->assertTrue($active);
    }

    public function test_is_active_user_product(): void
    {
        /** @var User $user */
        $user = User::factory()->hasUserProduct()->create();

        $active = $this->activeStudentService->isActive($user->id);
        $this->assertTrue($active);
    }

    public function test_is_not_active(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $active = $this->activeStudentService->isActive($user->id);
        $this->assertFalse($active);
    }


}
