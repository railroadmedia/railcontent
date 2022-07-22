<?php

namespace App\Modules\Mentor\Services;


use App\Modules\Brand\Services\BrandService;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Models\MentorStudent;

class MentorService
{
    private $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function store(int $userId)
    {
        $mentor = new Mentor();
        $mentor->user_id = $userId;
        $mentor->supported_brands = 'test';
        $mentor->active_student_max_count = 10;
        $mentor->active_student_count = 0;
        $mentor->save();
    }


    public function autoAssignMentor(int $userId)
    {
        $brand = $this->brandService->getPrimaryBrand($userId);
        $mentorUserId = $this->chooseMentor($brand);

        $mentorStudent = new MentorStudent();
        $mentorStudent->user_id = $userId;
        $mentorStudent->primary_brand = $brand;
        $mentorStudent->mentor_user_id = $mentorUserId;
        $mentorStudent->save();
    }

    private function chooseMentor(string $brand):int
    {
        
    }
}
