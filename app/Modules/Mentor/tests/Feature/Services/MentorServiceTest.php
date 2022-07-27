<?php

namespace App\Modules\Mentor\tests\Feature\Services;

use App\Modules\Mentor\Services\MentorService;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class MentorServiceTest extends TestCase
{

    private MentorService $mentorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mentorService = app(MentorService::class);
    }

    public function test_assign_mentor()
    {
        $user = User::factory()->create();
        $this->assertFalse($this->mentorService->hasMentor($user->id));
        $this->mentorService->assignMentor($user->id);
        $this->assertTrue($this->mentorService->hasMentor($user->id));
    }
}
