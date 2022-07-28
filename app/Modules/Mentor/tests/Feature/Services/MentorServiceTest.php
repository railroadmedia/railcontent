<?php

namespace App\Modules\Mentor\tests\Feature\Services;

use App\Modules\Brand\Enums\Brand;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\MentorService;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class MentorServiceTest extends TestCase
{

    private MentorService $mentorService;

    public function createMentor(string $brand) :Mentor
    {
        $user = User::factory()->create();
        $mentor = Mentor::factory()->create([
            'user_id' => $user->id,
            'supported_brands' => $brand
        ]);
        return $mentor;
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->mentorService = app(MentorService::class);
    }

    public function test_assign_mentor()
    {
        $brand = 'drumeo';
        $mentor = $this->createMentor($brand);
        $user = User::factory()->create();

        $this->assertFalse($this->mentorService->hasMentor($user->id));
        $this->mentorService->assignMentorByBrand($user->id, $brand);
        $this->assertTrue($this->mentorService->hasMentor($user->id));
    }

    public function test_mentor_student_count()
    {
        $brand = 'drumeo';
        $mentor = $this->createMentor($brand);
        $user = User::factory()->create();
        $this->mentorService->assignMentorByBrand($user->id, $brand);
        $user2 = User::factory()->create();
        $this->mentorService->assignMentorByBrand($user2->id, $brand);
        $user3 = User::factory()->create();
        $this->mentorService->assignMentorByBrand($user3->id, $brand);
        $this->assertEquals(3, $user3->mentorStudent->mentor->active_student_count);
    }

    /** @var User $user */
    public function test_delete_mentor()
    {
        $brand = 'drumeo';
        $mentor = $this->createMentor($brand);
        $user = User::factory()->create();
        $this->mentorService->assignMentorByBrand($user->id, $brand);
        $user = User::factory()->create();
        $this->mentorService->assignMentorByBrand($user->id, $brand);

        $mentor2 = $this->createMentor($brand);

        $this->mentorService->delete($mentor->user_id);
        $this->assertTrue($this->mentorService->hasMentor($user->id));
        $this->assertTrue($mentor2->is($user->mentorStudent->mentor));
        $this->assertEquals(2, $user->mentorStudent->mentor->active_student_count);

    }
}
