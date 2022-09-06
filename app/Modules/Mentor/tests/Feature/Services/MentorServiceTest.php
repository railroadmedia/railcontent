<?php

namespace App\Modules\Mentor\tests\Feature\Services;

use App\Modules\Mentor\Events\StudentMentorsUpdated;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\MentorService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Modules\UserManagementSystem\Models\User;
use Tests\TestCase;

class MentorServiceTest extends TestCase
{

    private MentorService $mentorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mentorService = app(MentorService::class);
        Event::fake();
    }


    public function createMentor(string $brand): Mentor
    {
        $mentor = Mentor::factory()->create([
            'supported_brands' => $brand
        ]);
        return $mentor;
    }


    public function assertHasMentor(User $user, Mentor $mentor): void
    {
        $this->assertDatabaseHas('mentor_students', [
            'user_id' => $user->id,
            'mentor_user_id' => $mentor->user_id
        ]);
    }

    public function assertMentorCount(Mentor $mentor, int $activeCount, int $totalCount): void
    {
        $this->assertDatabaseHas('mentors', [
            'user_id' => $mentor->user_id,
            'active_student_count' => $activeCount,
            'total_student_count' => $totalCount
        ]);
    }

    public function test_assign_mentor()
    {
        $brand = 'drumeo';
        $mentor = $this->createMentor($brand);
        $user = User::factory()->create();

        $this->mentorService->assignMentorByBrand($user->id, $brand);
        Event::assertDispatched(StudentMentorsUpdated::class);
        $this->assertHasMentor($user, $mentor);
    }

    public function test_mentor_student_count()
    {
        $brand = 'drumeo';
        $mentor = $this->createMentor($brand);


        //create 3 users, 2 active, 1 not
        $user = User::factory()->create();
        $this->mentorService->assignMentorByBrand($user->id, $brand);
        $user2 = User::factory()->hasActiveMembership()->create();
        $this->mentorService->assignMentorByBrand($user2->id, $brand);
        $user3 = User::factory()->hasActiveMembership()->create();
        $this->mentorService->assignMentorByBrand($user3->id, $brand);
        Event::assertDispatched(StudentMentorsUpdated::class, 3);

        $this->assertHasMentor($user3, $mentor);
        $this->assertMentorCount($mentor, 2, 3);
    }

    /** @var User $user */
    public function test_delete_mentor()
    {
        $brand = 'drumeo';
        $mentor = $this->createMentor($brand);
        //create 3 users, 2 active, 1 not
        $this->mentorService->assignMentorByBrand(User::factory()->create()->id, $brand);
        $this->mentorService->assignMentorByBrand(User::factory()->hasActiveMembership()->create()->id, $brand);
        $user = User::factory()->hasActiveMembership()->create();
        $this->mentorService->assignMentorByBrand($user->id, $brand);
        Event::assertDispatched(StudentMentorsUpdated::class, 3);

        $this->assertHasMentor($user, $mentor);
        $this->assertMentorCount($mentor, 2, 3);
        $mentor2 = $this->createMentor($brand);
        $this->assertMentorCount($mentor2, 0, 0);

        $this->mentorService->delete($mentor->user_id);
        $this->assertHasMentor($user, $mentor2);
        $this->assertMentorCount($mentor2, 2, 2);
    }

    public function test_recalculate_mentor_totals()
    {
        $brand = 'drumeo';
        $mentor = $this->createMentor($brand);
        $this->mentorService->assignMentorByBrand(User::factory()->hasActiveMembership(100)->create()->id, $brand);
        $this->mentorService->assignMentorByBrand(User::factory()->hasActiveMembership(200)->create()->id, $brand);

        $this->assertMentorCount($mentor, 2, 2);

        Carbon::setTestNow(Carbon::now()->addDays(150));
        $this->mentorService->recalculateMentorTotals($mentor);

        $this->assertMentorCount($mentor, 1, 2);
    }
}
