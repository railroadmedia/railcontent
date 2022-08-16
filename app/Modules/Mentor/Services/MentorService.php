<?php

namespace App\Modules\Mentor\Services;


use App\Modules\Brand\Services\PrimaryBrandService;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Models\MentorStudent;
use App\Modules\UserManagementSystem\Services\UserService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Str;

class MentorService
{
    /**
     * @var PrimaryBrandService
     */
    private PrimaryBrandService $primaryBrandService;
    private ?Collection $mentors = null;

    public function __construct(PrimaryBrandService $primaryBrandService, UserService $session)
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
     * @throws Exception
     */
    public function assignMentor(int $userId)
    {
        $brand = $this->getPrimaryBrandForAssigningMentor($userId);
        if (!$brand) {
            Log::warning("Unable to choose a brand for user '$userId'");
            return;
            //throw new Exception("Unable to choose a brand for user '$userId'");
        }
        $this->assignMentorByBrand($userId, $brand);
    }

    public function assignMentorByBrand(int $userId, string $brand): void
    {
        $mentor = $this->chooseMentor($brand);
        $mentorStudent = $this->getMentorStudent($userId);
        $mentorStudent->primary_brand = $brand;
        $mentorStudent->mentor_user_id = $mentor->user_id;
        $mentor->active_student_count += 1;
        $mentorStudent->save();
        $mentor->save();
    }

    private function chooseNewMentor(MentorStudent $mentorStudent): ?Mentor
    {
        $brand = $mentorStudent->primary_brand;
        if (!$brand) {
            $brand = $this->getPrimaryBrandForAssigningMentor($mentorStudent->user_id);
        }
        $mentor = $this->chooseMentor($brand);
        return $mentor;
    }

    public function ensureMentorAssigned(int $userId)
    {
        if ($this->hasMentor($userId)) {
            $this->assignMentor($userId);
        }
    }

    private function getPrimaryBrandForAssigningMentor($userId): string
    {
        $primaryBrand = $this->primaryBrandService->getInitialBrand($userId);
        return $primaryBrand;
    }

    public function chooseMentor(string $brand): ?Mentor
    {
        $mentors = $this->getMentorsByBrand($brand);
        $test = $mentors->map(function ($t) {
            return $t->active_student_count;
        });
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
        if (!$this->mentors) {
            $this->mentors = Mentor::all();
        }
        $mentors = $this->mentors->where(fn(Mentor $t) => Str::contains($t->supported_brands, $brand));
        return $mentors;
    }

    public function delete(int $mentorUserId): Collection
    {
        $mentorStudents = MentorStudent::query()
            ->with('user')
            ->where('mentor_user_id', '=', $mentorUserId)
            ->get();

        $mentor = $this->getMentorOrNull($mentorUserId);
        //clear supporting brands so reassignMentor will not be able to use this mentor
        $mentor->supported_brands = "";
        $mentor->save();
        $this->mentors = null; //refresh locally stored mentors in case it contains the mentor to be deleted

        $this->bulkReassignMentors($mentorStudents);
        $mentor->delete();
        return $mentorStudents;
    }

    private function hasMentor(int $userId): bool
    {
        return MentorStudent::query()->where('user_id', '=', $userId)->exists();
    }

    public function getMentorIdByStudent(int $userId): ?int
    {
        $result = MentorStudent::query()->select('mentor_user_id')->where('user_id', '=', $userId)->first();
        return $result?->mentor_user_id;
    }

    public function updateStudentMentor(int $userId, int $newMentorId)
    {
        $mentorStudent = $this->getMentorStudent($userId);
        $mentor = $this->getMentorOrNull($newMentorId);
        $mentorStudent->mentor_user_id = $mentor->user_id;
        $mentor->active_student_count += 1;
        $mentor->save();
        $mentorStudent->save();
    }

    private function getMentorStudent(int $userId): MentorStudent
    {
        $mentorStudent = MentorStudent::query()->where('user_id', '=', $userId)->first();
        if (!$mentorStudent) {
            $mentorStudent = new MentorStudent();
            $mentorStudent->user_id = $userId;
        }
        return $mentorStudent;
    }

    public function getMentorOrNull(int $userId): ?Mentor
    {
        $mentor = Mentor::query()->where('user_id', '=', $userId)->first();
        return $mentor;
    }

    public function updateMentor(int $userId, string $supportedBrands, int $activeStudentMaxCount)
    {
        $mentor = $this->getMentorOrNull($userId);
        if (!$mentor) {
            $mentor = new Mentor();
            $mentor->user_id = $userId;
            $mentor->active_student_count = 0;
        }
        $mentor->supported_brands = $supportedBrands;
        $mentor->active_student_max_count = $activeStudentMaxCount;
        $mentor->save();
    }

    public function bulkReassignMentors(Collection|array $mentorStudents): void
    {
        $mentors = [];
        foreach ($mentorStudents as $mentorStudent) {
            $newMentor = $this->chooseNewMentor($mentorStudent);
            $mentorStudent->mentor_user_id = $newMentor->user_id;
            $newMentor->active_student_count += 1;
            if (!array_key_exists($newMentor->user_id, $mentors)) {
                $mentors[$newMentor->user_id] = $newMentor;
            }
        }

        $mentorStudents->groupBy('mentor_user_id')->each(function ($data, $mentorUserId) use ($mentors) {
            $ids = $data->map(fn($t) => $t->id);
            MentorStudent::query()->whereIn('id', $ids)->update(['mentor_user_id' => $mentorUserId]);
            $newMentor = $mentors[$mentorUserId];
            $newMentor->save();
        });
    }
}
