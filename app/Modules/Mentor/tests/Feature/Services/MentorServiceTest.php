<?php

namespace App\Modules\Mentor\tests\Feature\Services;

use App\Modules\Mentor\tests\Services\UserManagementSystemTestCase;
use Modules\UserManagementSystem\Models\User;
use Tests\GeneralTestCase;

class MentorServiceTest extends UserManagementSystemTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

    }

    public function test_auto_assign_mentor()
    {
        $user = User::factory()->make();
$this->ass
    }
}
