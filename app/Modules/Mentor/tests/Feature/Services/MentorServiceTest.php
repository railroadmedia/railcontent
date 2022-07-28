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

    private function assignMentor($brand)
    {
        $mentor = $this->createMentor($brand);
        $user = User::factory()->create();

        $this->assertFalse($this->mentorService->hasMentor($user->id));
        $this->mentorService->assignMentorByBrand($user->id, $brand);
        $this->assertTrue($this->mentorService->hasMentor($user->id));
        return [$user, $mentor];
    }


    public function test_assign_mentor()
    {
        $brand = 'drumeo';
        list($user, $mentor) = $this->assignMentor($brand);
    }

    public function test_delete_mentor()
    {
        $brand = 'drumeo';

        list($user, $mentor) = $this->assignMentor($brand);
        $mentor2 = $this->createMentor($brand);
        $this->mentorService->delete($mentor->user_id);
        $this->assertTrue($this->mentorService->hasMentor($user->id));
    }
}
