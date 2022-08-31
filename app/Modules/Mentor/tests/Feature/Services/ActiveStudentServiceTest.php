<?php

namespace App\Modules\Mentor\tests\Feature\Services;

use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserProduct;
use Modules\Mentor\Services\ActiveStudentService;
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
        $user = User::factory()->create();
        $subscription = Subscription::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($this->activeStudentService->isActive($user->id));
    }

    public function test_is_active_user_product(): void
    {
        $user = User::factory()->create();
        $userProduct = UserProduct::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($this->activeStudentService->isActive($user->id));
    }

    public function test_is_not_active(): void
    {
        $user = User::factory()->create();

        $this->assertFalse($this->activeStudentService->isActive($user->id));
    }


}
