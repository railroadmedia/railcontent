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
    public function assignMentor(int $userId)
    {
        $brand = $this->getPrimaryBrandForAssigningMentor($userId);
        if (!$brand) {
            throw new Exception("Unable to choose a brand for user '$userId'");
        }
        $this->assignMentorByBrand($userId, $brand);
    }

    public function assignMentorByBrand(int $userId, string $brand): void
    {
        $mentor = $this->chooseMentor($brand);
        $mentorStudent = new MentorStudent();
        $mentorStudent->user_id = $userId;
        $mentorStudent->primary_brand = $brand;
        $this->updateMentorData($mentorStudent, $mentor);
    }

    public function reassignMentor(MentorStudent $mentorStudent)
    {
        $mentor = $this->chooseMentor($mentorStudent->primary_brand);
        $this->updateMentorData($mentorStudent, $mentor);
    }

    private function updateMentorData(MentorStudent $mentorStudent, ?Mentor $mentor): void
    {
        $mentorStudent->mentor_user_id = $mentor->user_id;
        $mentorStudent->save();

        $mentor->active_student_count += 1;
        $mentor->save();
    }

    public function ensureMentorAssigned(int $userId)
    {
        if ($this->hasMentor($userId)) {
            $this->assignMentor($userId);
        }
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
    public function chooseMentor(string $brand): ?Mentor
    {
        $mentors = $this->getMentorsByBrand($brand);
        if ($mentors->count() == 0) {
            Log::warning("Unable to find mentor for brand '$brand'");
            return null;
        }
        $mentorsWithLowestStudentPercentage = $this->getMentorsWithLowestStudentPercentage($mentors);
        $index = rand(0, $mentorsWithLowestStudentPercentage->count() - 1);
        $mentor = $mentorsWithLowestStudentPercentage->values()[$index];
        if (!$mentor) {
            throw new Exception("Unable to choose a mentor for brand '$brand'");
        }
        return $mentor;
    }

    /**
     * @param $mentors
     * @return mixed
     */
    private function getMentorsWithLowestStudentPercentage($mentors): mixed
    {
        $lowestStudentPercentage = $mentors->map(fn(Mentor $t) => $t->getActiveStudentPercentage())->min();
        $mentorsWithLowestStudentPercentage = $mentors->where(
            fn($t) => $t->getActiveStudentPercentage() == $lowestStudentPercentage
        );
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

    public function delete(int $mentorUserId)
    {
        $mentorStudents = MentorStudent::query()
            ->where('mentor_user_id', '=', $mentorUserId)
            ->get();
        Mentor::query()->where('user_id', '=', $mentorUserId)->delete();
        foreach ($mentorStudents as $mentorStudent) {
            $this->reassignMentor($mentorStudent);
        }
    }

    public function hasMentor(int $userId)
    {
        return MentorStudent::query()->where('user_id', '=', $userId)->exists();
    }

    public function getMentorIdByStudent(int $userId): ?int
    {
        $result = MentorStudent::query()->select('mentor_user_id')->where('user_id', '=', $userId)->first();
        return $result->mentor_user_id;
    }

    public function updateMentor(int $userId, int $newMentorId)
    {
        $mentorStudent = MentorStudent::query()->where('user_id', '=', $userId)->first();
        $mentor = Mentor::query()->where('user_id', '=', $newMentorId)->first();
        $this->updateMentorData($mentorStudent, $mentor);
    }
}
