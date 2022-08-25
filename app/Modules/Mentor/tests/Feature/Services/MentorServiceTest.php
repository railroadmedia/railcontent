<?php

namespace App\Modules\Mentor\tests\Feature\Services;

use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\MentorService;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class MentorServiceTest extends TestCase
{

    private MentorService $mentorService;

    public function createMentor(string $brand) :Mentor
    {
        $mentor = Mentor::factory()->create([
            'supported_brands' => $brand
        ]);
        return $mentor;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->mentorService = app(MentorService::class);
    }

    public function assertHasMentor(User $user, Mentor $mentor): void
    {
        $this->assertDatabaseHas('mentor_students', [
            'user_id' => $user->id,
            'mentor_user_id' => $mentor->user_id
        ]);
    }

    public function assertMentorCount(Mentor $mentor, int $count): void
    {
        $this->assertDatabaseHas('mentors', [
            'user_id' => $mentor->user_id,
            'active_student_count' => $count
        ]);
    }

    public function test_assign_mentor()
    {
        $brand = 'drumeo';
        $mentor = $this->createMentor($brand);
        $user = User::factory()->create();

        $this->mentorService->assignMentorByBrand($user->id, $brand);
        $this->assertHasMentor($user, $mentor);
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

        $this->assertHasMentor($user3, $mentor);
        $this->assertMentorCount($mentor, 3);
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
        $this->assertHasMentor($user, $mentor);
        $this->assertMentorCount($mentor, 2);
        $mentor2 = $this->createMentor($brand);
        $this->assertMentorCount($mentor2, 0);

        $this->mentorService->delete($mentor->user_id);
        $this->assertHasMentor($user, $mentor2);
        $this->assertMentorCount($mentor2, 2);
    }
}
