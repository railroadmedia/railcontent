<?php

namespace App\Modules\Mentor\Services;


use App\Modules\Brand\Services\BrandService;
use App\Modules\Brand\Services\PrimaryBrandService;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Models\MentorStudent;
use Illuminate\Support\Facades\Log;

class MentorService
{
    /**
     * @var PrimaryBrandService
     */
    private PrimaryBrandService $primaryBrandService;

    /**
     * @param PrimaryBrandService $primaryBrandService
     */
    public function __construct(PrimaryBrandService $primaryBrandService)
    {
        $this->primaryBrandService = $primaryBrandService;
    }

    /**
     * @param int $userId
     * @param string $supportedBrand
     * @param int $maxStudents
     * @return void
     */
    public function store(int $userId, string $supportedBrand, int $maxStudents = 5000)
    {
        $mentor = new Mentor();
        $mentor->user_id = $userId;
        $mentor->supported_brands = $supportedBrand;
        $mentor->active_student_max_count = $maxStudents;
        $mentor->active_student_count = 0;
        $mentor->save();
    }


    /**
     * @param int $userId
     * @return void
     */
    public function autoAssignMentor(int $userId)
    {
        $brand = $this->getPrimaryBrandForAssigningMentor($userId);
        if (!$brand) return;
        $mentor = $this->chooseMentor($brand);
        if (!$mentor) return;
        $mentorStudent = new MentorStudent();
        $mentorStudent->user_id = $userId;
        $mentorStudent->primary_brand = $brand;
        $mentorStudent->mentor_user_id = $mentor->user_id;
        $mentorStudent->save();

        $mentor->active_student_count += 1;
        $mentor->save();
    }

    /**
     * @param $userId
     * @return mixed|null
     */
    private function getPrimaryBrandForAssigningMentor($userId)
    {
        $primaryBrand = $this->primaryBrandService->getInitialBrand($userId);
        return $primaryBrand;
    }

    /**
     * @param string $brand
     * @return Mentor|null
     */
    private function chooseMentor(string $brand): ?Mentor
    {
        $mentors = $this->getMentorsByBrand($brand);
        if ($mentors->count() == 0) {
            Log::warning("Unable to find mentor for brand '$brand'");
            return null;
        }
        $mentorsWithLowestStudentPercentage = $this->getMentorsWithLowestStudentPercentage($mentors);
        $index = rand(0, $mentorsWithLowestStudentPercentage->count() - 1);
        $mentor = $mentorsWithLowestStudentPercentage->values()[$index];
        return $mentor;
    }

    /**
     * @param $mentors
     * @return mixed
     */
    private function getMentorsWithLowestStudentPercentage($mentors): mixed
    {
        $lowestStudentPercentage = $mentors->map(fn($t) => $t->getActiveStudentPercentage())->min();
        $mentorsWithLowestStudentPercentage = $mentors->where(fn($t) => $t->getActiveStudentPercentage() == $lowestStudentPercentage);
        return $mentorsWithLowestStudentPercentage;
    }

    /**
     * @param string $brand
     * @return mixed
     */
    private function getMentorsByBrand(string $brand)
    {
        $mentors = Mentor::where('supported_brands', 'like', "%$brand%")->get();
        return $mentors;
    }
}
