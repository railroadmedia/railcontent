<?php

namespace App\Modules\Mentor\tests\Feature\Services;

use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class ActiveStudentTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_is_active_subscription(): void
    {
        /** @var User $user */
        $user = User::factory()->hasActiveMembership(100)->create();

        $active = $user->isActiveStudent();
        $this->assertTrue($active);

        Carbon::setTestNow(Carbon::now()->addDays(150));

        $active = $user->isActiveStudent();
        $this->assertFalse($active);
    }


}
